@extends('layouts.template')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex mb-3">
        <a href="/{{strtolower(Auth::user()->role)}}/accueil-personnel" class="ml-1 text-secondary" style="font-size: 2rem;"><i class="feather icon-arrow-left"></i></a>&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;<h4 class="font-weight-bolder">Formulaire d'ajout d'un nouveau gestionnaire d'accueil</h4>
        </div>
    </div>
    <div class="card-content">
        @include('errors.errors')

        @include('pages.paltform-administrator.user-form')

    </div>
</div>

@endsection