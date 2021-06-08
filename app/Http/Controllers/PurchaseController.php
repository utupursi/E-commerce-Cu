<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Bank;
use App\Models\Localization;
use App\Models\Order;
use App\Models\PaymentType;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class PurchaseController extends Controller
{
    protected $auth_token;

    private $bog_secret_key;
    private $bog_auth_url;
    private $bog_client_id;
    private $bog_order_url;
    private $bog_payment_url;

    public function __construct()
    {
        $this->bog_client_id = "3680";
        $this->bog_secret_key = "140b70a0b12e7d965056ca5c33d264f6";
        $this->bog_auth_url = "https://ipay.ge/opay/api/v1/oauth2/token";
        $this->bog_order_url = "https://ipay.ge/opay/api/v1/checkout/orders";
        $this->bog_payment_url = "https://ipay.ge/opay/api/v1/checkout/payment";
//        $this->credo_loan = "http://ganvadeba.credo.ge/widget/";
    }

    public function index($locale)
    {
        $cart = session('products') ?? null;
        if ($cart !== null || count($cart) > 0) {
            if (Auth::user()) {
                $localization = Localization::where('abbreviation', app()->getLocale())->first()->id;
                return view('pages.purchase.purchase_auth', compact('localization'));
            }
            return view('pages.purchase.purchase_un_auth');
        }
        return redirect()->back();
    }

    public function buy(PurchaseRequest $request, $locale)
    {
        $cart = session('products') ?? null;

        if ($cart !== null) {
            $total = 0;
            $shipmentPrice = 0;
            // validate and get total
            foreach ($cart as $item) {
                $product = Product::find(intval($item->product_id));
                if ($product && $item->quantity > 0) {
                    $total += $item->quantity * (($product->sale == 1) ? $product->sale_price : $product->price);
                }
            }
            if ($request['product_delivery'] === 'withdraw') {
                $shipmentPrice = 0;
            }
            $total += $shipmentPrice; // mitana
            $paymentType = PaymentType::where(['title' => $request['payment_method']])->first();

            $bank = Bank::where(['id' => $request['card_payment'], 'payment_type_id' => $paymentType->id])->first();
            if (!$bank) {
                $bank = Bank::where(['title' => $request['installment_bank'], 'payment_type_id' => $paymentType->id])->first();
            }
            $order = Order::create([
                'bank_id' => $bank->id,
                'payment_type_id' => $bank->payment_type_id,
                'transaction_id' => uniqid(),
                'shipment_price' => $shipmentPrice,
                'shipment_comment' => $request['details'],
                'total_price' => $total,
                'status' => 3,
                'first_name' => $request['name'],
                'last_name' => $request['surname'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'address' => $request['address'],
            ]);

            $products = array();
            foreach ($cart as $item) {
                $product = Product::find(intval($item->product_id));
                if ($product && $item->quantity > 0) {
                    $products[] = (array)[
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'amount' => $product->price,
                        'total_price' => ($product->sale == 1) ? $product->sale_price : $product->price,
                        'quantity' => intval($item->quantity),
                    ];
                }
            }
            $order->products()->createMany($products);
            if (!$bank) {
                session(['products' => []]);
                return redirect()->home();
            }
            if ($bank->title === "Volta Loan") {
                $this->createLoan($request, $order);
                session(['products' => []]);
                return view('pages.payment.success', [
                    'message' => __('client.volta_loan_success_submit')
                ]);
            }
            if ($request['payment_method'] === "Credit Card" && $bank->title === "TBC") {
                return $this->tbcPayment($request, $order);
            }
            if ($request['payment_method'] === "Credit Card" && $bank->title === "Georgian Bank") {
                return $this->bogPayment($request, $order);
            }

            if ($request['payment_method'] === 'Loan' && $bank->title === 'Credo Bank') {
                return $this->createCredoLoan($order);
            }

            if ($request['payment_method'] === 'Loan' && $bank->title === 'TBC') {
                $tbcLoan = new \App\Payment\TbcLoan();
                $supplement = ($order->total_price / 100) * 5;

                $total = ($order->total_price + $supplement) / 100;

                $request = $tbcLoan->initiateApplication(floatval($total), $this->getTbcOrderProducts($order, $supplement), $order->id);
                if ($request['status']) {
                    $order->tbcLoan()->create([
                        'session_id' => $request['sessionId']
                    ]);
                    session(['products' => []]);

                    return redirect($tbcLoan->getRedirectUrl($request['sessionId']));
                }
            }
//            return redirect()->route('CabinetOrders', app()->getLocale());
        } else {
            return redirect()->back();
        }
    }

    protected function createCredoLoan($order)
    {
        $str = "";
        if (count($order->products) > 0) {
            $data = [];
            foreach ($order->products as $key => $product) {
                $totalPrice = $product->total_price;
                $data[] = [
                    'id' => $product->id,
                    'title' => (count($product->availableLanguage) > 0) ? $product->availableLanguage[0]->title : $product->language[0]->title,
                    'amount' => $product->quantity,
                    'price' => $totalPrice + (($totalPrice * 5) / 100),
                    'type' => 0
                ];
                $arr = [
                    $product->id,
                    (count($product->availableLanguage) > 0) ? $product->availableLanguage[0]->title : $product->language[0]->title,
                    $product->quantity,
                    $totalPrice + (($totalPrice * 5) / 100),
                    0
                ];
                if ($key > 0) {
                    $str .= ',';
                }
                $str .= implode(',', $arr);
            }

            $check = md5($str);
            return view('pages.payment.credo.credo_checkout', [
                'data' => json_encode($data),
                'orderId' => $order->id,
                'check' => $check
            ]);
        }
    }

    protected function createLoan($request, $order)
    {

        $order->loan()->create([
            'first_name' => $request['loan_firstname'],
            'last_name' => $request['loan_lastname'],
            'personal_number' => $request['loan_personal_number'],
            'phone' => $request['loan_phone'],
            'jurisdiction_address' => $request['loan_jurisdiction_address'],
            'actual_address' => $request['loan_actual_address'],
            'job' => $request['loan_job'],
            'job_address' => $request['loan_job_address'],
            'job_phone' => $request['loan_job_phone'],
            'income' => $request['loan_income'],
            'additional_income' => $request['loan_additional_income'],
            'liabilities' => $request['loan_liabilities'],
            'family_full_name' => $request['loan_family_full_name'],
            'family_phone' => $request['loan_family_phone'],
            'family_1_full_name' => $request['loan_family_1_full_name'],
            'family_2_phone' => $request['loan_family_2_phone'],
            'employee_full_name' => $request['loan_employee_full_name'],
            'employee_phone' => $request['loan_employee_phone'],
            'friend_full_name' => $request['loan_friend_full_name'],
            'friend_phone' => $request['loan_friend_phone'],
            'payment_day' => $request['loan_payment_day'],
            'month_total' => $request['loan_month_total'],
        ]);
        return true;
    }

    protected function bogPayment($request, $order)
    {
        $order_curl = curl_init();

        curl_setopt_array($order_curl, array(
            CURLOPT_URL => $this->bog_order_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            curl_setopt($order_curl, CURLOPT_POSTFIELDS,
                json_encode(array(
                    "intent" => 'CAPTURE',
                    "redirect_url" => 'https://volta.ge/payments/bog/status',
                    "shop_order_id" => $order->transaction_id,
                    "locale" => 'en-US',
                    "purchase_units" => [
                        [
                            "amount" => [
                                "currency_code" => "GEL",
                                "value" => $order->total_price / 100,
                            ],
                            "industry_type" => "ECOMMERCE"
                        ]
                    ],
                    "items" => []
                ))
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->BOGToken(),
                "Content-Type: application/json"
            ),
        ));

        $order_response = curl_exec($order_curl);
        $order_response = json_decode($order_response, true);

        if ($order_response['links'][1]['rel'] == 'approve') {
            Session::put('BogOrderID', $order_response['order_id']);
            $order->transaction_id = $order_response['order_id'];
            $order->save();
            return redirect($order_response['links'][1]['href']);
        } else {
            die("Payment Die");
        }
    }


    protected function getTbcOrderProducts($order, $supplement)
    {
        $data = [];
        $data [] = [
            'name' => 'Supplement',
            'price' => floatval($supplement / 100),
            'quantity' => 1
        ];
        foreach ($order->products as $orderProduct) {
            if (count($orderProduct->product->availableLanguage) > 0) {
                $data [] = [
                    'name' => $orderProduct->product->availableLanguage[0]->title,
                    'price' => floatval($orderProduct->quantity * ($orderProduct->total_price / 100)),
                    'quantity' => $orderProduct->quantity
                ];
            } else {
                $data [] = [
                    'name' => $orderProduct->product->language[0]->title,
                    'price' => floatval($orderProduct->total_price / 100),
                    'quantity' => $orderProduct->quantity
                ];
            }
        }
        return $data;
    }


    public function bogResponse(Request $request)
    {
        $transactionId = Session::get('BogOrderID');
        $status_curl = curl_init();
        curl_setopt_array($status_curl, array(
            curl_setopt($status_curl, CURLOPT_URL, $this->bog_payment_url . '/' . $transactionId),
            curl_setopt($status_curl, CURLOPT_RETURNTRANSFER, 1),
            curl_setopt($status_curl, CURLOPT_CUSTOMREQUEST, 'GET'),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Basic ' . $this->BOGToken(),
            ),
        ));
        $order_response = curl_exec($status_curl);
        $order_response = json_decode($order_response, true);
        if ($order_response['status'] == 'success') {
            return $this->bogSuccess($transactionId);

        } else {
            return $this->bogFail($transactionId);
        }
        curl_close($status_curl);
    }

    protected function bogSuccess(string $transactionId)
    {
        $order = Order::where('transaction_id', $transactionId)->first();
        if ($order !== null) {
            $order->status = 1;
            $order->save();
            session(['products' => []]);
            Session::forget('BogOrderID');
            return view('pages.payment.success', [
                'message' => __('client.bog_payment_success')
            ]);
        }
    }

    protected function bogFail(string $transactionId)
    {
        $order = Order::where('transaction_id', $transactionId)->first();
        if ($order !== null) {
            $order->status = 2;
            $order->save();
            Session::forget('BogOrderID');

            session(['products' => []]);

            return view('pages.payment.fail');
        }
    }

    protected function tbcPayment($request, $order)
    {
        $curl = curl_init();
        $post_fields = "command=v&amount=" . $order->total_price . "&currency=981&client_ip_addr=" . $_SERVER['REMOTE_ADDR'] . "&language=GE&description=VoltaShop&msg_type=SMS";
        $submit_url = "https://ecommerce.ufc.ge:18443/ecomm2/MerchantHandler";
        curl_setopt($curl, CURLOPT_SSLVERSION, 0);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($curl, CURLOPT_VERBOSE, '1');
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 120);
        curl_setopt($curl, CURLOPT_SSLCERT, getcwd() . '/5303003.pem');
        curl_setopt($curl, CURLOPT_SSLKEYPASSWD, 'DGTR1c7wPtbkqtNs');
        curl_setopt($curl, CURLOPT_URL, $submit_url);
        $responseData = curl_exec($curl);
        $info = curl_getinfo($curl);
        if (curl_errno($curl)) {
            echo 'curl error:' . curl_error($curl) . "<BR>";
        }
        $transactionId = substr($responseData, -28);
        Session::put('TBCSessionID', $transactionId);
        $order->transaction_id = $transactionId;
        $order->save();

        return view('pages.payment.tbc.tbc_checkout', [
            'transactionId' => $transactionId
        ]);
        curl_close($curl);

    }


    public function tbcResponse(Request $request)
    {

        $transactionId = Session::get('TBCSessionID');
        $curl = curl_init();
        $post_fields = "command=c&trans_id=" . urlencode($transactionId) . "&client_ip_addr=" . $_SERVER['REMOTE_ADDR'];
        $submit_url = "https://ecommerce.ufc.ge:18443/ecomm2/MerchantHandler";
        Curl_setopt($curl, CURLOPT_SSLVERSION, 1); //0
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
        curl_setopt($curl, CURLOPT_VERBOSE, '1');
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 120);
        curl_setopt($curl, CURLOPT_SSLCERT, getcwd() . '/5303003.pem');
        curl_setopt($curl, CURLOPT_SSLKEYPASSWD, 'DGTR1c7wPtbkqtNs');
        curl_setopt($curl, CURLOPT_URL, $submit_url);
        $result = curl_exec($curl);
        $info = curl_getinfo($curl);
        if (curl_errno($curl)) {
            echo 'curl error:' . curl_error($curl) . "<BR>";
        }
        curl_close($curl);
        $result_array = explode(PHP_EOL, trim($result));
        $curl = curl_init();
        $result = array();
        foreach ($result_array as $key => $value) {
            $array2 = explode(':', $value);
            $result[$array2[0]] = trim($array2[1]);
        }
        $json = json_encode($result);
        $json_decode = json_decode($json);
        if ($json_decode->RESULT == "OK") {
            return $this->tbcSuccess($transactionId);
        } else {
            return $this->tbcFail($transactionId);
        }
    }

    protected function tbcSuccess(string $transactionId)
    {
        $order = Order::where('transaction_id', $transactionId)->first();
        if ($order !== null) {
            $order->status = 1;
            $order->save();
            session(['products' => []]);

            return view('pages.payment.success', [
                'message' => __('client.tbc_payment_success')
            ]);
        }
    }

    protected function tbcFail(string $transactionId)
    {
        $order = Order::where('transaction_id', $transactionId)->first();
        if ($order !== null) {
            $order->status = 2;
            $order->save();
            session(['products' => []]);

            return view('pages.payment.fail');
        }
    }

    public function BOGToken()
    {
        $encode = base64_encode($this->bog_client_id . ":" . $this->bog_secret_key);
        $auth_curl = curl_init();
        curl_setopt_array($auth_curl, array(
            curl_setopt($auth_curl, CURLOPT_URL, $this->bog_auth_url),
            curl_setopt($auth_curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials"),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic ' . $encode,
            ),
        ));
        $this->auth_response = curl_exec($auth_curl);
        $this->auth_response = json_decode($this->auth_response, true);
        curl_close($auth_curl);
        return $this->auth_response['access_token'];
    }


}
