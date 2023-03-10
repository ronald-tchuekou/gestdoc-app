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
                            <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                <img src="{{asset('images/pages/graphic-2.png')}}" alt="branding logo">
                            </div>
                            <div class="col-lg-6 col-12 p-0">
                                <div class="card pb-2 rounded-0 mb-0 px-2 h-100 d-flex justify-content-center">
                                    <div class="card-header pb-1">
                                        <div class="card-title">
                                            <h4 class="mb-0">Creation de login administrateur pour la plate forme</h4>
                                        </div>
                                    </div>
                                    <p class="px-2">Terminer votre identification en vous créant un login à partir du formulaire d'enregistrement ci-dessous.</p>
                                    @include('errors.errors')
                                    <div class="card-content">
                                        <div class="card-body pt-1">
                                            <form action="/admin-register" method="post">
                                            @csrf
                                                <input type="hidden" name="personne_id" value="{{ old('personne_id', -1) }}">
                                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                    <input type="text" class="form-control" value="{{ old('login') }}" id="login" placeholder="Login" name="login" required>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    <label for="login">Login</label>
                                                </fieldset>

                                                <fieldset class="form-label-group position-relative has-icon-left">
                                                    <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password" placeholder="Password" required>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-lock"></i>
                                                    </div>
                                                    <label for="password">Mot de passe</label>
                                                </fieldset>
                                                
                                                <fieldset class="form-label-group position-relative has-icon-left">
                                                    <input type="password" class="form-control" value="{{ old('confirm_password') }}" id="confirm_password" name="confirm_password" placeholder="Confirmation mot de passe" required>
                                                    <div class="form-control-position">
                                                        <i class="feather icon-lock"></i>
                                                    </div>
                                                    <label for="confirm_password">Confirmation mot de passe</label>
                                                </fieldset>
                                                
                                                <button type="submit" class="btn btn-primary float-right btn-inline">Enregistrer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

@endSection