<div class="row align-items-center product-slider product-slider-4">
    @foreach($latestProducts as $product)
        <div class="col-lg-3">
            <div class="product-item">
                <div class="product-title">
                    <a href="#">{{(count($product->availableLanguage) > 0) ?  $product->availableLanguage[0]->title : ''}}</a>
                    <div class="ratting">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                </div>
                <div class="product-image">
                    @if(isset($product->files[0]))
                        <img style="object-fit: contain;"
                             src="/storage/product/{{$product->files[0]->fileable_id}}/{{$product->files[0]->name}}"
                             alt="Product Image">
                    @endif
                    {{--                            <a href="product-detail.html">--}}
                    {{--                                <img src="img/product-1.jpg" alt="Product Image">--}}
                    {{--                            </a>--}}
                    <div class="product-action">
                        <a href="#" onclick="addToCart(this, '{{$product->id}}')"><i class="fa fa-cart-plus"></i></a>
                        <a href="#"><i class="fa fa-heart"></i></a>
                        <a href="{{route('productDetails',[app()->getLocale(),$product->category_id,$product->id])}}"><i
                                class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="product-price">
                    <h3>
                        @if($product->sale && $product->sale_price!=null)
                            $ {{$product->sale_price/100}}
                            <span style="text-decoration: line-through;color:red">${{$product->price/100}}</span>
                        @else
                            $ {{$product->price/100}}
                        @endif
                    </h3>
                    <br>
                    <a class="btn" href="{{route('productBuy',[app()->getLocale(),$product->id])}}"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                </div>
            </div>
        </div>
    @endforeach

</div>
