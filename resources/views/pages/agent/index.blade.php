@extends('layouts.template')
 
@section('content')

<!-- list section start -->

<!-- 
<div class="contianer">
    <ul class="nav nav-pills flex-row nav-left">
        <li class="nav-item">
            <a class="nav-link btn-sm py-1 active" id="courier-pill-modify" data-toggle="pill" href="#courier-tab-modify" aria-expanded="true">
                <span class="font-weight-bold">Courriers à modifier</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-sm py-1" id="courier-pill-finish" data-toggle="pill" href="#courier-tab-finish" aria-expanded="false">
                <span class="font-weight-bold">Courriers à traités</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-sm py-1" id="courier-pill-reject" data-toggle="pill" href="#courier-tab-reject" aria-expanded="false">
                <span class="font-weight-bold">Courriers rejetés</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn-sm py-1" id="courier-pill-valide" data-toggle="pill" href="#courier-tab-valide" aria-expanded="false">
                <span class="font-weight-bold">Courriers validé</span>
            </a>
        </li>
    </ul>
</div> -->

<!-- <div class="tab-content"> -->


@include('pages.agent.couriers.finish')


<!-- </div> -->


<!-- list section end -->


@endSection