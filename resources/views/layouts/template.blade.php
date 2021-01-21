@extends('layouts.app')

@section('body')

<!-- Preloader Start Here -->
<div id="preloader"></div>
<!-- Preloader End Here -->
<div id="wrapper" class="wrapper bg-ash">
    <!-- Header Menu Area Start Here -->
@include('admin.layouts.header')
    <!-- Header Menu Area End Here -->
    <!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->

        @include('admin.layouts.sidebar')

        @yield('content')

	</div>

@endsection

@section('js')
 <!-- Data Table Js -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
@endsection