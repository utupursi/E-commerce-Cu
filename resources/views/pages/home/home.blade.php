@extends('layouts.base')
@section('head')
    <title>{{__('app.title_home')}}</title>
@endsection

@section('content')
    <!-- Main Slider Start -->
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <nav class="navbar bg-light">
                        <ul class="navbar-nav">
                            @foreach($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="{{route('Catalogue',[app()->getLocale(),$category->id])}}">
                                        @if(isset($category->files[0]))
                                            <img style="width:20px"
                                                 src="/storage/category/{{$category->files[0]->fileable_id}}/{{$category->files[0]->name}}"
                                                 alt="">
                                        @endif
                                        {{(count($category->availableLanguage) > 0) ?  $category->availableLanguage[0]->title : ''}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>
                <div class="col-md-6">
                    <div class="header-slider normal-slider">
                        @foreach($sliders as $slider)
                            @if($slider->type === 'slider' && $slider->status)
                                {{--                                <a href="{{$slider->redirect_url}}" class="hero-slide">--}}
                                {{--                                    @if(isset($slider->files[0]))--}}
                                {{--                                        <img class="img-cover" src="/storage/slider/{{$slider->id}}/{{$slider->files[0]->name}}"--}}
                                {{--                                             alt="">--}}
                                {{--                                    @endif--}}
                                {{--                                </a>--}}
                                <div class="header-slider-item">
                                    @if(isset($slider->files[0]))
                                        <img src="/storage/slider/{{$slider->id}}/{{$slider->files[0]->name}}"
                                             alt="">
                                    @endif
                                    {{--                                    <div class="header-slider-caption">--}}
                                    {{--                                        <p>Some text goes here that describes the image</p>--}}
                                    {{--                                        <a class="btn" href="{{$slider->redirect_url}}"><i class="fa fa-shopping-cart"></i>Shop Now</a>--}}
                                    {{--                                    </div>--}}
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="header-img">
                        <div class="img-item">
                            <img src="img/category-1.jpg"/>
                            <a class="img-text" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>
                        <div class="img-item">
                            <img src="img/category-2.jpg"/>
                            <a class="img-text" href="">
                                <p>Some text goes here that describes the image</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Slider End -->

    <!-- Brand Start -->
    <div class="brand">
        <div class="container-fluid">
            <div class="brand-slider">
                @foreach($brands as $brand)
                    @if(isset($brand->files[0]))
                        <div class="brand-item"><img src="/storage/brand/{{$brand->id}}/{{$brand->files[0]->name}}"
                                                     alt=""></div>
                    @endif
                    {{--                    <a {{$brand->redirect_url?'href='.$brand->redirect_url:""}}>--}}
                    {{--                        @if(isset($brand->files[0]))--}}
                    {{--                            <img src="/storage/brand/{{$brand->id}}/{{$brand->files[0]->name}}" alt="">--}}
                    {{--                        @endif--}}
                    {{--                    </a>--}}
                @endforeach
                {{--                <div class="brand-item"><img src="img/brand-1.png" alt=""></div>--}}
                {{--                <div class="brand-item"><img src="img/brand-2.png" alt=""></div>--}}
                {{--                <div class="brand-item"><img src="img/brand-3.png" alt=""></div>--}}
                {{--                <div class="brand-item"><img src="img/brand-4.png" alt=""></div>--}}
                {{--                <div class="brand-item"><img src="img/brand-5.png" alt=""></div>--}}
                {{--                <div class="brand-item"><img src="img/brand-6.png" alt=""></div>--}}
            </div>
        </div>
    </div>
    <!-- Brand End -->

    <!-- Feature Start-->
    <div class="feature">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fab fa-cc-mastercard"></i>
                        <h2>Secure Payment</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur elit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-truck"></i>
                        <h2>Worldwide Delivery</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur elit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-sync-alt"></i>
                        <h2>90 Days Return</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur elit
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-comments"></i>
                        <h2>24/7 Support</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur elit
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End-->

    <!-- Category Start-->
    {{--    <div class="category">--}}
    {{--        <div class="container-fluid">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-3">--}}
    {{--                    <div class="category-item ch-400">--}}
    {{--                        <img src="img/category-3.jpg"/>--}}
    {{--                        <a class="category-name" href="">--}}
    {{--                            <p>Some text goes here that describes the image</p>--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-3">--}}
    {{--                    <div class="category-item ch-250">--}}
    {{--                        <img src="img/category-4.jpg"/>--}}
    {{--                        <a class="category-name" href="">--}}
    {{--                            <p>Some text goes here that describes the image</p>--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                    <div class="category-item ch-150">--}}
    {{--                        <img src="img/category-5.jpg"/>--}}
    {{--                        <a class="category-name" href="">--}}
    {{--                            <p>Some text goes here that describes the image</p>--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-3">--}}
    {{--                    <div class="category-item ch-150">--}}
    {{--                        <img src="img/category-6.jpg"/>--}}
    {{--                        <a class="category-name" href="">--}}
    {{--                            <p>Some text goes here that describes the image</p>--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                    <div class="category-item ch-250">--}}
    {{--                        <img src="img/category-7.jpg"/>--}}
    {{--                        <a class="category-name" href="">--}}
    {{--                            <p>Some text goes here that describes the image</p>--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-3">--}}
    {{--                    <div class="category-item ch-400">--}}
    {{--                        <img src="img/category-8.jpg"/>--}}
    {{--                        <a class="category-name" href="">--}}
    {{--                            <p>Some text goes here that describes the image</p>--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!-- Category End-->

    <!-- Call to Action Start -->
    <div class="call-to-action">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1>call us for any queries</h1>
                </div>
                <div class="col-md-6">
                    <a href="tel:0123456789">+012-345-6789</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action End -->

    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="section-header">
                <h1>Featured Product</h1>
            </div>
            <div class="row align-items-center product-slider product-slider-4">
                @foreach($discountedProducts as $product)
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
                                    <a href="{{route('productDetails',[app()->getLocale(),$product->category_id,$product->id])}}"><i class="fa fa-search"></i></a>
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
                                <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Featured Product End -->

    <!-- Newsletter Start -->
    <div class="newsletter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>Subscribe Our Newsletter</h1>
                </div>
                <div class="col-md-6">
                    <div class="form">
                        <input type="email" value="Your email here">
                        <button>Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->

    <!-- Recent Product Start -->
    <div class="recent-product product">
        <div class="container-fluid">
            <div class="section-header">
                <h1>Recent Product</h1>
            </div>
            @include('pages.newly-added.index')
        </div>
    </div>
    <!-- Recent Product End -->

    <!-- Review Start -->
{{--    <div class="review">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row align-items-center review-slider normal-slider">--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="review-slider-item">--}}
{{--                        <div class="review-img">--}}
{{--                            <img src="img/review-1.jpg" alt="Image">--}}
{{--                        </div>--}}
{{--                        <div class="review-text">--}}
{{--                            <h2>Customer Name</h2>--}}
{{--                            <h3>Profession</h3>--}}
{{--                            <div class="ratting">--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                            </div>--}}
{{--                            <p>--}}
{{--                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc eget leo--}}
{{--                                finibus luctus et vitae lorem--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="review-slider-item">--}}
{{--                        <div class="review-img">--}}
{{--                            <img src="img/review-2.jpg" alt="Image">--}}
{{--                        </div>--}}
{{--                        <div class="review-text">--}}
{{--                            <h2>Customer Name</h2>--}}
{{--                            <h3>Profession</h3>--}}
{{--                            <div class="ratting">--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                            </div>--}}
{{--                            <p>--}}
{{--                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc eget leo--}}
{{--                                finibus luctus et vitae lorem--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="review-slider-item">--}}
{{--                        <div class="review-img">--}}
{{--                            <img src="img/review-3.jpg" alt="Image">--}}
{{--                        </div>--}}
{{--                        <div class="review-text">--}}
{{--                            <h2>Customer Name</h2>--}}
{{--                            <h3>Profession</h3>--}}
{{--                            <div class="ratting">--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                                <i class="fa fa-star"></i>--}}
{{--                            </div>--}}
{{--                            <p>--}}
{{--                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae nunc eget leo--}}
{{--                                finibus luctus et vitae lorem--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- Review End -->
@endsection
