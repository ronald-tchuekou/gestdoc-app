@extends('layouts.app')

@section('body')


    <!-- BEGIN: navBar-->
    @include('partials.navbar')
    <!-- END: navBar-->


    <!-- BEGIN: sideBar-->
    @include('partials.sideBar')
    <!-- END: sidBar-->

    <!-- BEGIN: Content-->
    @yield('content')
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


@endSection