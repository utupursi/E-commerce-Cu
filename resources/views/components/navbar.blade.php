<header class="header">
    <nav class="navbar">
        <div class="container">
            @foreach($categories as $key=>$category)
                <div class="sub-menu closed sub-{{$key}}">

                    @foreach($category->productFeatures as $child)
                        @if($child->feature->status)
                            <ul class="sub-menu__list">

                                <h2 class="sub-menu__title">{{(count($child->feature->availableLanguage) > 0) ?  $child->feature->availableLanguage[0]->title : ''}}
                                </h2>

                                @foreach($child->feature->answer as $answer)
                                    @if($answer->hasProducts($category->id))
                                        <a href="{{route('Catalogue',[app()->getLocale(),$category->id,'feature['.$child->feature->id.'][]' => $answer->id])}}">{{(count($answer->availableLanguage) > 0) ?  $answer->availableLanguage[0]->title : ''}}</a>
                                    @endif
                                @endforeach

                            </ul>
                        @endif
                    @endforeach
                </div>
        @endforeach
        <!---------- big menu  --------->
            <div class="navigation-wrapper closed">
                <button class="big-menu-btn">
                    <img src="/img/icons/svg-menu.svg" alt="">
                    {{__('client.catalogue')}}
                </button>
                <!-- main navivagation  -->
                <ul class="navigation">
                    @foreach($categories as $key=>$category)
                        <li class="navigation__item">
                            <a href="{{route('Catalogue',[app()->getLocale(),$category->id])}}" data-sub-nav="{{$key}}"
                               class="navigation__link">
                                <div class="link-logo">
                                    @if(isset($category->files[0]))
                                        <img style="width:20px"
                                             src="/storage/category/{{$category->files[0]->fileable_id}}/{{$category->files[0]->name}}"
                                             alt="">
                                    @endif
                                </div>
                                {{(count($category->availableLanguage) > 0) ?  $category->availableLanguage[0]->title : ''}}
                            </a>

                        </li>
                    @endforeach

                </ul>
            </div>

            <!-- side brand logo -->
            <a href="{{route('welcome',app()->getLocale())}}" class="navbar-brand">
                <img src="/img/icons/logo-volta.svg" alt="">
            </a>

            <!-- search -->
            <form action="{{route('globalSearch',app()->getLocale())}}" class="navbar-search">
                <button type="submit" class="navbar-search__subbmit flex-center">
                    <img src="/img/icons/svg-search.svg" alt="">
                </button>
                <input type="text" name="keyword" oninput="getProducts(this)" id="search-input" placeholder="{{__('client.enter_search_word')}}">

                <!-- dropdown results -->
                <div class="navbar-search__results">
                    <!-- remove hidden -->
                </div>
            </form>
            <!-- phone -->
            <div class="navbar-phone">
                <p>{{$phone}}</p>
            </div>
            <!-- search switch mobile-->
            <button class="toggle-search-form">
                <img src="/img/icons/svg-search.svg" alt="">
            </button>


            <!-- cart -->
            <a href="{{route('Cart',app()->getLocale())}}" class="nav-open-cart">
                <div class="nav-cart-img flex-center">
                    <img src="/img/icons/svg-cart.svg" alt="">
                    <span id="cart-count">0</span>
                </div>
                {{__('client.cart')}}
            </a>

            <!-- language -->
            <div class="language-box">
                <div class="language-menu">
                    @if(isset($languages['current']))
                        <a href="" class="active">
                            <img src="/adm/img/flags-icons/{{$languages['current']['img']}}">
                        </a>
                        @if(count($languages['data']) > 0)

                            @foreach($languages['data'] as $data)
                                <a href="{{$data['url']}}">
                                    <img src="/adm/img/flags-icons/{{$data['img']}}" alt="">
                                </a>
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
            <div class="selected-language-text">
                @if(isset($languages['current']))
                    <span>{{strtoupper($languages['current']['title'])}}</span>
                    @if(count($languages['data']) > 0)

                        @foreach($languages['data'] as $data)
                            <span class="hidden">{{strtoupper($data['title'])}}</span>
                        @endforeach
                    @endif
                @endif
            </div>


        </div>

    </nav>
</header>
