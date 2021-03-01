@extends('layouts.template')
 
@section('content')

<div class="contianer">
    <ul class="nav nav-pills flex-row nav-left">
        <li class="nav-item">
            <a class="nav-link btn-sm active py-1" id="courier-pill-initial" data-toggle="pill" href="#courier-tab-initial" aria-expanded="true">
                <span class="font-weight-bold">Couriers initials</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-sm py-1" id="courier-pill-modify" data-toggle="pill" href="#courier-tab-modify" aria-expanded="false">
                <span class="font-weight-bold">Couriers modifés</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-sm py-1" id="courier-pill-finish" data-toggle="pill" href="#courier-tab-finish" aria-expanded="false">
                <span class="font-weight-bold">Couriers traités</span>
            </a>
        </li>
    </ul>
</div>

<div class="tab-content">

@include('pages.admin.courier-manage.initial')

@include('pages.admin.courier-manage.finish')

@include('pages.admin.courier-manage.modify')

</div>

@endSection