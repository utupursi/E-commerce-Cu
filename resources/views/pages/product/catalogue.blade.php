@extends('layouts.base')
@section('head')
    <title>Volta - {{(count($category->availableLanguage)> 0) ? $category->availableLanguage[0]->title : ''}}</title>
@endsection
@section('content')
    <form>
        <!-- section 1 - site path links  --->
        <section id="site-path-nav">
            <div class="container">
                <div class="site-path-nav__links">

                    <a href="{{route('welcome',app()->getLocale())}}">{{__('client.home_page')}}</a> &#47;
                    <a href="" onclick="return false;">{{count($category->availableLanguage) > 0 ? $category->availableLanguage[0]->title : ''}}</a>&#47;
                </div>
            </div>
        </section>

        <form class="range__form" action="{{route('Catalogue',[app()->getLocale(),$category->id])}}">

        <!-- section 1 - Catalogue  --->
        <section id="catalogue">
            <div class="container">
                <div class="cataloguesort">

                    <select class="cataloguesort-by" name="sort" id="" onchange="this.form.submit()">
                        <option value="new" {{(Request::get('sort') && Request::get('sort') == 'new') ? 'selected' : '' }}>{{__('client.new')}}</option>
                        <option value="price_asc" {{(Request::get('sort') && Request::get('sort') == 'price_asc') ? 'selected' : '' }}>{{__('client.price_asc')}}</option>
                        <option value="price_desc" {{(Request::get('sort') && Request::get('sort') == 'price_desc') ? 'selected' : '' }}>{{__('client.price_desc')}}</option>
                    </select>
                </div>
                <aside class="catalogue__filters">

                    <div class="catalogue__filters-top">
                        <h2 class="catalogue__filters-title">
                            {{__('client.category')}}
                        </h2>

                        <h3 class="catalogue__filters-selected">
                            {{count($category->availableLanguage) > 0 ? $category->availableLanguage[0]->title : ''}}

                        </h3>

                        <!-- price range form -->
                        <section class="range__form">
                            <div class="range-block">

                                <div class="price-range__title">
                                    {{__('client.price')}} ₾
                                </div>

                                <div class="price-range-meta">

                                    <div class="price-range-txt">
                                        <input type="number" name="minprice"
                                               value="{{Request::get('minprice') ? Request::get('minprice') : 0 }}"
                                               id="range-low-price">
                                        <input type="number" name="maxprice"
                                               value="{{Request::get('maxprice') ? Request::get('maxprice') : 10000}}"
                                               id="range-high-price">
                                    </div>
                                </div>

                                <div id="price-range"></div>
                            </div>
                            <button type="submit" class="range-filter-btn">
                                OK
                            </button>
                        </section>
                    </div>
                    @foreach($productFeatures as $child)
                        @if($child->feature->type !== 'input')
                            @continue
                        @endif
                        <div class="catalogue__accordion">
                            <div class="catalogue__accordion-tab closed">
                                <h2>{{(count($child->feature->availableLanguage) > 0) ?  $child->feature->availableLanguage[0]->title : ''}}</h2>
                                <i class="flex-center">
                                    <img src="/img/icons/arr-down.svg" alt="">
                                </i>
                            </div>
                            <div class="catalogue__accordion-content closed">
                                @foreach($child->feature->answer as $key=> $answer)
                                    @if(in_array($child->feature->slug,$staticFilterData))
                                        @if($answer->hasProducts($category->id) && $answer->status)
                                            <label class="checkbox">
                                                <input type="checkbox" class="inputs-search" name="feature[{{$child->feature->id}}][]"
                                                       onchange="this.form.submit()"
                                                       value="{{$answer->id}}"
                                                        @if(isset(Request::get('feature')[$child->feature->id]))
                                                            {{in_array($answer->id,Request::get('feature')[$child->feature->id]) ? 'checked' : ''}}
                                                        @endif
                                                >
                                                <span></span>
                                                {{(count($answer->availableLanguage) > 0) ?  $answer->availableLanguage[0]->title : ''}}
                                            </label>
                                        @endif
                                    @else
                                        @if($answer->status && (in_array($answer->id,$productAnswers)))
                                            <label class="checkbox">
                                                <input type="checkbox" class="inputs-search" name="feature[{{$child->feature->id}}][]"
                                                       onchange="this.form.submit()"
                                                       value="{{$answer->id}}"
                                                            @if(isset(Request::get('feature')[$child->feature->id]))
                                                                {{in_array($answer->id,Request::get('feature')[$child->feature->id]) ? 'checked' : ''}}
                                                            @endif
                                                >
                                                <span></span>
                                                {{(count($answer->availableLanguage) > 0) ?  $answer->availableLanguage[0]->title : ''}}
                                            </label>
                                        @endif
                                    @endif

                                @endforeach

                            </div>
                        </div>

                    @endforeach


                    <a class="clear-filters" href="{{route('Catalogue',[app()->getLocale(),$category->id])}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17.237" height="13.79"
                             viewBox="0 0 17.237 13.79">
                            <path id="Icon_material-delete-sweep" data-name="Icon material-delete-sweep"
                                  d="M14.2,16.342h3.447v1.724H14.2Zm0-6.895h6.033v1.724H14.2Zm0,3.447h5.171v1.724H14.2ZM3.862,18.066A1.729,1.729,0,0,0,5.586,19.79h5.171a1.729,1.729,0,0,0,1.724-1.724V9.447H3.862Zm9.481-11.2H10.757L9.895,6H6.447l-.862.862H3V8.586H13.342Z"
                                  transform="translate(-3 -6)"/>
                        </svg>
                        {{__('client.clear_filter')}}
                    </a>

                </aside>

                <!-- products grid-->
                <div class="catalogue-right">

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

                                        <a href="{{route('productDetails',[app()->getLocale(),$category->id,$product->id])}}" class="card-link">
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

     </form>
    </main>
@endsection
