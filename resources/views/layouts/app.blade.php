<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <!-- BEGIN: header-->
    @include('partials.header')
    <!-- END: header-->

    <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-floating footer-static  "
        data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

        @yield('body')

        <!-- BEGIN: Footer-->
        @include('partials.footer')
        <!-- END: Footer-->

        <!-- BEGIN: Scripts-->
        @include('partials.scripts')
        <!-- END: Scripts-->

    </body>
    <!-- END: Body-->

</html>