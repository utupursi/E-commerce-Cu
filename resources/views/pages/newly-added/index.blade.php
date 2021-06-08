<section id="newly-added">

    <div class="container">

        <div class="cards-block">
            <div class="cards-block__header">
                <h2>{{__('client.last_added')}}</h2>

                <div class="cards-block__tabs">
                    @foreach($newProductsCategory as $key=>$category)
                        <p hidden class="categoryId">{{$key}}</p>
                        <button onclick="switchTab(this)"
                                class="tab-btn">{{$category}}</button>
                        <p hidden class="type">lastAdded</p>
                    @endforeach
                </div>
            </div>

            <!-- product card  slider (minimum 6 item) -->
            <div class="product-card-slider">
                @foreach($newProducts as $product)
                    <div class="card">
                        <div class="card__wrapper">
                            @if($product->sale && $product->sale_price!==null)
                            <div class="card__banner">
                                    {{round((($product->price-$product->sale_price)*100)/$product->price)}}%
                            </div>
                            @endif

                            <a href="{{route('productDetails',[app()->getLocale(),$product->category_id,$product->id])}}" class="card-link">
                                <div class="card-img">
                                    @if(isset($product->files[0]))
                                        <img class="img-cover"
                                             src="/storage/product/{{$product->files[0]->fileable_id}}/{{$product->files[0]->name}}"
                                             alt="">
                                    @endif
                                </div>

                                <div class="card__info">
                                    <h2 class="card__title">
                                        {{(count($product->availableLanguage) > 0) ?  $product->availableLanguage[0]->title : ''}}
                                    </h2>

                                    <div class="card__pricing">
                                        @if($product->sale && $product->sale_price != null)
                                            <h3 class="cur-p">{{$product->sale_price/100}} ₾</h3>
                                            <h3 class="old-p">{{$product->price/100}} ₾</h3>
                                        @else
                                            <h3 class="cur-p">{{$product->price/100}} ₾</h3>
                                        @endif
                                    </div>


                                    <div class="card__brand">
                                        {{(count($product->availableLanguage) > 0) ?  $product->availableLanguage[0]->description : ''}}
                                    </div>
                                </div>
                            </a>

                            <div class="card__bottom">
                                <button class="card-add-btn" onclick="addToCart(this, '{{$product->id}}')">
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

            </div>

        </div>
    </div>
</section>
