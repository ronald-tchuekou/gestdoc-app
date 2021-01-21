<!DOCTYPE html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Gesapp | administrateur</title>
    <meta name="description" content="" />
    <meta name="crsf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Favicon -->
    <link  rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    <!-- Normalize CSS -->
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <!-- Main CSS -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Fontawesome CSS -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <!-- Flaticon CSS -->
    <link href="{{ asset('fonts/flaticon.css') }}" rel="stylesheet">
    <!-- Full Calender CSS -->
    <link href="{{ asset('css/fullcalendar.min.css') }}" rel="stylesheet">
    <!-- Animate CSS -->
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
    <!-- Select 2 -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">


@yield('css')
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Modernize js -->
    <script src="{{ asset('js/modernizr-3.6.0.min.js') }}" defer></script>

</head>

<body>

@yield('body')

{{-- <style type="text/css">
    #preloader {
  background: #ffffff url({{asset("img/preloader.gif")}}) no-repeat scroll center center;
  height: 100%;
  left: 0;
  overflow: visible;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 9999999;
}
</style> --}}
<!-- jquery-->
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<!-- Plugins js -->
<script src="{{ asset('js/plugins.js') }}" defer></script>
<!-- Popper js -->
<script src="{{ asset('js/popper.min.js') }}" defer></script>
<!-- Bootstrap js -->
<script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
<!-- Scroll Up Js -->
<script src="{{ asset('js/jquery.scrollUp.min.js') }}" defer></script>


@yield('js')

<!-- Custom Js -->
<script src="{{ asset('js/main.js') }}" defer></script>
<!--select2-->
<script src="{{ asset('js/select2.min.js') }}" defer></script>

@yield('cdn_js')
</body>

<!-- Mirrored from www.radiustheme.com/demo/html/psdboss/akkhor/akkhor/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 07 Jul 2019 05:33:03 GMT -->
</html>
