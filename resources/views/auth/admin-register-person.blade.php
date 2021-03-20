@extends('auth.layouts.template')


@section('title')
Platfrom administrator - GestDoc
@endSection


@section('content')

@include('success.success')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="row flexbox-container">
                <div class="col-xl-8 col-11 d-flex justify-content-center">
                    <div class="card bg-authentication rounded-0 mb-0">
                        <div class="row m-0">
                            
                            <div class="col-lg-6 col-12 p-0">
                                <div class="card pb-2 rounded-0 mb-0 px-2 h-100 d-flex justify-content-center">
                                    <div class="card-header pb-1">
                                        <div class="card-title">
                                            <h4 class="mb-0">Creation de compte administrateur pour la plate form</h4>
                                        </div>
                                    </div>
                                    <p class="px-2">Bienvenue dans la plate forme de gestion des courriers. <br>
                                    Pour commencer, vous devez create un compte à partir du formulaire d'enregistrement ci-dessous.</p>
                                    @include('errors.errors')
                                    <div class="card-content">
                                        <div class="card-body pt-1">
                                            <form action="/admin-register-person" method="post">
                                            @csrf
                                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" value="{{ old('nom') }}" id="nom" placeholder="Nom" name="nom" required>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    <label for="nom">Nom</label>
                                                </fieldset>

                                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" value="{{ old('prenom') }}" id="prenom" placeholder="Prenom" name="prenom" required>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    <label for="prenom">Prenom</label>
                                                </fieldset>

                                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" value="{{ old('telephone') }}" id="telephone" placeholder="Téléphone" name="telephone" required>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-phone"></i>
                                                    </div>
                                                    <label for="telephone">Téléphone</label>
                                                </fieldset>

                                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" value="{{ old('cni') }}" id="cni" placeholder="CNI" name="cni" required>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-hash"></i>
                                                    </div>
                                                    <label for="cni">CNI</label>
                                                </fieldset>

                                                <div class="row px-1" style="padding-top: 4px; padding-bottom: 4px;">
                                                    <div class="col-4">Sexe *</div>
                                                    <div class="col-4">
                                                        <li class="d-inline-block mr-2">
                                                            <fieldset>
                                                                <div class="vs-radio-con">
                                                                    <input type="radio" name="sexe" @if(old('sexe', 'Feminin') == 'Feminin') checked @endif value="Feminin">
                                                                    <span class="vs-radio">
                                                                        <span class="vs-radio--border"></span>
                                                                        <span class="vs-radio--circle"></span>
                                                                    </span>
                                                                    <span class="">Feminin</span>
                                                                </div>
                                                            </fieldset>
                                                        </li>
                                                    </div>
                                                    <div class="col-4">
                                                        <li class="d-inline-block mr-2">
                                                            <fieldset>
                                                                <div class="vs-radio-con">
                                                                    <input type="radio" name="sexe" @if(old('sexe') == 'Masculin') checked @endif value="Masculin">
                                                                    <span class="vs-radio">
                                                                        <span class="vs-radio--border"></span>
                                                                        <span class="vs-radio--circle"></span>
                                                                    </span>
                                                                    <span class="">Masculin</span>
                                                                </div>
                                                            </fieldset>
                                                        </li>
                                                    </div>
                                                </div>

                                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" value="{{ old('email') }}" id="email" placeholder="Adresse e-mail" name="email" required>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-mail"></i>
                                                    </div>
                                                    <label for="email">Adresse e-mail</label>
                                                </fieldset>
                                                
                                                <button type="submit" class="btn btn-primary float-right btn-inline">Enregistrer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                <img src="{{asset('images/pages/graphic-1.png')}}" alt="branding logo">
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

@endSection