@extends('layouts.template')

@section('content')


<!-- list section start -->

<div class="contianer">
    <ul class="nav nav-pills flex-row nav-left">
        <li class="nav-item">

            <a class="nav-link btn-sm py-1 active" id="user-pill-root" data-toggle="pill" href="#user-tab-root" aria-expanded="true">
                <span class="font-weight-bold">
                    Gestion root
                    @if(false)
                    &nbsp;&nbsp;&nbsp;<span class="badge badge-light-danger badge-pill" id="badge-modify">{{count($root_account_count)}}</span>
                    @endif
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link btn-sm py-1" id="user-pill-accuiel" data-toggle="pill" href="#user-tab-accueil" aria-expanded="false">
                <span class="font-weight-bold">
                    Gestion accueil
                    @if(false)
                    &nbsp;&nbsp;&nbsp;<span class="badge badge-light-danger badge-pill" id="badge-reject">{{count($reject_couriers)}}</span>
                    @endif
                </span>
            </a>
        </li>

    </ul>
</div>

@include('success.success')

<div class="tab-content">

@include('pages.paltform-administrator.root-manager.root-table')

</div>


<!-- list section end -->

@endsection