<?php

namespace App\Http\Controllers;
use App\Models\Order;
use PDF;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     *
     * @return Application
     */
    public function index(string $lang,Order $order){
            $pdf = PDF::loadView('invoice.invoice',[
            'order' => $order
        ]);
        return $pdf->download('invoice.pdf');
    }
}
