@extends('auth.layouts.template')


@section('title')
Réinitialisation de mot de passe - GestDoc
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
                    <div class="col-xl-7 col-10 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0 w-100">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center p-0">
                                    <img src="{{asset('images/pages/reset-password.png')}}" alt="branding logo">
                                </div>
                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Réinitialisation de mot de passe</h4>
                                            </div>
                                        </div>
                                        <p class="px-2">Réinialiser votre formulaire en renseignant le formulaire suivant.</p>
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                <form action="/reset-password/reset/{{$user->id}}" method="post">
                                                    @csrf
                                                    <fieldset class="form-label-group">
                                                        <input type="password" class="form-control" name="password" id="user-password" placeholder="Password">
                                                        <label for="user-password">Mot de passe</label>
                                                    </fieldset>
                                                    <fieldset class="form-label-group">
                                                        <input type="password" class="form-control" name="confirm_password" id="user-confirm-password" placeholder="Confirm Password">
                                                        <label for="user-confirm-password">Confirmation de mot de passe</label>
                                                    </fieldset>
                                                    <div class="row pt-2">
                                                        <div class="col-12 col-md-6 mb-1">
                                                            <button type="submit" class="btn btn-primary btn-block px-0">Réinitialiser</button>
                                                        </div>
                                                    </div>
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
