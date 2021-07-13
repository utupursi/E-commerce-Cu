@extends('layouts.base')
@section('head')
    <title>Volta - {{(count($category->availableLanguage)> 0) ? $category->availableLanguage[0]->title : ''}}</title>
@endsection
@section('content')

    <div class="product-view">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row" style="background-color:white">
                        <div class="col-md-12">
                            <div class="product-view-top">
                                <div class="row">
                                    <form style="display:contents"
                                          action="{{route('Catalogue',[app()->getLocale(),$category->id])}}">
                                        <div class="col-md-4">
                                            <div class="product-search">
                                                <input value="Search">
                                                <button><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="product-short">
                                                <div class="dropdown">
                                                    {{--                                                    <div class="dropdown-toggle" data-toggle="dropdown">Product short by--}}
                                                    {{--                                                    </div>--}}
                                                    <select class="form-control" name="sort"
                                                            style="border:1px solid black"
                                                            onchange="this.form.submit()">
                                                        <option selected disabled>Default select</option>
                                                        <option
                                                            value="news" {{(Request::get('sort') && Request::get('sort') == 'new') ? 'selected' : '' }}>
                                                            ახალი
                                                        </option>
                                                        <option
                                                            value="price_asc" {{(Request::get('sort') && Request::get('sort') == 'price_asc') ? 'selected' : '' }}>
                                                            ფასი ზრდადობით
                                                        </option>
                                                        <option
                                                            value="price_desc" {{(Request::get('sort') && Request::get('sort') == 'price_desc') ? 'selected' : '' }}>
                                                            ფასი კლებადობით
                                                        </option>
                                                    </select>
                                                    {{--                                                    <select class="" style="border-radius: 5px; width: 100%;height: 35px;background-color: white;">--}}
                                                    {{--                                                        <option href="#" class="dropdown-item">Newest</option>--}}
                                                    {{--                                                        <option href="#" class="dropdown-item">Popular</option>--}}
                                                    {{--                                                        <option href="#" class="dropdown-item">Most sale</option>--}}
                                                    {{--                                                    </select>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="product-price-range" style="display: flex;">
                                                <input type="number" style="margin-right: 10px" class="form-control"
                                                       name="minprice"
                                                       value="{{Request::get('minprice') ? Request::get('minprice') : 0 }}"/>
                                                <input type="number" name="maxprice" class="form-control"
                                                       value="{{Request::get('maxprice') ? Request::get('maxprice') : 10000}}"/>
                                                <button style="height: 36px;margin-left: 10px;" type="submit"
                                                        class="btn btn-success">
                                                    OK
                                                </button>
                                                {{--                                                <div class="dropdown">--}}
                                                {{--                                                    <div class="dropdown-toggle" data-toggle="dropdown">Product price--}}
                                                {{--                                                        range--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <div class="dropdown-menu dropdown-menu-right">--}}
                                                {{--                                                        <a href="#" class="dropdown-item">$0 to $50</a>--}}
                                                {{--                                                        <a href="#" class="dropdown-item">$51 to $100</a>--}}
                                                {{--                                                        <a href="#" class="dropdown-item">$101 to $150</a>--}}
                                                {{--                                                        <a href="#" class="dropdown-item">$151 to $200</a>--}}
                                                {{--                                                        <a href="#" class="dropdown-item">$201 to $250</a>--}}
                                                {{--                                                        <a href="#" class="dropdown-item">$251 to $300</a>--}}
                                                {{--                                                        <a href="#" class="dropdown-item">$301 to $350</a>--}}
                                                {{--                                                        <a href="#" class="dropdown-item">$351 to $400</a>--}}
                                                {{--                                                        <a href="#" class="dropdown-item">$401 to $450</a>--}}
                                                {{--                                                        <a href="#" class="dropdown-item">$451 to $500</a>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                        @if(count($products)>0)
                            @foreach($products as $product)
                                <div class="col-md-4">
                                    <div class="product-item">
                                        <div class="product-title">
                                            <a href="#">{{(count($product->availableLanguage)> 0) ? $product->availableLanguage[0]->title : ''}}</a>
                                            <div class="ratting">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="product-image">
                                            <a href="product-detail.html">
                                                @if(count($product->files) > 0)
                                                    <img class="img-cover"
                                                         src="{{url('storage/product/'.$product->id. '/'.$product->files[0]->name)}}">
                                                @else
                                                    <img class="img-cover" src="{{url('noimage.png')}}">
                                                @endif
                                            </a>
                                            <div class="product-action">
                                                <a href="#" onclick="addToCart(this, '{{$product->id}}')"><i
                                                        class="fa fa-cart-plus"></i></a>
                                                <a href="#"><i class="fa fa-heart"></i></a>
                                                <a href="{{route('productDetails',[app()->getLocale(),$category->id,$product->id])}}"><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-price">
                                            <h3>
                                                @if($product->sale && $product->sale_price!=null)
                                                    $ {{$product->sale_price/100}}
                                                    <span
                                                        style="text-decoration: line-through;color:red">${{$product->price/100}}</span>
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
                        @endif
                    </div>
                {{$products->appends(request()->input())->links('vendor.pagination.custom')}}

                <!-- Pagination Start -->
{{--                    <div class="col-md-12">--}}
{{--                        <nav aria-label="Page navigation example">--}}
{{--                            <ul class="pagination justify-content-center">--}}
{{--                                <li class="page-item disabled">--}}
{{--                                    <a class="page-link" href="#" tabindex="-1">Previous</a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--                                <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                <li class="page-item">--}}
{{--                                    <a class="page-link" href="#">Next</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </nav>--}}
{{--                    </div>--}}
                    <!-- Pagination Start -->
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
                            <?php $arr = []?>
                            @foreach($products as $product)
                                @foreach($product->answers as $key=>$child)
                                    @if($child->feature->slug=="category")
                                        @if(!in_array($child->answer->availableLanguage[0]->title,$arr))
                                            <li>
                                                <a href="{{route('Catalogue',[app()->getLocale(),$product->category_id,'feature[]' => $child->answer->id])}}">
                                                    @if(count($child->answer->availableLanguage)>0)
                                                        {{$child->answer->availableLanguage[0]->title}}
                                                        <?php $arr[] = $child->answer->availableLanguage[0]->title?>
                                                    @endif
                                                </a>
                                                <span>({{$child->answer->countAnswers()}})</span>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        </ul>
                    </div>

                </div>
                <!-- Side Bar End -->
            </div>
        </div>
    </div>
@endsection
