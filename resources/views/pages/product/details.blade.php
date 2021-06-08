@extends('layouts.base')
@section('head')
    <title>{{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : ''}}</title>
    <meta property="og:url"
          content="https://volta.ge/{{app()->getLocale()}}/catalogue/{{$product->category_id}}/details/{{$product->id}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title"
          content="{{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : ''}}"/>
    <meta property="og:description"
          content="{{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->description : ''}}"/>
    @if(isset($product->files[0]))
        <meta property="og:image"
              content="https://volta.ge/storage/product/{{$product->files[0]->fileable_id}}/{{$product->files[0]->name}}"/>
    @endif
    {{--    <meta property="og:image"         content="https://volta.ge/storage/product/168/2021021154HD-400RWE1N(ST).png" />--}}
@endsection
@section('content')
    <div class="product-detail">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product-detail-top">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                {{--                                @if(count($product->files) > 0)--}}
                                {{--                                    @foreach($product->files as  $key => $file)--}}
                                {{--                                        <div class="big-img-box {{($key == 0) ? 'shown' : ''}}">--}}
                                {{--                                            <img--}}
                                {{--                                                src="{{asset('../storage/product/'.$product->id.'/'.$product->files[$key]->name)}}"--}}
                                {{--                                                alt="">--}}
                                {{--                                            <div class="big-img-overlay">--}}
                                {{--                                                <svg aria-hidden="true" focusable="false" data-prefix="fas"--}}
                                {{--                                                     data-icon="search-plus" class="svg-inline--fa fa-search-plus fa-w-16"--}}
                                {{--                                                     role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">--}}
                                {{--                                                    <path fill="#fff"--}}
                                {{--                                                          d="M304 192v32c0 6.6-5.4 12-12 12h-56v56c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-56h-56c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h56v-56c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v56h56c6.6 0 12 5.4 12 12zm201 284.7L476.7 505c-9.4 9.4-24.6 9.4-33.9 0L343 405.3c-4.5-4.5-7-10.6-7-17V372c-35.3 27.6-79.7 44-128 44C93.1 416 0 322.9 0 208S93.1 0 208 0s208 93.1 208 208c0 48.3-16.4 92.7-44 128h16.3c6.4 0 12.5 2.5 17 7l99.7 99.7c9.3 9.4 9.3 24.6 0 34zM344 208c0-75.2-60.8-136-136-136S72 132.8 72 208s60.8 136 136 136 136-60.8 136-136z"></path>--}}
                                {{--                                                </svg>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    @endforeach--}}
                                {{--                                @else--}}
                                {{--                                    <div class="big-img-box shown">--}}
                                {{--                                        <img src="{{url('noimage.png')}}"--}}
                                {{--                                             alt="">--}}
                                {{--                                        <div class="big-img-overlay">--}}
                                {{--                                            <svg aria-hidden="true" focusable="false" data-prefix="fas"--}}
                                {{--                                                 data-icon="search-plus" class="svg-inline--fa fa-search-plus fa-w-16"--}}
                                {{--                                                 role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">--}}
                                {{--                                                <path fill="#fff"--}}
                                {{--                                                      d="M304 192v32c0 6.6-5.4 12-12 12h-56v56c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-56h-56c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h56v-56c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v56h56c6.6 0 12 5.4 12 12zm201 284.7L476.7 505c-9.4 9.4-24.6 9.4-33.9 0L343 405.3c-4.5-4.5-7-10.6-7-17V372c-35.3 27.6-79.7 44-128 44C93.1 416 0 322.9 0 208S93.1 0 208 0s208 93.1 208 208c0 48.3-16.4 92.7-44 128h16.3c6.4 0 12.5 2.5 17 7l99.7 99.7c9.3 9.4 9.3 24.6 0 34zM344 208c0-75.2-60.8-136-136-136S72 132.8 72 208s60.8 136 136 136 136-60.8 136-136z"></path>--}}
                                {{--                                            </svg>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                @endif--}}
                                <div class="product-slider-single normal-slider">
                                    @foreach($product->files as  $key => $file)
                                        <img
                                            src="{{asset('../storage/product/'.$product->id.'/'.$product->files[$key]->name)}}"
                                            alt="Product Image">
                                        {{--                                        <div class="big-img-box {{($key == 0) ? 'shown' : ''}}">--}}
                                        {{--                                            <img--}}
                                        {{--                                                src="{{asset('../storage/product/'.$product->id.'/'.$product->files[$key]->name)}}"--}}
                                        {{--                                                alt="">--}}
                                        {{--                                            <div class="big-img-overlay">--}}
                                        {{--                                                <svg aria-hidden="true" focusable="false" data-prefix="fas"--}}
                                        {{--                                                     data-icon="search-plus" class="svg-inline--fa fa-search-plus fa-w-16"--}}
                                        {{--                                                     role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">--}}
                                        {{--                                                    <path fill="#fff"--}}
                                        {{--                                                          d="M304 192v32c0 6.6-5.4 12-12 12h-56v56c0 6.6-5.4 12-12 12h-32c-6.6 0-12-5.4-12-12v-56h-56c-6.6 0-12-5.4-12-12v-32c0-6.6 5.4-12 12-12h56v-56c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v56h56c6.6 0 12 5.4 12 12zm201 284.7L476.7 505c-9.4 9.4-24.6 9.4-33.9 0L343 405.3c-4.5-4.5-7-10.6-7-17V372c-35.3 27.6-79.7 44-128 44C93.1 416 0 322.9 0 208S93.1 0 208 0s208 93.1 208 208c0 48.3-16.4 92.7-44 128h16.3c6.4 0 12.5 2.5 17 7l99.7 99.7c9.3 9.4 9.3 24.6 0 34zM344 208c0-75.2-60.8-136-136-136S72 132.8 72 208s60.8 136 136 136 136-60.8 136-136z"></path>--}}
                                        {{--                                                </svg>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                    @endforeach

                                </div>
                                <div class="product-slider-single-nav normal-slider">
                                    @foreach($product->files as  $key => $file)
                                        <div class="slider-nav-img">
                                            <img
                                                src="{{asset('../storage/product/'.$product->id.'/'.$product->files[$key]->name)}}"
                                                alt="Product Image">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="product-content">
                                    <div class="title">
                                        <h2>{{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : ''}}</h2>
                                    </div>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="price">
                                        <h4>Price:</h4>
                                        @if($product->sale && $product->sale_price != null)
                                            <p>$ {{$product->sale_price / 100 }}
                                                <span>$ {{$product->price / 100 }}</span></p>
                                        @else
                                            <p>$ {{$product->price / 100 }} </p>
                                        @endif

                                    </div>
                                    @foreach($product->answers as $key => $answer)
                                        <div class="p-size">

                                            @if(count($answer->feature->availableLanguage) > 0)
                                                @if($key > 0)
                                                    @if(count($product->answers[$key-1]->feature->availableLanguage) > 0)
                                                        @if($product->answers[$key-1]->feature->availableLanguage[0]->title === $answer->feature->availableLanguage[0]->title)
                                                            {{--                                                            <h4></h4>--}}
                                                        @else
                                                            <h4>{{$answer->feature->availableLanguage[0]->title}}:</h4>
                                                            <br>
                                                        @endif
                                                    @else
                                                        <h4>{{$answer->feature->availableLanguage[0]->title}}:</h4>
                                                        <br>
                                                    @endif
                                                @else
                                                    <h4>{{$answer->feature->availableLanguage[0]->title}}:</h4>
                                                    <br>
                                                @endif
                                            @endif
                                            @if(count($answer->answer->availableLanguage) > 0)
                                                <span>{{$answer->answer->availableLanguage[0]->title}}</span>
                                            @endif
                                        </div>
                                    @endforeach
                                    <div class="action">
                                        <a class="btn" href="#"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
                                        <a class="btn" href="#"><i class="fa fa-shopping-bag"></i>Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row product-detail-bottom">
                        <div class="col-lg-12">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#short-description">Short
                                        Description</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="description" class="container tab-pane active">
                                    <h4>Product description</h4>
                                    <p>
                                        {!! (count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->content : '' !!}
                                    </p>
                                </div>
                                <div id="short-description" class="container tab-pane active">
                                    <h4>Short description</h4>
                                    <p>
                                        {!! (count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->description : '' !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="product">
                        <div class="section-header">
                            <h1>Related Products</h1>
                        </div>

                        @include('pages.newly-added.index')
                    </div>
                </div>

                <!-- Side Bar Start -->
                <div class="col-lg-4 sidebar">
                    <div class="sidebar-widget category">
                        <h2 class="title">Category</h2>
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


                    <div class="sidebar-widget brands">
                        <h2 class="title">Our Brands</h2>
                        <ul>
                        @foreach($product->answers as $child)
                            @if($child->feature->slug=="category")
                                <?php $index = 0; ?>
                                     @if($index<5)
                                        <?php $index++;?>
                                        <li>
                                            <a href="{{route('Catalogue',[app()->getLocale(),$category->id,'feature[]' => $answer->id])}}">
                                                @if(count($child->answer->availableLanguage)>0)
                                                    {{$child->answer->availableLanguage[0]->title}}
                                                @endif
                                            </a>
                                            <span>({{$child->answer->countAnswers()}})</span>
                                        </li>
                                    @endif
                            @endif
                        @endforeach
                        </ul>
                    </div>

                    <div class="sidebar-widget tag">
                        <h2 class="title">Tags Cloud</h2>
                        <a href="#">Lorem ipsum</a>
                        <a href="#">Vivamus</a>
                        <a href="#">Phasellus</a>
                        <a href="#">pulvinar</a>
                        <a href="#">Curabitur</a>
                        <a href="#">Fusce</a>
                        <a href="#">Sem quis</a>
                        <a href="#">Mollis metus</a>
                        <a href="#">Sit amet</a>
                        <a href="#">Vel posuere</a>
                        <a href="#">orci luctus</a>
                        <a href="#">Nam lorem</a>
                    </div>
                </div>
                <!-- Side Bar End -->
            </div>
        </div>
    </div>
    <!-- Product Detail End -->

    <!-- Brand Start -->
    <div class="brand">
        <div class="container-fluid">
            <div class="brand-slider">
                <div class="brand-item"><img src="img/brand-1.png" alt=""></div>
                <div class="brand-item"><img src="img/brand-2.png" alt=""></div>
                <div class="brand-item"><img src="img/brand-3.png" alt=""></div>
                <div class="brand-item"><img src="img/brand-4.png" alt=""></div>
                <div class="brand-item"><img src="img/brand-5.png" alt=""></div>
                <div class="brand-item"><img src="img/brand-6.png" alt=""></div>
            </div>
        </div>
    </div>

@endsection
