@extends('layouts.base')

@section('content')

    <div class="checkout">
        <div class="container-fluid">
            <div class="row">
                <form style="display: contents" action="{{route('saveOrder',app()->getLocale())}}" method="POST">
                    @csrf
                    <div class="col-lg-8">
                        <div class="checkout-inner">
                            <div class="billing-address">
                                <h2>Billing Address</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input class="form-control {{$errors->has('name')?"invalid":""}}" name="name" type="text"
                                               placeholder="First Name">
                                        @if ($errors->has('name'))
                                            <span
                                                class="error-text">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name"</label>
                                        <input class="form-control {{$errors->has('surname')?"invalid":""}}" name="surname" type="text"
                                               placeholder="Last Name">
                                        @if ($errors->has('surname'))
                                            <span
                                                class="error-text">{{ $errors->first('surname') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control {{$errors->has('email')?"invalid":""}}" type="text" name="email" placeholder="E-mail">
                                        @if ($errors->has('email'))
                                            <span
                                                class="error-text">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mobile No</label>
                                        <input class="form-control {{$errors->has('phone')?"invalid":""}}" type="text" name="phone" placeholder="Mobile No">
                                        @if ($errors->has('phone'))
                                            <span
                                                class="error-text">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <input class="form-control {{$errors->has('address')?"invalid":""}}" type="text" name="address" placeholder="Address">
                                        @if ($errors->has('address'))
                                            <span
                                                class="error-text">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="shipping-address">
                                <h2>Shipping Address</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input class="form-control" type="text" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name"</label>
                                        <input class="form-control" type="text" placeholder="Last Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control" type="text" placeholder="E-mail">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mobile No</label>
                                        <input class="form-control" type="text" placeholder="Mobile No">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <input class="form-control" type="text" placeholder="Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Country</label>
                                        <select class="custom-select">
                                            <option selected>United States</option>
                                            <option>Afghanistan</option>
                                            <option>Albania</option>
                                            <option>Algeria</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>City</label>
                                        <input class="form-control" type="text" placeholder="City">
                                    </div>
                                    <div class="col-md-6">
                                        <label>State</label>
                                        <input class="form-control" type="text" placeholder="State">
                                    </div>
                                    <div class="col-md-6">
                                        <label>ZIP Code</label>
                                        <input class="form-control" type="text" placeholder="ZIP Code">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout-inner">
                            <div class="checkout-summary">
                                <h1>Cart Total</h1>
                                <p>პროდუქტების რაოდენობა<span>$99</span></p>
                                <p class="sub-total">საერთო ფასი<span>$99</span></p>
                                <p class="ship-cost">მიტანის საფასური<span>$1</span></p>
                                <h2>ჯამური ფასი<span>$100</span></h2>
                            </div>

                            <div class="checkout-payment">
                                <div class="payment-methods">
                                    <h1>Payment Methods</h1>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-1"
                                                   name="payment_method" value="PayPal">
                                            <label class="custom-control-label" for="payment-1">Paypal</label>
                                        </div>
                                        <div class="payment-content" id="payment-1-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt
                                                orci ac eros volutpat maximus lacinia quis diam.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-4"
                                                   name="payment_method" value="Direct Bank Transfer">
                                            <label class="custom-control-label" for="payment-4">Direct Bank
                                                Transfer</label>
                                        </div>
                                        <div class="payment-content" id="payment-4-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt
                                                orci ac eros volutpat maximus lacinia quis diam.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="payment-5"
                                                   name="payment_method" value="cash">
                                            <label class="custom-control-label" for="payment-5">Cash on Delivery</label>
                                        </div>
                                        <div class="payment-content" id="payment-5-show">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt
                                                orci ac eros volutpat maximus lacinia quis diam.
                                            </p>
                                        </div>
                                    </div>
                                    @if ($errors->has('payment_method'))
                                        <span
                                            class="error-text">{{ $errors->first('payment_method') }}</span>
                                    @endif
                                </div>
                                <div class="checkout-btn">
                                    <button>Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
