@extends('layouts.base')
@section('head')
    <title>Volta - Search</title>
@endsection
@section('content')
    <form>
        <!-- section 1 - site path links  --->
        <section id="site-path-nav">
            <div class="container">
                <div class="site-path-nav__links">

                    <a href="{{route('welcome',app()->getLocale())}}">{{__('client.home_page')}}</a> &#47;
                </div>
            </div>
        </section>

        <!-- section 1 - Catalogue  --->
        <section id="catalogue">
            <div class="container">
                <!-- products grid-->
                <div class="catalogue-right catalogue-search">

                    <div class="catalogue__grid">
                        @if(count($products) > 0)
                            @foreach($products as $product)
                                <div class="card">
                                    <div class="card__wrapper">

                                        @if($product->sale && $product->sale_price != null)
                                            <div class="card__banner">
                                                {{number_format((($product->price-$product->sale_price)/$product->price)*100,0)}}
                                                %
                                            </div>
                                        @endif

                                        <a href="{{route('productDetails',[app()->getLocale(),$product->category_id,$product->id])}}" class="card-link">
                                            <div class="card-img">
                                                @if(count($product->files) > 0)
                                                    <img class="img-cover"
                                                         src="{{url('storage/product/'.$product->id. '/'.$product->files[0]->name)}}">
                                                @else
                                                    <img class="img-cover" src="{{url('noimage.png')}}">
                                                @endif
                                            </div>

                                            <div class="card__info">
                                                <h2 class="card__title">
                                                    {{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : ''}}
                                                </h2>
                                                @if($product->sale && $product->sale_price != null)
                                                    <div class="card__pricing">
                                                        <h3 class="cur-p">{{$product->sale_price / 100 }} ₾</h3>
                                                        <h3 class="old-p">{{$product->price / 100}} ₾</h3>
                                                    </div>
                                                @else
                                                    <div class="card__pricing">
                                                        <h3 class="cur-p">{{$product->price / 100 }} ₾</h3>
                                                    </div>
                                                @endif


                                                <div class="card__brand">
                                                    {{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->description : ''}}
                                                </div>
                                            </div>
                                        </a>

                                        <div class="card__bottom">
                                            <button class="card-add-btn" type="button" onclick="addToCart(this, '{{$product->id}}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18.414" height="17.008"
                                                     viewBox="0 0 18.414 17.008">
                                                    <g id="Icon_ionic-ios-cart" data-name="Icon ionic-ios-cart"
                                                       transform="translate(-3.382 -4.493)">
                                                        <path id="Path_24" data-name="Path 24"
                                                              d="M11.688,29.188a1.063,1.063,0,1,1-1.063-1.063A1.063,1.063,0,0,1,11.688,29.188Z"
                                                              transform="translate(-2.288 -8.749)"/>
                                                        <path id="Path_25" data-name="Path 25"
                                                              d="M27.473,29.188a1.063,1.063,0,1,1-1.063-1.063,1.063,1.063,0,0,1,1.063,1.063Z"
                                                              transform="translate(-8.132 -8.749)"/>
                                                        <path id="Path_26" data-name="Path 26"
                                                              d="M21.79,7.517a.26.26,0,0,0-.23-.186L7.137,5.936A.444.444,0,0,1,6.8,5.728a4.509,4.509,0,0,0-.54-.824c-.341-.416-.983-.4-2.161-.412a.645.645,0,0,0-.722.624.633.633,0,0,0,.691.624,5.883,5.883,0,0,1,1.151.084c.208.062.376.4.438.7a.016.016,0,0,0,0,.013c.009.053.089.452.089.456l1.771,9.37a3.444,3.444,0,0,0,.642,1.581,1.767,1.767,0,0,0,1.457.717H20.1a.629.629,0,0,0,.638-.593.617.617,0,0,0-.62-.647H9.617a.515.515,0,0,1-.368-.124,1.987,1.987,0,0,1-.509-1.151L8.55,15.1a.024.024,0,0,1,.018-.027l12.3-2.081a.259.259,0,0,0,.217-.23l.708-5.128A.253.253,0,0,0,21.79,7.517Z"/>
                                                    </g>
                                                </svg>
                                                {{__('client.add_to_cart')}}
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        @else
                            <div class="no-result" style="padding: 20%">
                                <h1>{{__('client.no_search_result')}}</h1>
                            </div>
                        @endif
                    </div>
                    {{$products->appends(request()->input())->links('vendor.pagination.custom')}}
                </div>
            </div>
        </section>
        </main>

@endsection
