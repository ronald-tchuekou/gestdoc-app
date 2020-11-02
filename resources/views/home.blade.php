@extends('layouts.template-index')
@section('content')
        <!-- Sidebar Area End Here -->
        <div class="dashboard-content-one">
            <!-- Breadcubs Area Start Here -->
            <div class="breadcrumbs-area">
                <h3>Principale</h3>
            </div>
            <!-- Breadcubs Area End Here -->

    @include('stock_enter')

    </div>
</div>

@endsection

@section('js')
<!-- Moment Js -->
<script src="{{ asset('js/moment.min.js') }}" defer></script>
<!-- Waypoints Js -->
<script src="{{ asset('js/jquery.waypoints.min.js') }}" defer></script>

<!-- Full Calender Js -->
<script src="{{ asset('js/fullcalendar.min.js') }}" defer></script>

<!-- Counterup Js -->
<script src="{{ asset('js/jquery.counterup.min.js') }}" defer></script>

<!-- Chart Js -->
<script src="{{ asset('js/Chart.min.js') }}" defer></script>
@endsection
