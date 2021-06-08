<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>Volta Admin</title>

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
    <link href="{{asset('../adm/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../adm/bower_components/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('../adm/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{asset('../adm/bower_components/slick-carousel/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('../adm/css/main.css?version=4.4.0')}}" rel="stylesheet">
    <link href="{{asset('../adm/css/fonts.css')}}" rel="stylesheet">
    <link href="{{asset('../adm/uploader/image-uploader.css')}}" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        {{--         Import Custom css.--}}
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <link href="{{asset('adm/css/app.css')}}" rel="stylesheet">
  </head>
  <body class="with-content-panel menu-position-side menu-side-left full-screen" style="padding-bottom:0">
    <x-admin.dashboard>

      @yield('body')
    </x-admin.dashboard>
    <script src="{{asset('../adm/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/moment/moment.js')}}"></script>
    <script src="{{asset('../adm/bower_components/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('../adm/bower_components/bootstrap-validator/dist/validator.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('../adm/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/dropzone/dist/dropzone.js')}}"></script>
    <script src="{{asset('../adm/bower_components/editable-table/mindmup-editabletable.js')}}"></script>
    <script src="{{asset('../adm/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/tether/dist/js/tether.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/slick-carousel/slick/slick.min.js')}}"></script>
    <script src="{{asset('../adm/bower_components/bootstrap/js/dist/util.js')}}"></script>
    <script src="{{asset('../adm/bower_components/bootstrap/js/dist/alert.js')}}"></script>
    <script src="{{asset('../adm/bower_components/bootstrap/js/dist/button.js')}}"></script>
    <script src="{{asset('../adm/bower_components/bootstrap/js/dist/carousel.js')}}"></script>
    <script src="{{asset('../adm/bower_components/bootstrap/js/dist/collapse.js')}}"></script>
    <script src="{{asset('../adm/bower_components/bootstrap/js/dist/dropdown.js')}}"></script>
    <script src="{{asset('../adm/bower_components/bootstrap/js/dist/modal.js')}}"></script>
    <script src="{{asset('../adm/bower_components/bootstrap/js/dist/tab.js')}}"></script>
    <script src="{{asset('../adm/bower_components/bootstrap/js/dist/tooltip.js')}}"></script>
    <script src="{{asset('../adm/bower_components/bootstrap/js/dist/popover.js')}}"></script>
    <script src="{{asset('../adm/js/demo_customizer.js?version=4.4.0')}}"></script>
    <script src="{{asset('../adm/js/main.js?version=4.4.0')}}"></script>
    <script src="{{asset('../adm/uploader/image-uploader.js')}}"></script>
    <script src="{{asset('../js/app.js')}}"></script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-XXXXXXX-9', 'auto');
      ga('send', 'pageview');
    </script>
  </body>
</html>
