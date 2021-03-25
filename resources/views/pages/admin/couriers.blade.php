@extends('layouts.template')
 
@section('content')

<div class="contianer">
    <ul class="nav nav-pills flex-row nav-left">
        <li class="nav-item">
            <a class="nav-link btn-sm active py-1" id="courier-pill-initial" data-toggle="pill" href="#courier-tab-initial" aria-expanded="true">
                <span class="font-weight-bold">
                    Couriers initials 
                    @if(count($couriers_initial) != 0)
                    &nbsp;&nbsp;&nbsp;<span class="badge badge-light-danger badge-pill" id="badge-initial">
                        {{count($couriers_initial)}}
                    </span>
                    @endif
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-sm py-1" id="courier-pill-modify" data-toggle="pill" href="#courier-tab-modify" aria-expanded="false">
                <span class="font-weight-bold">
                    Couriers modifés
                    @if(count($couriers_modifie) != 0)
                    &nbsp;&nbsp;&nbsp;<span class="badge badge-light-danger badge-pill" id="badge-modify">{{count($couriers_modifie)}}</span>
                    @endif
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-sm py-1" id="courier-pill-finish" data-toggle="pill" href="#courier-tab-finish" aria-expanded="false">
                <span class="font-weight-bold">
                    Couriers traités
                    @if(count($couriers_traite) != 0)
                    &nbsp;&nbsp;&nbsp;<span class="badge badge-light-danger badge-pill" id="badge-finish">{{count($couriers_traite)}}</span>
                    @endif
                </span>
            </a>
        </li>
    </ul>
</div>

@include('success.success')

<div class="tab-content">

@include('pages.admin.courier-manage.initial')

@include('pages.admin.courier-manage.finish')

@include('pages.admin.courier-manage.modify')

</div>

@endSection