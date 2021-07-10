@extends('layouts.base')
@section('head')
    <title>{{__('app.title_cart')}}</title>
@endsection
@section('content')
    {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
    <div class="cart-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-page-inner">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>სურათი</th>
                                    <th>სახელი</th>
                                    <th>ფასი</th>
                                    <th>საერთო ფასი</th>
                                    <th>რაოდენოაბა</th>
                                </tr>
                                </thead>
                                <tbody class="align-middle">

                                @foreach($order->products as $product)
                                    <tr id="cart-container-{{$product['id']}}">
                                        <td>
                    
                                            <div class="img">
                                                <a href="#">
                                                    @if(count($product->product->files)>0)
                                                        <img
                                                            src="{{url('storage/product/'.$product->product->id. '/'.$product->product->files[0]->name)}}"
                                                            alt="">
                                                    @else
                                                        <img src="{{url('noimage.png')}}" alt="">
                                                    @endif
                                                </a>
                                                <p>{{$product['title']}}</p>
                                            </div>
                                        </td>
                                        <td id="cart_product_price-{{$product['id']}}">
                                        {{count($product->availableLanguage)>0?$product->availableLanguage[0]->title:""}}
                                            $ {{($product['sale']) ? number_format($product['sale']/100,0):number_format($product['price']/100,0)}}</td>
                                        <td>
                                           {{number_format($product->amount/100,2)}}$
                                        </td>
                                        <td>
                                        {{number_format($product->total_price/100,2)}}
                        
                                        <td>
                                            {{$product->quantity}}
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
