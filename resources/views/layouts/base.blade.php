<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">

    <meta name="language" content="{{app()->getLocale()}}">

    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="author" content="insite.international">
    <link href="/favicon.ico" rel="shortcut icon">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/style.css?v=26">
    @yield('head')

{{--    <title> volta - Home </title>--}}
</head>

<body>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0" nonce="3c3lKlK8"></script>

    <x-navbar :categories="$categories"/>
    <x-cart/>
    @yield('content')
    <x-footer/>


    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <!--  jQueryUI for the extended easing options -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- regular js-->
    <script src="{{asset('../script/details.js')}}"></script>
    <script src="{{asset('../script/general.js?v=15')}}"></script>
    <script src="{{asset('../script/nouislider.min.js')}}"></script>
    <script src="{{asset('../script/index.js')}}"></script>
    <script src="{{asset('../script/payments.js')}}"></script>
    <script src="{{asset('../script/catalogue.js?v=2')}}"></script>

</body>

</html>
