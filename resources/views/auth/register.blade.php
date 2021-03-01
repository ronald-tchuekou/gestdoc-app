@extends('auth.layouts.template')


@section('title')
Inscription - GestDoc
@endSection

@section('content')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="row flexbox-container">
                <div class="col-xl-8 col-10 d-flex justify-content-center">
                    <div class="card bg-authentication rounded-0 mb-0">
                        <div class="row m-0">
                            <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                                <img src="{{asset('images/pages/login.png')}}" alt="branding logo">
                            </div>
                            <div class="col-lg-6 col-12 p-0 mb-2">
                                <div class="card rounded-0 mb-0 p-2">
                                    <div class="card-header pt-50 pb-1">
                                        <div class="card-title">
                                            <h4 class="mb-0">Création de compte</h4>
                                        </div>
                                    </div>
                                    <p class="px-2">Veuillez remplire ce formulaire pour créer un compte.</p>
                                    @include('errors.errors')
                                    <div class="card-content">
                                        <div class="card-body pt-1">
                                            <form action="/register/{{$user->id}}" method="post">
                                            @csrf
                                                <div class="form-label-group">
                                                    <input type="text" id="login" name="login" value="{{old('login')}}" class="form-control" placeholder="Login">
                                                    <label for="login">Login</label>
                                                </div>
                                                <div class="form-label-group">
                                                    <input type="password" id="password" name="password" value="{{old('password')}}" class="form-control" placeholder="Mot de passe">
                                                    <label for="password">Mot de passe</label>
                                                </div>
                                                <div class="form-label-group">
                                                    <input type="password" id="confirmPass" name="confirmPass" value="{{old('confirmPass')}}" class="form-control" placeholder="Confirmation">
                                                    <label for="confirmPass">Confirmation</label>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <fieldset class="checkbox">
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input type="checkbox" name="terme_condition" @if (old('terme_condition') !== null) checked @endif>
                                                                <span class="vs-checkbox">
                                                                    <span class="vs-checkbox--check">
                                                                        <i class="vs-icon feather icon-check"></i>
                                                                    </span>
                                                                </span>
                                                                <span class=""> Accepter les termes & conditions.</span>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary float-right btn-inline mb-50">S'inscrire</a>
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