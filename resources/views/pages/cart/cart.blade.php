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
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                                </thead>
                                <tbody class="align-middle">
                                @foreach($products as $product)
                                    <tr id="cart-container-{{$product['id']}}">
                                        <td>
                                            <div class="img">
                                                <a href="#">
                                                    @if($product['file'] != '')
                                                        <img
                                                            src="{{url('storage/product/'.$product['id']. '/'.$product['file'])}}"
                                                            alt="">
                                                    @else
                                                        <img src="{{url('noimage.png')}}" alt="">
                                                    @endif
                                                </a>
                                                <p>{{$product['title']}}</p>
                                            </div>
                                        </td>
                                        <td id="cart_product_price-{{$product['id']}}">
                                            $ {{($product['sale']) ? number_format($product['sale']/100,0):number_format($product['price']/100,0)}}</td>
                                        <td>
                                            <div class="qty">
                                                <button class="btn-minus"
                                                        onclick="QuantityMinus(this,{{$product['id']}})"><i
                                                        class="fa fa-minus"></i></button>
                                                <input min="1" max="12" type="text" value="{{$product['quantity']}}" disabled>
                                                <button class="btn-plus"
                                                        onclick="QuantityPlus(this,{{$product['id']}})"><i
                                                        class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td id="cart_product_total-{{$product['id']}}">
                                            $ {{($product['sale']) ?number_format((($product['sale']/100)*$product['quantity']),0) : number_format((($product['price']/100) * $product['quantity']),0)}}</td>
                                        <td>
                                            <button onclick="removefromcart({{$product['id']}})"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart-page-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="coupon">
                                    <input type="text" placeholder="Coupon Code">
                                    <button>Apply Code</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="cart-summary">
                                    <div class="cart-content">
                                        <h1>Cart Summary</h1>
                                        <p>პროდუქტების რაოდნეობა<span>{{count($products)}}</span></p>
                                        <p>საერთო ფასი<span id="sub-total">$ {{$total? $total : 0}}</span></p>
                                        <p>მიტანის საფასური<span>$5</span></p>
                                        <h2>ჯამური ფასი<span id="total-price">$ {{$total+5}}</span></h2>
                                    </div>
                                    <div class="cart-btn">
                                        <button>Update Cart</button>
                                        <button onclick="window.location.href='{{route('checkout',app()->getLocale())}}'">
                                            Checkout
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
