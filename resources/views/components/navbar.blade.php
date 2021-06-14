<div class="nav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                        @auth
                        @else
                            <a href="{{route('loginFrontend',app()->getLocale())}}" class="nav-item nav-link">შესვლა</a>
                            <a href="{{route('registerFrontend',app()->getLocale())}}" class="nav-item nav-link">რეგისტრაცია</a>
                        @endauth
                </div>
                <div class="navbar-nav ml-auto">
                    <div class="nav-item dropdown">
                        @auth
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">User Account</a>
                        <div class="dropdown-menu">
                                <a href="{{route('myAccount',app()->getLocale())}}" class="nav-item nav-link">ჩემი პროფილი</a>
                            <a href="{{route('logout',app()->getLocale() )}}" class="nav-item nav-link">გამოსვლა</a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->

<!-- Bottom Bar Start -->
<div class="bottom-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="logo">
                    <a href="{{route('welcome',app()->getLocale())}}">
                        <img src="/img/logo.png" alt="Logo">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="search">
                    <input type="text" placeholder="Search">
                    <button><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="user">
                    <a href="wishlist.html" class="btn wishlist">
                        <i class="fa fa-heart"></i>
                        <span>(0)</span>
                    </a>
                    <a href="{{route('Cart',app()->getLocale())}}" class="btn cart">
                        <i class="fa fa-shopping-cart"></i>
                        <span id="cart-count">(0)</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
