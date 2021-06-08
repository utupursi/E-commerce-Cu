<?php
/**
 *  app/Payment/TbcLoan.php
 *
 * User:
 * Date-Time: 18.02.21
 * Time: 16:08
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App\Payment;

class TbcLoan {

    private $tbc_key = 'A1qCcCLAKpBNzyjEiZJGTbMBbcNxi5H5';
    private $tbc_secret = 'gDis1pJgJefLcwp5';
    private $tbc_merchant = '402145362-371e5f94-ed75-4e51-9cb1-8d8759e7e336';
    private $tbc_auth_url = 'https://api.tbcbank.ge/oauth/token';
    private $tbc_initiate_url = 'https://api.tbcbank.ge/v1/online-installments/applications';
    protected $tbc_redirect_url = 'https://tbcganvadeba.ge/Installment/InitializeNewLoan';
    private $campaignId = '529';

    public function authToken()
    {
        $encode = base64_encode($this->tbc_key . ":" . $this->tbc_secret);
        $auth_curl = curl_init();
        curl_setopt_array($auth_curl, array(
            curl_setopt($auth_curl, CURLOPT_URL, $this->tbc_auth_url),
            curl_setopt($auth_curl, CURLOPT_POSTFIELDS, http_build_query([
                'grant_type' => 'client_credentials',
                'scope' => 'online_installments'
            ])),
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
        $response = curl_exec($auth_curl);
        $response = json_decode($response, true);
        curl_close($auth_curl);
        return $response['access_token'];
    }


    public function initiateApplication(float $total, array $products,int $invoiceID): array
    {
        $data = [
            "merchantKey" => $this->tbc_merchant,
            "priceTotal" => $total,
            "campaignId" => $this->campaignId,
            "products" => $products,
            'invoiceId' => $invoiceID
        ];
        $order_curl = curl_init();
        curl_setopt_array($order_curl, array(
            CURLOPT_URL => $this->tbc_initiate_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            curl_setopt($order_curl, CURLOPT_POSTFIELDS,
                json_encode($data)
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->authToken(),
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($order_curl);
        $response = json_decode($response, true);

        if (isset($response['sessionId'])) {
            return [
                'status' => true,
                'sessionId' => $response['sessionId']
            ];
        }
        return [
            'status' => false,
        ];
    }

    public function getRedirectUrl(string $sessionId) {
        return $this->tbc_redirect_url . '?sessionId='.$sessionId;
    }

    public function cancel(string $sessionId) {
        $data = [
            "merchantKey" => $this->tbc_merchant,
        ];
        $url = $this->tbc_initiate_url .'/'.$sessionId.'/cancel';
        $order_curl = curl_init();
        curl_setopt_array($order_curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            curl_setopt($order_curl, CURLOPT_POSTFIELDS,
                json_encode($data)
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->authToken(),
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($order_curl);
        $response = json_decode($response, true);
        if (isset($response['status'])) {
            return 404;
        }
        return 200;
    }

    public function confirm(string $sessionId) {
        $data = [
            "merchantKey" => $this->tbc_merchant,
        ];
        $url = $this->tbc_initiate_url .'/'.$sessionId.'/confirm';
        $order_curl = curl_init();
        curl_setopt_array($order_curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            curl_setopt($order_curl, CURLOPT_POSTFIELDS,
                json_encode($data)
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->authToken(),
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($order_curl);
        $response = json_decode($response, true);
        if (isset($response['status'])) {
            return 404;
        }
        return 200;
    }

}