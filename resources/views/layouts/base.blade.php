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
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href=" {{asset('../lib/slick/slick-theme.css')}}" rel="stylesheet">
    <link href=" {{asset('../lib/slick/slick.css')}}" rel="stylesheet">
    <link href=" {{asset('../css/style.css')}}" rel="stylesheet">

    @yield('head')

    {{--    <title> volta - Home </title>--}}
</head>

<body>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0"
        nonce="3c3lKlK8"></script>

<x-navbar :categories="$categories"/>
<x-cart/>
@yield('content')
<x-footer/>


<!-- regular js-->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('../lib/slick/slick.min.js')}}"></script>
<script src="{{asset('../lib/easing/easing.min.js')}}"></script>
<script src="{{asset('../js/main.js?v=2')}}"></script>

</body>

</html>
