@extends('layouts.app')

@section('body')


    <!-- BEGIN: navBar-->
    @include('partials.navbar')
    <!-- END: navBar-->


    <!-- BEGIN: sideBar-->
    @include('partials.sideBar')
    <!-- END: sidBar-->

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                @include('pages.admin.contentHeader')
            </div>
            <div class="content-body">
                <!-- BEGIN: Content-->
                @yield('content')
                <!-- END: Content-->
            </div>
        </div>
    </div>

<!-- 
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div> -->


@endSection