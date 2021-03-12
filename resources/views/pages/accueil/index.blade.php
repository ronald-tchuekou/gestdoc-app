@extends('layouts.template')
 
@section('content')

<!-- list section start -->

<div class="contianer">
    <ul class="nav nav-pills flex-row nav-left">
        <li class="nav-item">
            <a class="nav-link btn-sm py-1 active" id="courier-pill-modify" data-toggle="pill" href="#courier-tab-modify" aria-expanded="true">
                <span class="font-weight-bold">
                    Courriers à modifier
                    @if(count($modify_couriers) != 0)
                    &nbsp;&nbsp;&nbsp;<span class="badge badge-light-danger badge-pill" id="badge-modify">{{count($modify_couriers)}}</span>
                    @endif
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-sm py-1" id="courier-pill-reject" data-toggle="pill" href="#courier-tab-reject" aria-expanded="false">
                <span class="font-weight-bold">
                    Courriers rejetés
                    @if(count($reject_couriers) != 0)
                    &nbsp;&nbsp;&nbsp;<span class="badge badge-light-danger badge-pill" id="badge-reject">{{count($reject_couriers)}}</span>
                    @endif
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-sm py-1" id="courier-pill-valide" data-toggle="pill" href="#courier-tab-valide" aria-expanded="false">
                <span class="font-weight-bold">
                    Courriers validés
                    @if(count($valide_couriers) != 0)
                    &nbsp;&nbsp;&nbsp;<span class="badge badge-light-danger badge-pill" id="badge-validate">{{count($valide_couriers)}}</span>
                    @endif
                </span>
            </a>
        </li>
    </ul>
</div>

<div class="tab-content">

@include('pages.accueil.couriers.modify')

@include('pages.accueil.couriers.reject')

@include('pages.accueil.couriers.valide')

</div>


<!-- list section end -->


@endSection