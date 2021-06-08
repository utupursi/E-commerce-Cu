@extends('layouts.base')
@section('head')
    <title>{{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : ''}}</title>
    <meta property="og:url" content="https://volta.ge/{{app()->getLocale()}}/catalogue/{{$product->category_id}}/details/{{$product->id}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : ''}}"/>
    <meta property="og:description" content="{{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->description : ''}}"/>
    @if(isset($product->files[0]))
        <meta property="og:image"
              content="https://volta.ge/storage/product/{{$product->files[0]->fileable_id}}/{{$product->files[0]->name}}"/>
    @endif
    {{--    <meta property="og:image"         content="https://volta.ge/storage/product/168/2021021154HD-400RWE1N(ST).png" />--}}
@endsection
@section('content')
    <main>
        <!-- section 1 - site path links  --->
        <section id="site-path-nav">
            <div class="container">
                <div class="site-path-nav__links">
                    <a href="{{route('welcome',app()->getLocale())}}">{{__('client.home_page')}}</a> &#47;
                    <a href="{{route('Catalogue',[app()->getLocale(),$product->category->id])}}">{{count($product->category->availableLanguage) > 0 ? $product->category->availableLanguage[0]->title : ''}}</a>&#47;
                    <a href=""
                       onclick="return false;">{{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : ''}}</a>
                </div>
            </div>
        </section>


        <!-- section 1 - product details  --->
        <section id="details">
            <div class="container">

                <div class="details__wrapper">

                    <div class="details__preview">
                        @if(count($product->files) > 0)
                            @foreach($product->files as  $key => $file)
                                <div class="big-img-box {{($key == 0) ? 'shown' : ''}}">
                                    <img
                                        src="{{asset('../storage/product/'.$product->id.'/'.$product->files[$key]->name)}}"
                                        alt="">
                                    <div class="big-img-overlay">
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                             data-icon="search-plus" class="svg-inline--fa fa-search-plus fa-w-16"
                                             role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="#fff"
                                                  d="M304 192v32c0 6.6-5.4 12-12 12h-56v56c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-56h-56c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h56v-56c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v56h56c6.6 0 12 5.4 12 12zm201 284.7L476.7 505c-9.4 9.4-24.6 9.4-33.9 0L343 405.3c-4.5-4.5-7-10.6-7-17V372c-35.3 27.6-79.7 44-128 44C93.1 416 0 322.9 0 208S93.1 0 208 0s208 93.1 208 208c0 48.3-16.4 92.7-44 128h16.3c6.4 0 12.5 2.5 17 7l99.7 99.7c9.3 9.4 9.3 24.6 0 34zM344 208c0-75.2-60.8-136-136-136S72 132.8 72 208s60.8 136 136 136 136-60.8 136-136z"></path>
                                        </svg>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="big-img-box shown">
                                <img src="{{url('noimage.png')}}"
                                     alt="">
                                <div class="big-img-overlay">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                         data-icon="search-plus" class="svg-inline--fa fa-search-plus fa-w-16"
                                         role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="#fff"
                                              d="M304 192v32c0 6.6-5.4 12-12 12h-56v56c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-56h-56c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h56v-56c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v56h56c6.6 0 12 5.4 12 12zm201 284.7L476.7 505c-9.4 9.4-24.6 9.4-33.9 0L343 405.3c-4.5-4.5-7-10.6-7-17V372c-35.3 27.6-79.7 44-128 44C93.1 416 0 322.9 0 208S93.1 0 208 0s208 93.1 208 208c0 48.3-16.4 92.7-44 128h16.3c6.4 0 12.5 2.5 17 7l99.7 99.7c9.3 9.4 9.3 24.6 0 34zM344 208c0-75.2-60.8-136-136-136S72 132.8 72 208s60.8 136 136 136 136-60.8 136-136z"></path>
                                    </svg>
                                </div>
                            </div>
                        @endif


                        <div class="big-img-thumbs">
                            @if(count($product->files) > 0)
                                @foreach($product->files as  $key => $file)
                                    <div class="img-thumb active ">
                                        <img
                                            src="{{asset('../storage/product/'.$product->id.'/'.$product->files[$key]->name)}}"
                                            alt="">
                                    </div>
                                @endforeach
                            @else
                                <div class="img-thumb active ">
                                    <img src="{{url('noimage.png')}}"
                                         alt="">
                                </div>

                            @endif
                        </div>
                    </div>

                    <div class="details__complete-info">
                        <div class="complete-info__top">
                            <div class="product-id">ID {{$product->id}}</div>
                            @if($product->sale && $product->sale_price != null)
                                <div class="product-sale-percent">
                                    {{number_format((($product->price - $product->sale_price)/$product->price)*100,0)}}%
                                </div>
                            @endif

                            <div class="share-product">
                                <p>{{__('client.share')}}</p>
                                <div class="share-social">
                                    <div class="fb-share-button"
                                         data-href="https://volta.ge/{{app()->getLocale()}}/catalogue/{{$product->category_id}}/details/{{$product->id}}"
                                         data-layout="button"
                                         data-size="large">
                                    </div>
                                    <a onclick="myFunction()"><img src="/img/icons/svg-link.svg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="details__title">
                            {{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : ''}}
                        </div>

                        <div class="prices-actions">
                            <div class="price-col">
                                @if($product->sale && $product->sale_price != null)
                                    <div class="current-price">{{$product->sale_price / 100 }}₾</div>
                                    <div class="old-price">{{$product->price / 100 }}₾</div>
                                @else
                                    <div class="current-price">{{$product->price / 100 }}₾</div>

                                @endif

                            </div>

                            <button class="details__add-to-cart" onclick="addToCart(this, '{{$product->id}}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16.259" height="15.018"
                                     viewBox="0 0 16.259 15.018">
                                    <g id="Icon_ionic-ios-cart" data-name="Icon ionic-ios-cart"
                                       transform="translate(-3.382 -4.493)">
                                        <path id="Path_1" data-name="Path 1"
                                              d="M11.439,29.063a.938.938,0,1,1-.938-.938A.938.938,0,0,1,11.439,29.063Z"
                                              transform="translate(-2.744 -10.491)"></path>
                                        <path id="Path_2" data-name="Path 2"
                                              d="M27.224,29.063a.938.938,0,1,1-.938-.938A.938.938,0,0,1,27.224,29.063Z"
                                              transform="translate(-9.751 -10.491)"></path>
                                        <path id="Path_3" data-name="Path 3"
                                              d="M19.635,7.163a.23.23,0,0,0-.2-.164L6.7,5.768A.392.392,0,0,1,6.4,5.584a3.981,3.981,0,0,0-.477-.727c-.3-.368-.868-.356-1.908-.364a.57.57,0,0,0-.637.551.559.559,0,0,0,.61.551,5.2,5.2,0,0,1,1.017.074c.184.055.332.356.387.618a.014.014,0,0,0,0,.012c.008.047.078.4.078.4l1.564,8.273a3.041,3.041,0,0,0,.567,1.4A1.56,1.56,0,0,0,8.895,17h9.251a.556.556,0,0,0,.563-.524.545.545,0,0,0-.547-.571H8.887a.454.454,0,0,1-.325-.109,1.755,1.755,0,0,1-.45-1.017l-.168-.927a.021.021,0,0,1,.016-.023L18.818,12a.228.228,0,0,0,.192-.2l.626-4.528A.223.223,0,0,0,19.635,7.163Z"></path>
                                    </g>
                                </svg>
                                {{__('client.add_to_cart')}}
                            </button>

                            <a class="buy-item"
                               href="{{route('productBuy',[app()->getLocale(),$product->id])}}">{{__('client.buy')}}</a>

                        </div>

                        <div class="details-divider"></div>

                        <h3 class="description-title">{{__('client.short_description')}}</h3>

                        <p class="details-description">
                            {!! (count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->content : '' !!}
                        </p>


                    </div>

                    <!-- additational info-->
                    <div class="details__addidational-info">

                        <h2 class="addidational-info__title">
                            {{__('client.product_details')}}
                        </h2>
                        <ul class="addidational-info__list">
                            @foreach($product->answers as $key => $answer)
                                <li>
                                    @if(count($answer->feature->availableLanguage) > 0)
                                        @if($key > 0)
                                            @if(count($product->answers[$key-1]->feature->availableLanguage) > 0)
                                                @if($product->answers[$key-1]->feature->availableLanguage[0]->title === $answer->feature->availableLanguage[0]->title)
                                                    <span></span>
                                                @else
                                                    <span>{{$answer->feature->availableLanguage[0]->title}}:</span>
                                                @endif
                                            @else
                                                <span>{{$answer->feature->availableLanguage[0]->title}}:</span>
                                            @endif
                                        @else
                                            <span>{{$answer->feature->availableLanguage[0]->title}}:</span>
                                        @endif
                                    @endif
                                    @if(count($answer->answer->availableLanguage) > 0)
                                        <span>{{$answer->answer->availableLanguage[0]->title}}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>


                </div>

            </div>
        </section>

        <!-- section 2 - similar products -->
    @include('pages.newly-added.index')

    <!-- img preview modal-->
        <div class="picture-modal">

            <div class="modal-img-content">
            <span class="close-img-modal">
                <img src="/img/icons/svg-close-circle (1).svg" alt="">
            </span>

                <img id="modal-img" src="" alt="product-picture">
            </div>
        </div>
    </main>

@endsection
