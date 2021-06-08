<?php
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Invoice</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        body {
            font-family: DejaVu Sans;
        }

        .text-right {
            text-align: right;
        }
    </style>

</head>
<body class="login-page" style="background: white">
<div>
    <div class="row">
        <div class="col-xs-7">
            <strong>{{__('client.address')}}</strong><br>
            {{__('client.invoice_address')}} <br>
            <strong>{{__('client.mobile')}}:</strong> <br>
            {{__('client.invoice_mobile')}} <br>
            <strong>{{__('client.email')}}</strong><br>
            {{__('client.invoice_email')}} <br>
            <strong>{{__('client.bank_address')}}:</strong><br>
           {{__('client.invoice_bank_address')}}
            <br>
        </div>
        <div class="col-xs-5">
            <table style="width: 100%">
                <tbody>
                <tr>
                    <th class="text-center"> {{__('client.invoice_date')}}:</th>
                    <td >{{\Carbon\Carbon::parse($order->created_at)->toFormattedDateString()}}</td>
                </tr>
                <tr>
                    <th class="text-center"> {{__('client.invoice_id')}}:</th>
                    <td >{{$order->id}}</td>
                </tr>
                </tbody>
            </table>

            <div style="margin-bottom: 0px">&nbsp;</div>
        </div>
    </div>
    <div style="margin-bottom: 15px"></div>


    <table class="table">
        <thead style="background: #771732; color:white;">
        <tr>
            <th>{{__('client.receiver')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{__('client.receiver_details')}}</td>
        </tr>
        </tbody>
    </table>
    <table class="table">
        <thead style="background: #771732; color:white;">
        <tr>
            <th>№</th>
            <th>{{__('client.name')}}</th>
            <th>{{__('client.count')}}</th>
            <th>{{__('client.bottle_capacity_in_liters')}}</th>
            <th>{{__('client.invoice_price')}}</th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0;?>
        @if(count($order->products) > 0)
            @foreach($order->products as $prod)
                <tr>
                    <td>{{$prod->id}}</td>
                    <?php
                    $produc = \App\Models\Product::where('id', $prod->product_id)->first(); ?>
                    @if($produc != null)
                        <td>{{(count($produc->availableLanguage) > 0) ? $produc->availableLanguage[0]->title : $produc->language[0]->title}}</td>
                    @else
                        <td></td>
                    @endif


                    <td>{{$prod->quantity}}</td>
                    <td>0.75</td>
                    <td>{{number_format($prod->price/100 ,2)}} ლ</td>
                </tr>
                <?php $total += $prod->price/100; ?>
            @endforeach
        @endif
        </tbody>
    </table>

    <table class="table">
        <thead style="background: #771732; color:white;">
        <tr>
            <th>{{__('client.name')}}</th>
            <th>{{__('client.final_cost')}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{__('client.products')}}</td>
            <td>{{number_format($total ,2)}} ლ</td>
        </tr>
        <tr>
            <td>{{__('client.courier')}}</td>
            <td>{{number_format(5 ,2)}} ლ</td>
        </tr>
        <tr>
            <td>{{__('client.total')}}</td>
            <td>{{number_format($total+5 ,2)}} ლ</td>
        </tr>

        </tbody>
    </table>


    <div style="margin-bottom: 0px">&nbsp;</div>

    <div class="row">
        <div class="col-xs-12 invbody-terms" style="    text-align: -webkit-center;">
            <strong>{{__('client.director')}}: </strong>{{__('client.ekaterine_svanidze')}}
        </div>
    </div>
</div>

</body>
</html>
