@extends('layouts.base')
@section('head')
    <title>{{__('app.title_cart')}}</title>
@endsection
@section('content')
    {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}

    <main>
        <form id="purchase-form" method="post" action="{{route('makePurchase',app()->getLocale())}}">
            @csrf
            <div class="section-1">
                <!-- section 1 - purchase-progress steps 1~4  --->
                <section id="purchase-progress">
                    <div class="container">

                        <div class="purchase-progress-bar">

                            <div class="purchase-progress__step  active"> <!-- active for highlight-->
                                <button onclick="go(1)" class="flex-center">1</button>
                                <p>{{__('client.cart')}}</p>
                            </div>

                            <div class="purchase-progress__step">
                                <button disabled onclick="go(2)" class="flex-center">2</button>
                                <p> {{__('client.personal_information')}}</p>
                            </div>

                            <div class="purchase-progress__step ">
                                <button disabled onclick="go(3)" class="flex-center">3</button>
                                <p>{{__('client.delivery_methods')}}</p>
                            </div>

                            <div class="purchase-progress__step ">
                                <button disabled onclick="go(4)" class="flex-center">4</button>
                                <p>{{__('client.pay_methods')}}</p>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- section 2 -  cart --->
                <section id="cart">
                    <div class="container">

                        <div class="cart__list">

                            <!-- drag table block on small-->
                            <div class="cart-scrollable" id="cart-container">

                                <div class="cart__list-header">
                                    <div class="cart__list-col">
                                        <label class="checkbox">
                                            <input id="check-all" type="checkbox" name="" value="val">
                                            <span></span>
                                        </label>

                                        {{__('client.product_title')}}</div>
                                    <div class="cart__list-col">{{__('client.count')}}</div>
                                    <div class="cart__list-col">{{__('client.price')}}</div>
                                    <div class="cart__list-col">{{__('client.total')}}</div>
                                </div>
                                <!--show this if empty ()-->
                            @if(count($products) > 0)
                                @foreach($products as $product)
                                    <!--product cards-->
                                        <div class="cart__card" id="cart-{{$product['id']}}">

                                            <div class="cart__card-col">

                                                <div class="cart__card-check flex-center">
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="product-select"
                                                               value="{{$product['id']}}">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <!-- product link-->
                                                <a href="" class="cart__card-img-name">
                                    <span class="cart__card-img flex-center">
                                        @if($product['file'] != '')
                                            <img src="{{url('storage/product/'.$product['id']. '/'.$product['file'])}}"
                                                 alt="">
                                        @else
                                            <img src="{{url('noimage.png')}}" alt="">
                                        @endif
                                    </span>
                                                    <h2 class="cart__card-name">
                                                        {{$product['title']}}
                                                    </h2>
                                                </a>

                                            </div>

                                            <div class="cart__card-col">

                                                <div class="plus-minus-box ">
                                                    <button class="qty_btn" type="button"
                                                            onclick="QuantityMinus(this,{{$product['id']}})"> -
                                                    </button>

                                                    <input type="number" id="cart_product_price-{{$product['id']}}"
                                                           name="qty" min="1" max="11"
                                                           value="{{$product['quantity']}}"
                                                           id="product-count-{{$product['id']}}" class="qty_input"
                                                           readonly="">

                                                    <button class="qty_btn" type="button"
                                                            onclick="QuantityPlus(this,{{$product['id']}})">+
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="cart__card-col">
                                                <span id="cart_product_price-{{$product['id']}}">{{($product['sale']) ? number_format($product['sale']/100,0):number_format($product['price']/100,0)}}₾</span>
                                            </div>
                                            <div class="cart__card-col">
                                                <span id="cart_product_total-{{$product['id']}}">{{($product['sale']) ?number_format((($product['sale']/100)*$product['quantity']),0) : number_format((($product['price']/100) * $product['quantity']),0)}}₾</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    <h2 class="cart-empty hidden">{{__('client.cart_is_empty')}}</h2>
                                @else
                                    <h2 class="cart-empty">{{__('client.cart_is_empty')}}</h2>
                                @endif
                            </div>

                            <button class="clear-cart-btn" onclick="removefromcart()">
                                {{__('client.clear_cart')}}
                            </button>


                        </div>
                        <aside class="cart__aside">
                            <h2 class="cart__aside-title">{{__('client.information_on_order')}}</h2>

                            <li class="cart__aside-li">
                                <span>{{__('client.product_count')}}</span>
                                <span id="cart_count">{{count($products)}}</span>
                            </li>
                            <li class="cart__aside-li">
                                <span>{{__('client.delivery_cost')}}</span>
                                <span>0 ₾</span>
                            </li>
                            <li class="cart__aside-li">
                                <span>{{__('client.product_price')}}</span>
                                <span id="cart_price">{{$total? $total : 0}} ₾</span>
                            </li>
                            <li class="cart__aside-li">
                                <span>{{__('client.total')}}</span>
                                <span id="cart_total">{{$total}} ₾</span>
                            </li>

                            <button type="button" class="cart__continue-link" onclick="stepTwo({{count($products)}})">
                                {{__('client.continue_buy')}}
                            </button>
                        </aside>
                    </div>
                </section>
            </div>
            <div hidden class="section-2">
                <section id="purchase-progress">
                    <div class="container">

                        <div class="purchase-progress-bar">

                            <div class="purchase-progress__step  active"> <!-- active for highlight-->
                                <button onclick="go(1)" class="flex-center">1</button>
                                <p>{{__('client.cart')}}</p>

                            </div>

                            <div class="purchase-progress__step active">
                                <button onclick="go(2)" class="flex-center">2</button>
                                <p>{{__('client.personal_information')}}</p>
                            </div>

                            <div class="purchase-progress__step ">
                                <button disabled onclick="go(3)" class="flex-center">3</button>
                                <p>{{__('client.delivery_methods')}}</p>
                            </div>

                            <div class="purchase-progress__step ">
                                <button disabled onclick="go(4)" class="flex-center">4</button>
                                <p>{{__('client.pay_methods')}}</p>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- section 2 -  cart step 2 --->
                <section id="cart-steps-section">
                    <div class="container">

                        <div class="cart-step-two__form">
                            <div class="cart-step-two__form-inputs">
                                <input type="text" class="error" name="name" id="name"
                                       placeholder="{{__('client.name')}}"
                                       autofocus>
                                <input type="text" name="surname" id="surname" placeholder="{{__('client.surname')}}"
                                >
                            </div>
                            <input type="email" name="email" id="email" placeholder="{{__('client.email')}}">
                            <input type="number" name="phone" id="phone" placeholder="{{__('client.phone')}}">

                            <textarea placeholder="{{__('client.details_for_delivery')}}" name="details" id="details"
                                      required cols="30"
                                      rows="10"></textarea>

                            <button class="step-two-continue" type="button" onclick="stepThree()">
                                {{__('client.continue')}}
                            </button>
                        </div>
                        <aside class="cart-item-aside">
                            <h2 class="cart-item-aside__title">{{__('client.cart')}}</h2>

                            @if(count($products) >0)
                                @foreach($products as $product)
                                    <div class="aside-card">

                                        <a href="" class="aside-card__link">
                                            <div class="aside-card__img flex-center">
                                                @if($product['file'] != '')
                                                    <img
                                                        src="{{url('storage/product/'.$product['id']. '/'.$product['file'])}}"
                                                        alt="">
                                                @else
                                                    <img src="{{url('noimage.png')}}" alt="">
                                                @endif
                                            </div>
                                            <h2 class="aside-card__name">
                                                {{$product['title']}}
                                            </h2>
                                        </a>

                                        <div class="aside-card__right">
                                            <div class="plus-minus-box ">
                                                <button class="qty_btn" type="button"
                                                        onclick="QuantityMinus(this,{{$product['id']}})"> -
                                                </button>

                                                <input type="number" name="qty" min="1" max="11"
                                                       value="{{$product['quantity']}}"
                                                       id="step-product-count-{{$product['id']}}" class="qty_input"
                                                       readonly="">

                                                <button class="qty_btn" type="button"
                                                        onclick="QuantityPlus(this,{{$product['id']}})">+
                                                </button>
                                            </div>

                                            <p class="aside-card__price">
                                                <span id="cart_product_total-step-{{$product['id']}}">{{($product['sale']) ?number_format((($product['sale']/100)*$product['quantity']),0) : number_format((($product['price']/100) * $product['quantity']),0)}}₾</span>
                                            </p>
                                        </div>

                                    </div>
                                @endforeach
                            @endif

                            <div class="cart-item-aside__costs my">
                                <p>{{__('client.product_price')}}:</p>
                                <span class="cost" id="step_product_price">{{$total? $total : 0}}₾</span>
                            </div>
                            <div class="cart-item-aside__costs">
                                <p>{{__('client.total')}}:</p>
                                <span class="total-cost" id="step_product_total">{{$total? $total+5 : 0}}₾</span>
                            </div>

                        </aside>

                    </div>
                </section>

            </div>

            <div hidden class="section-3">
                <section id="purchase-progress">
                    <div class="container">

                        <div class="purchase-progress-bar">

                            <div class="purchase-progress__step  active"> <!-- active for highlight-->
                                <button onclick="go(1)" class="flex-center">1</button>
                                <p>{{__('client.cart')}}</p>
                            </div>

                            <div class="purchase-progress__step active">
                                <button onclick="go(2)" class="flex-center">2</button>
                                <p>{{__('client.personal_information')}}</p>
                            </div>

                            <div class="purchase-progress__step active">
                                <button onclick="go(3)" class="flex-center">3</button>
                                <p>{{__('client.delivery_methods')}}</p>
                            </div>

                            <div class="purchase-progress__step ">
                                <button disabled onclick="go(4)" class="flex-center">4</button>
                                <p>{{__('client.pay_methods')}}</p>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- section 2 -  cart step 3 --->
                <section id="cart-steps-section">
                    <div class="container">

                        <div id="delivery-form" class="delivery-payment-methods">
                            <h2 class="last-steps__title">{{__('client.delivery_methods')}}</h2>
                            <h3 class="last-steps__sub-title">{{__('client.choose_delivery_method')}}</h2>

                                <div class="delivery-warning">
                        <span>
                            <img src="./img/icons/warning-png.png" alt="">
                        </span>
                                    <div class="delivery-warning__texts">
                                        <p>*{{__('client.delivery_validation_1')}}</p>
                                        <p>* {{__('client.delivery_validation_2')}}</p>
                                    </div>
                                </div>

                                <div class="purchase-radio-wrap">
                                    <div class="purchase-radio">
                                        <input id="is-delivery" value="location" type="radio" name="product_delivery"
                                               checked>

                                        <div class="purchase-radio__overlay">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="38.031" height="24.057"
                                                 viewBox="0 0 38.031 24.057">
                                                <g id="shipped" transform="translate(0 -94.062)">
                                                    <g id="Group_2821" data-name="Group 2821"
                                                       transform="translate(0 94.062)">
                                                        <g id="Group_2820" data-name="Group 2820"
                                                           transform="translate(0 0)">
                                                            <path id="Path_184" data-name="Path 184"
                                                                  d="M35.369,104.261l-.985-3.939a.6.6,0,0,0,.471-.582V99.1a2.5,2.5,0,0,0-2.5-2.5H27.869v-1.31a1.232,1.232,0,0,0-1.231-1.231H3.771a1.232,1.232,0,0,0-1.231,1.231v10.8a.6.6,0,1,0,1.191,0v-10.8a.04.04,0,0,1,.04-.04H26.638a.04.04,0,0,1,.04.04v10.8a.6.6,0,1,0,1.191,0v-.675H34.9a1.949,1.949,0,0,1,1.85,1.35H34.9a.6.6,0,0,0-.6.6v1.27a1.868,1.868,0,0,0,1.866,1.866h.675v2.62H35.283a3.77,3.77,0,0,0-7.128,0h-.287v-4.486a.6.6,0,0,0-1.191,0v4.486H14.322a3.77,3.77,0,0,0-7.128,0H3.771a.04.04,0,0,1-.04-.04v-1.31h2.58a.6.6,0,0,0,0-1.191H.6a.6.6,0,0,0,0,1.191H2.541v1.31a1.232,1.232,0,0,0,1.231,1.231H6.988c0,.013,0,.026,0,.04a3.771,3.771,0,1,0,7.543,0c0-.013,0-.026,0-.04h13.42c0,.013,0,.026,0,.04a3.771,3.771,0,1,0,7.543,0c0-.013,0-.026,0-.04h1.946a.6.6,0,0,0,.6-.6v-6.352A3.141,3.141,0,0,0,35.369,104.261Zm-7.5-6.467h4.486a1.312,1.312,0,0,1,1.31,1.31v.04h-5.8Zm0,6.431v-3.89H33.16l.973,3.89Zm-17.11,12.7a2.58,2.58,0,1,1,2.58-2.58A2.583,2.583,0,0,1,10.758,116.928Zm20.961,0a2.58,2.58,0,1,1,2.58-2.58A2.583,2.583,0,0,1,31.719,116.928Zm5.121-7.622h-.675a.676.676,0,0,1-.675-.675v-.675h1.35v1.35Z"
                                                                  transform="translate(0 -94.062)"/>
                                                        </g>
                                                    </g>
                                                    <g id="Group_2823" data-name="Group 2823"
                                                       transform="translate(9.528 113.117)">
                                                        <g id="Group_2822" data-name="Group 2822"
                                                           transform="translate(0 0)">
                                                            <path id="Path_185" data-name="Path 185"
                                                                  d="M129.5,350.6a1.231,1.231,0,1,0,1.231,1.231A1.232,1.232,0,0,0,129.5,350.6Z"
                                                                  transform="translate(-128.267 -350.597)"/>
                                                        </g>
                                                    </g>
                                                    <g id="Group_2825" data-name="Group 2825"
                                                       transform="translate(30.489 113.117)">
                                                        <g id="Group_2824" data-name="Group 2824"
                                                           transform="translate(0 0)">
                                                            <path id="Path_186" data-name="Path 186"
                                                                  d="M411.686,350.6a1.231,1.231,0,1,0,1.231,1.231A1.232,1.232,0,0,0,411.686,350.6Z"
                                                                  transform="translate(-410.455 -350.597)"/>
                                                        </g>
                                                    </g>
                                                    <g id="Group_2827" data-name="Group 2827"
                                                       transform="translate(15.244 110.577)">
                                                        <g id="Group_2826" data-name="Group 2826"
                                                           transform="translate(0 0)">
                                                            <path id="Path_187" data-name="Path 187"
                                                                  d="M214.715,316.393h-8.893a.6.6,0,0,0,0,1.191h8.893a.6.6,0,1,0,0-1.191Z"
                                                                  transform="translate(-205.227 -316.393)"/>
                                                        </g>
                                                    </g>
                                                    <g id="Group_2829" data-name="Group 2829"
                                                       transform="translate(1.27 108.036)">
                                                        <g id="Group_2828" data-name="Group 2828"
                                                           transform="translate(0 0)">
                                                            <path id="Path_188" data-name="Path 188"
                                                                  d="M25.32,282.188H17.7a.6.6,0,1,0,0,1.191H25.32a.6.6,0,1,0,0-1.191Z"
                                                                  transform="translate(-17.102 -282.188)"/>
                                                        </g>
                                                    </g>
                                                    <g id="Group_2831" data-name="Group 2831"
                                                       transform="translate(10.798 99.779)">
                                                        <g id="Group_2830" data-name="Group 2830">
                                                            <path id="Path_189" data-name="Path 189"
                                                                  d="M155.279,171.2a.6.6,0,0,0-.842,0l-5.3,5.3-2.755-2.755a.6.6,0,0,0-.842.842l3.176,3.176a.6.6,0,0,0,.842,0l5.717-5.717A.6.6,0,0,0,155.279,171.2Z"
                                                                  transform="translate(-145.37 -171.023)"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                            <span>{{__('client.delivery_on_home')}}</span>
                                        </div>
                                    </div>
                                    <div class="purchase-radio">
                                        <input id="is-widthdraw" type="radio" value="withdraw" name="product_delivery">

                                        <div class="purchase-radio__overlay">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="29.645" height="25.321"
                                                 viewBox="0 0 29.645 25.321">
                                                <g id="shop_2_" data-name="shop (2)" transform="translate(0 -37.34)">
                                                    <g id="Group_2835" data-name="Group 2835"
                                                       transform="translate(0 37.34)">
                                                        <g id="Group_2834" data-name="Group 2834">
                                                            <path id="Path_190" data-name="Path 190"
                                                                  d="M29.6,44.994l-.02-.111c0-.017-.005-.034-.009-.051L27.494,39.81V37.34H2.117v2.47L.072,44.831c0,.02-.007.04-.011.059l-.019.1A3.575,3.575,0,0,0,0,45.545a3.527,3.527,0,0,0,1.853,3.106v14.01h25.94V48.651a3.529,3.529,0,0,0,1.853-3.106A3.574,3.574,0,0,0,29.6,44.994Zm-1.4-.242H23.668l-.546-3.667h3.59ZM3.353,38.575H26.259V39.81H3.353ZM22.6,45.986l.067.448-.365.486a2.294,2.294,0,0,1-3.671,0l-.373-.5-.022-.438Zm-4.425-1.235L18,41.084h3.875l.546,3.667ZM17,45.986h0l.022.448-.366.487a2.294,2.294,0,0,1-3.671,0l-.375-.5.022-.435ZM12.7,44.751l.185-3.667h3.881l.179,3.667Zm-5.464,0,.539-3.667h3.874l-.186,3.667ZM11.4,45.986l-.023.453-.362.482a2.294,2.294,0,0,1-3.671,0l-.356-.474.068-.46Zm-8.463-4.9H6.523l-.539,3.667H1.439Zm-1.655,4.9H5.8l-.1.48-.341.455a2.294,2.294,0,0,1-4.087-.935ZM24.087,61.427H19.145V57.1h.618a.617.617,0,1,0,0-1.234h-.618V51.544h4.941Zm2.47,0H25.322V50.31H17.91V61.427H3.088V49.047a3.529,3.529,0,0,0,3.264-1.384,3.529,3.529,0,0,0,5.647,0,3.529,3.529,0,0,0,5.646,0,3.529,3.529,0,0,0,5.647,0,3.529,3.529,0,0,0,3.264,1.384v12.38Zm-.442-13.588a2.276,2.276,0,0,1-1.835-.918l-.359-.477-.07-.458h4.514A2.3,2.3,0,0,1,26.115,47.839Z"
                                                                  transform="translate(0 -37.34)"/>
                                                        </g>
                                                    </g>
                                                    <g id="Group_2837" data-name="Group 2837"
                                                       transform="translate(4.323 50.31)">
                                                        <g id="Group_2836" data-name="Group 2836">
                                                            <path id="Path_191" data-name="Path 191"
                                                                  d="M74.656,261.348v8.645H87.009v-8.645Zm11.117,7.411H75.892v-6.177h9.881Z"
                                                                  transform="translate(-74.656 -261.348)"/>
                                                        </g>
                                                    </g>
                                                    <g id="Group_2839" data-name="Group 2839"
                                                       transform="translate(12.347 54.633)">
                                                        <g id="Group_2838" data-name="Group 2838">
                                                            <path id="Path_192" data-name="Path 192"
                                                                  d="M215.1,336a.613.613,0,0,0-.437.181l-1.235,1.236a.617.617,0,0,0,.873.872l1.235-1.234A.618.618,0,0,0,215.1,336Z"
                                                                  transform="translate(-213.25 -336.004)"/>
                                                        </g>
                                                    </g>
                                                    <g id="Group_2841" data-name="Group 2841"
                                                       transform="translate(9.877 52.163)">
                                                        <g id="Group_2840" data-name="Group 2840">
                                                            <path id="Path_193" data-name="Path 193"
                                                                  d="M174.9,293.348a.613.613,0,0,0-.437.181l-3.706,3.7a.617.617,0,1,0,.873.873l3.706-3.7a.617.617,0,0,0-.436-1.054Z"
                                                                  transform="translate(-170.578 -293.348)"/>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>

                                            <span>{{__('client.put_from_office')}}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- delivery service-->
                                <div class="delivery-location">
                                    <input id="delivery-address" name="delivery_address" type="text"
                                           placeholder="{{__('client.enter_address')}}" required>
                                    <span class="flex-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20.25" height="29.25"
                                 viewBox="0 0 20.25 29.25">
                                <path id="Icon_ionic-ios-pin" data-name="Icon ionic-ios-pin"
                                      d="M18,3.375c-5.59,0-10.125,4.212-10.125,9.4C7.875,20.088,18,32.625,18,32.625S28.125,20.088,28.125,12.776C28.125,7.587,23.59,3.375,18,3.375ZM18,16.8a3.3,3.3,0,1,1,3.3-3.3A3.3,3.3,0,0,1,18,16.8Z"
                                      transform="translate(-7.875 -3.375)"></path>
                              </svg>
                        </span>
                                </div>

                                <button type="button" id="submit-delivery" class="last-steps-continue"
                                        onclick="stepFour()">
                                    {{__('client.continue')}}
                                </button>

                        </div>


                        <!-- product list-->
                        <aside class="cart-item-aside">
                            <h2 class="cart-item-aside__title">{{__('client.cart')}}</h2>

                            @if(count($products) >0)
                                @foreach($products as $product)
                                    <div class="aside-card">

                                        <a href="" class="aside-card__link">
                                            <div class="aside-card__img flex-center">
                                                @if($product['file'] != '')
                                                    <img
                                                        src="{{url('storage/product/'.$product['id']. '/'.$product['file'])}}"
                                                        alt="">
                                                @else
                                                    <img src="{{url('noimage.png')}}" alt="">
                                                @endif
                                            </div>
                                            <h2 class="aside-card__name">
                                                {{$product['title']}}
                                            </h2>
                                        </a>

                                        <div class="aside-card__right">
                                            <div class="plus-minus-box ">
                                                <button class="qty_btn" type="button"
                                                        onclick="QuantityMinus(this,{{$product['id']}})"> -
                                                </button>

                                                <input type="number" name="qty" min="1" max="11"
                                                       value="{{$product['quantity']}}"
                                                       id="step-2-product-count-{{$product['id']}}" class="qty_input"
                                                       readonly="">

                                                <button class="qty_btn" type="button"
                                                        onclick="QuantityPlus(this,{{$product['id']}})">+
                                                </button>
                                            </div>

                                            <p class="aside-card__price">
                                                <span id="cart_2_product_total-step-{{$product['id']}}">{{($product['sale']) ?number_format((($product['sale']/100)*$product['quantity']),0) : number_format((($product['price']/100) * $product['quantity']),0)}}₾</span>
                                            </p>
                                        </div>

                                    </div>
                                @endforeach
                            @endif

                            <div class="cart-item-aside__costs my">
                                <p>{{__('client.product_price')}}:</p>
                                <span class="cost" id="step_2_product_price">{{$total? $total : 0}}₾</span>
                            </div>
                            <div class="cart-item-aside__costs">
                                <p>{{__('client.total')}}:</p>
                                <span class="total-cost" id="step_2_product_total">{{$total? $total+5 : 0}}₾</span>
                            </div>

                        </aside>

                    </div>
                </section>
            </div>

            <div hidden class="section-4">
                <section id="purchase-progress">
                    <div class="container">

                        <div class="purchase-progress-bar">

                            <div class="purchase-progress__step  active"> <!-- active for highlight-->
                                <button onclick="go(1)" class="flex-center">1</button>
                                <p>{{__('client.cart')}}</p>
                            </div>

                            <div class="purchase-progress__step active">
                                <button onclick="go(2)" class="flex-center">2</button>
                                <p>{{__('client.personal_information')}}</p>
                            </div>

                            <div class="purchase-progress__step active">
                                <button onclick="go(3)" class="flex-center">3</button>
                                <p>{{__('client.delivery_methods')}}</p>
                            </div>

                            <div class="purchase-progress__step active">
                                <button onclick="go(4)" class="flex-center">4</button>
                                <p>{{__('client.pay_methods')}}</p>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- section 2 -  cart step 2 --->
                <section id="cart-steps-section">
                    <div class="container">

                        <div id="payment-form" class="delivery-payment-methods">
                            <h2 class="last-steps__title">{{__('client.pay_methods')}}</h2>
                            <h3 class="last-steps__sub-title">{{__('client.choose_pay_method')}}</h3>

                            <div class="delivery-warning">
                        <span>
                            <img src="./img/icons/warning-png.png" alt="">
                        </span>
                                <div class="delivery-warning__texts">
                                    <p>{{__('client.delivery_validation_1')}}</p>
                                    <p>{{__('client.delivery_validation_2')}}</p>
                                </div>
                            </div>

                            <div class="purchase-radio-wrap">
                                @foreach($paymentTypes as $key => $type)
                                    <div class="purchase-radio">
                                        <input
                                            id="{{$type->title=="Credit Card"?'card-pay':($type->title=="Loan"?'installment-pay':"")}}"
                                            value="{{$type->title}}" type="radio"
                                            name="payment_method"
                                            {{$key == 0 ? 'checked' : ''}}>

                                        <div class="purchase-radio__overlay">
                                            <svg id="Group_2844" data-name="Group 2844"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 width="28.642" height="25.532" viewBox="0 0 28.642 25.532">
                                                <path id="Path_194" data-name="Path 194"
                                                      d="M191.27,36.976l-17.542-3.712a1.383,1.383,0,0,0-1.635,1.064l-.333,2.142L192,40.753l.333-2.142A1.383,1.383,0,0,0,191.27,36.976Z"
                                                      transform="translate(-163.721 -33.234)"/>
                                                <path id="Path_195" data-name="Path 195"
                                                      d="M20.172,168.836a1.4,1.4,0,0,0-1.714-.969l-3.33.924L7.277,167.13l-.863,4.079-5.395,1.5A1.4,1.4,0,0,0,.05,174.42l3.04,10.955a1.4,1.4,0,0,0,1.714.969l17.439-4.839a1.4,1.4,0,0,0,.969-1.714l-.522-1.881,1.956.414a1.383,1.383,0,0,0,1.635-1.064l1.237-5.847-7.045-1.491Zm2.014,5.568.431-2.038a.569.569,0,0,1,.673-.438l2.038.432a.569.569,0,0,1,.438.673l-.431,2.038a.569.569,0,0,1-.673.438l-2.038-.431A.569.569,0,0,1,22.186,174.4Zm-20.863-.6,4.826-1.339,11.387-3.16,1.225-.34a.255.255,0,0,1,.067-.009.263.263,0,0,1,.25.188l.144.518.451,1.624L1.738,176.259l-.595-2.142A.261.261,0,0,1,1.323,173.8Zm20.8,6.295a.262.262,0,0,1-.179.317L4.5,185.251a.253.253,0,0,1-.067.009.263.263,0,0,1-.25-.188l-1.773-6.39L20.345,173.7l1.094,3.941Z"
                                                      transform="translate(0 -160.863)"/>
                                                <path id="Path_196" data-name="Path 196"
                                                      d="M92.208,445.017a.569.569,0,0,0-.7-.4l-2.037.565a.569.569,0,0,0-.395.7l.565,2.036a.569.569,0,0,0,.7.395l2.037-.565a.569.569,0,0,0,.4-.7Z"
                                                      transform="translate(-84.889 -425.349)"/>
                                            </svg>
                                            <span>{{__('client.'.$type->title )}}</span>
                                        </div>
                                    </div>

                                @endforeach

                            </div>

                            <!-- bank payment-->
                            @foreach($paymentTypes as $key => $type)
                                @if($type->title==='Credit Card')
                                    <div class="card-payment">
                                        <h2 class="bank-payment__title">{{__('client.choose_bank')}}</h2>

                                        <div class="bank-payment-radios">
                                            @foreach($type->banks as $key=>$bank)

                                                <div class="bank-payment-radio">
                                                    <div class="bank-payment-radio__content">
                                                        <img src="./img/icons/bog.png" alt="">
                                                        {{$bank->title}}
                                                    </div>

                                                    <input type="radio" value="{{$bank->id}}"
                                                           name="card_payment" {{$key == 0 ? 'checked' : ''}}>

                                                    <span class="bank-payment-radio__sign"> &check; </span>
                                                </div>
                                            @endforeach

                                        </div>

                                    </div>
                                @endif

                                @if($type->title==='Loan')
                                <!-- installment + volta installment form -- -->
                                    <div class="installment-payment hidden">

                                        <p class="installment__warning">საბანკო განვადების ყიდვის შემთხვევაში
                                            პროდუქტს
                                            ემატება
                                            5%</p>
                                        <h2 class="bank-payment__title">{{__('client.choose_bank')}}</h2>

                                        <!-- instalment radios-->
                                        <div class="bank-payment-radios">
                                            @foreach($type->banks as $key=>$bank)
                                                <div class="bank-payment-radio">
                                                    <div class="bank-payment-radio__content">
                                                        <img src="./img/icons/bog.png" alt="">
                                                        {{$bank->title}}
                                                    </div>

                                                    @if($bank->title==="Volta Loan")
                                                        <input type="radio" class="input-volta"
                                                               value="{{$bank->title}}"
                                                               name="installment_bank"
                                                               onclick="showVoltaForm('{{$bank->title}}')" {{$key == 0 ? 'checked' : ''}}>
                                                    @else
                                                        <input type="radio"
                                                               value="{{$bank->title}}"
                                                               name="installment_bank"
                                                               onclick="showVoltaForm('{{$bank->title}}')" {{$key == 0 ? 'checked' : ''}}>
                                                    @endif

                                                    <span class="bank-payment-radio__sign"> &check; </span>
                                                </div>
                                            @endforeach

                                        </div>

                                        <!-- show form if volta instalment is checked -->
                                        <div class="volta-installment-form hidden">
                                            <h3 class="volta-installment__title">შეავსეთ ინფორმაცია:</h3>

                                            <div class="volta-installment__flex-3">

                                                <div class="volta-installment__input">
                                                    <label for="loan_firstname">{{__('client.firstname')}}</label>
                                                    <input type="text" name="loan_firstname" id="loan_firstname"
                                                           placeholder="{{__('client.type_firstname')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label for="loan_lastname">{{__('client.lastname')}}</label>
                                                    <input type="text" name="loan_lastname" id="loan_lastname"
                                                           placeholder="{{__('client.type_lastname')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_personal_number">{{__('client.personal_number')}}</label>
                                                    <input type="number" name="loan_personal_number"
                                                           id="loan_personal_number"
                                                           placeholder="{{__('client.type_personal_number')}}">
                                                </div>


                                            </div>

                                            <div class="volta-installment__flex-2">
                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_jurisdiction_address">{{__('client.jurisdiction_address')}}</label>
                                                    <input type="text" name="loan_jurisdiction_address"
                                                           id="loan_jurisdiction_address"
                                                           placeholder="{{__('client.type_jurisdiction_address')}}">
                                                </div>

                                            </div>

                                            <div class="volta-installment__flex-3">

                                                <div class="volta-installment__input">
                                                    <label for="loan_phone">{{__('client.phone')}}</label>
                                                    <input type="number" name="loan_phone" id="loan_phone"
                                                           placeholder="{{__('client.type_phone')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_actual_address">{{__('client.actual_address')}}</label>
                                                    <input type="text" name="loan_actual_address"
                                                           id="loan_actual_address"
                                                           placeholder="{{__('client.type_actual_address')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label for="loan_job">{{__('client.job')}}</label>
                                                    <input type="text" name="loan_job" id="loan_job"
                                                           placeholder="{{__('client.type_job')}}">
                                                </div>

                                            </div>

                                            {{--                                                <p class="volta-installment__sub-title">პირადი ინფორმაცია:</p>--}}

                                            <div class="volta-installment__flex-3">
                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_job_address">{{__('client.job_address')}}</label>
                                                    <input type="text" name="loan_job_address" id="loan_job_address"
                                                           placeholder="{{__('client.type_job_address')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label for="loan_job_phone">{{__('client.job_phone')}}</label>
                                                    <input type="number" name="loan_job_phone" id="loan_job_phone"
                                                           placeholder="{{__('client.type_job_phone')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label for="loan_income">{{__('client.income')}}</label>
                                                    <input type="number" name="loan_income" id="loan_income"
                                                           placeholder="{{__('client.type_income')}}">
                                                </div>
                                            </div>


                                            <div class="volta-installment__flex-3">
                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_additional_income">{{__('client.additional_income')}}</label>
                                                    <input type="number" name="loan_additional_income"
                                                           id="loan_additional_income"
                                                           placeholder="{{__('client.type_additional_income')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_liabilities">{{__('client.liabilities')}}</label>
                                                    <input type="number" name="loan_liabilities"
                                                           id="loan_liabilities"
                                                           placeholder="{{__('client.type_liabilities')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_family_full_name">{{__('client.family_full_name')}}</label>
                                                    <input type="text" name="loan_family_full_name"
                                                           id="loan_family_full_name"
                                                           placeholder="{{__('client.type_family_full_name')}}">
                                                </div>

                                            </div>

                                            <div class="volta-installment__flex-3">

                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_family_phone">{{__('client.family_phone')}}</label>
                                                    <input type="number" name="loan_family_phone"
                                                           id="loan_family_phone"
                                                           placeholder="{{__('client.type_family_phone')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_family_1_full_name">{{__('client.family_1_full_name')}}</label>
                                                    <input type="text" name="loan_family_1_full_name"
                                                           id="loan_family_1_full_name"
                                                           placeholder="{{__('client.type_family_1_full_name')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_family_2_phone">{{__('client.family_2_phone')}}</label>
                                                    <input type="number" name="loan_family_2_phone"
                                                           id="loan_family_2_phone"
                                                           placeholder="{{__('client.type_family_2_phone')}}">
                                                </div>


                                            </div>

                                            <div class="volta-installment__flex-3">
                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_employee_full_name">{{__('client.employee_full_name')}}</label>
                                                    <input type="text" name="loan_employee_full_name"
                                                           id="loan_employee_full_name"
                                                           placeholder="{{__('client.type_employee_full_name')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_employee_phone">{{__('client.employee_phone')}}</label>
                                                    <input type="number" name="loan_employee_phone"
                                                           id="loan_employee_phone"
                                                           placeholder="{{__('client.type_employee_phone')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_friend_full_name">{{__('client.friend_full_name')}}</label>
                                                    <input type="text" name="loan_friend_full_name"
                                                           id="loan_friend_full_name"
                                                           placeholder="{{__('client.type_friend_full_name')}}">
                                                </div>
                                            </div>

                                            <div class="volta-installment__flex-3">
                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_friend_phone">{{__('client.friend_phone')}}</label>
                                                    <input type="number" name="loan_friend_phone"
                                                           id="loan_friend_phone"
                                                           placeholder="{{__('client.type_friend_phone')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_payment_day">{{__('client.payment_day')}}</label>
                                                    <input type="number" name="loan_payment_day"
                                                           id="loan_payment_day"
                                                           placeholder="{{__('client.type_payment_day')}}">
                                                </div>

                                                <div class="volta-installment__input">
                                                    <label
                                                        for="loan_month_total">{{__('client.month_total')}}</label>
                                                    <input type="number" name="loan_month_total"
                                                           id="loan_month_total"
                                                           placeholder="{{__('client.type_month_total')}}">
                                                </div>
                                            </div>
                                            <input id="loan_agreement" name="loan_agreement" type="checkbox">
                                            <label for="loan_agreement">
                                                {{__('client.agreement')}}
                                            </label>
                                            <h1>{{__('client.agreement_text')}}</h1>


                                            <!-- show this if inputs are empt -->
                                            <div class="pls-fill-all hidden">
                                                გთხოვთ შეავსოთ ყველა ველი
                                            </div>
                                        </div>


                                    </div>
                                @endif

                            @endforeach


                            <button type="button" onclick="validateVoltaForm()" id="submit-payment"
                                    class="last-steps-continue">
                                გაგრძელება
                            </button>

                        </div>


                        <!-- product list-->
                        <aside class="cart-item-aside">
                            <h2 class="cart-item-aside__title">{{__('client.cart')}}</h2>

                            @if(count($products) >0)
                                @foreach($products as $product)
                                    <div class="aside-card">

                                        <a href="" class="aside-card__link">
                                            <div class="aside-card__img flex-center">
                                                @if($product['file'] != '')
                                                    <img
                                                        src="{{url('storage/product/'.$product['id']. '/'.$product['file'])}}"
                                                        alt="">
                                                @else
                                                    <img src="{{url('noimage.png')}}" alt="">
                                                @endif
                                            </div>
                                            <h2 class="aside-card__name">
                                                {{$product['title']}}
                                            </h2>
                                        </a>

                                        <div class="aside-card__right">
                                            <div class="plus-minus-box ">
                                                <button class="qty_btn" type="button"
                                                        onclick="QuantityMinus(this,{{$product['id']}})"> -
                                                </button>

                                                <input type="number" name="qty" min="1" max="11"
                                                       value="{{$product['quantity']}}"
                                                       id="step-3-product-count-{{$product['id']}}" class="qty_input"
                                                       readonly="">

                                                <button class="qty_btn" type="button"
                                                        onclick="QuantityPlus(this,{{$product['id']}})">+
                                                </button>
                                            </div>

                                            <p class="aside-card__price">
                                                <span id="cart_3_product_total-step-{{$product['id']}}">{{($product['sale']) ?number_format((($product['sale']/100)*$product['quantity']),0) : number_format((($product['price']/100) * $product['quantity']),0)}}₾</span>
                                            </p>
                                        </div>

                                    </div>
                                @endforeach
                            @endif

                            <div class="cart-item-aside__costs my">
                                <p>{{__('client.product_price')}}:</p>
                                <span class="cost" id="step_3_product_price">{{$total? $total : 0}}₾</span>
                            </div>
                            <div class="cart-item-aside__costs">
                                <p>{{__('client.total')}}:</p>
                                <span class="total-cost" id="step_3_product_total">{{$total? $total+5 : 0}}₾</span>
                            </div>

                        </aside>

                    </div>
                </section>

            </div>

        </form>


    </main>
@endsection
