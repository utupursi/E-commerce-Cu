<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <title>Volta</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="/favicon.ico" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="{{asset('../adm/bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('../adm/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('../adm/bower_components/dropzone/dist/dropzone.css')}}" rel="stylesheet">
    <link href="{{asset('../adm/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"
          rel="stylesheet">
    <link href="{{asset('../adm/bower_components/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('../adm/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{asset('../adm/bower_components/slick-carousel/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('../adm/css/main.css?version=4.4.0')}}" rel="stylesheet">
    <link href="{{asset('../adm/css/fonts.css')}}" rel="stylesheet">

    {{--         Import Custom css.--}}
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

</head>
<body class="auth-wrapper">
@yield('body')
</body>
</html>
