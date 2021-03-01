@extends('layouts.template')
 
@section('content')

<div class="card">
    <div class="card-header">
        <div class="d-flex mb-3">
            <a class="ml-1 text-secondary backPerss" style="font-size: 2rem;"><i class="feather icon-arrow-left"></i></a>&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;<h4 class="font-weight-bolder">Détails sur un agent</h4>
        </div>
    </div>
    <div class="card-content">
            
        <div class="row w-100 px-0 m-0">
            
            <div class="col-md-6 col-12 mx-0 px-0">
                <div class="avatar-wrapper" style="text-align: center;">
                    <div class="avatar mr-1">
                        <img src="{{$agent->profile}}" alt="Avatar" height="180" width="180" />
                    </div>
                </div>

                <fieldset class="form-group border mx-1 pb-1">
                    <legend class="scheduler-border text-small" style="font-size: 1rem;">Informations concernant son post</legend>
                    <div class="row px-1">
                        <div class="col-md-6 col-12 form-group mb-0">
                        <label for="nom">Sevice : </label>
                            <input disabled value="{{$agent->service->intitule}}" class="form-control">
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="col-md-6 col-12 mx-0 px-0">
                <fieldset class="form-group border mx-1 pb-1">
                    <legend class="scheduler-border text-small" style="font-size: 1rem;">Informations personnelles</legend>
                    <div class="row px-1">
                        <div class="col-md-6 col-12 form-group mb-0">
                            <label for="nom">Nom : </label>
                            <input disabled value="{{$agent->personne->nom}}" type="text" name="nom" id="nom" class="form-control @if($errors->has('nom')) is-invalid @endif">
                        </div>
                        <div class="col-md-6 col-12 form-group mb-0">
                            <label for="prenom"> Prenom : </label>
                            <input disabled value="{{$agent->personne->prenom}}" type="text" name="prenom" id="prenom" class="form-control @if($errors->has('prenom')) is-invalid @endif">
                        </div>
                        <div class="col-md-6 col-12 form-group mb-0">
                            <label for="telephone"> Telephone : </label>
                            <input disabled value="{{$agent->personne->telephone}}" type="text" name="telephone" id="telephone" class="form-control @if($errors->has('telephone')) is-invalid @endif">
                        </div>
                        <div class="col-md-6 col-12 form-group mb-0">
                            <label for="cni">CNI : </label>
                            <input disabled value="{{$agent->personne->cni}}" type="text" name="cni" id="cni" class="form-control @if($errors->has('cni')) is-invalid @endif">
                        </div>
                        <div class="col-md-6 col-12 form-group mb-0">
                            <label for="email">Email :  </label>
                            <input disabled value="{{$agent->personne->email}}" type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-md-6 col-12 form-group mb-0">
                            <label for="localisation">Localisation : </label>
                            <input disabled value="{{$agent->personne->localisation}}" type="localisation" name="localisation" id="localisation" class="form-control">
                        </div>
                        <div class="col-md-6 col-12 form-group mb-0">
                            <label for="sexe">Sexe : </label>
                            <input disabled value="{{$agent->personne->sexe}}" type="sexe" name="sexe" id="sexe" class="form-control">
                        </div>
                        <div class="col-md-6 col-12 form-group mb-0">
                            <label for="sexe">Status matrimonial : </label>
                            <input disabled value="{{$agent->personne->sexe}}" type="sexe" name="sexe" id="sexe" class="form-control">
                        </div>
                    </div>
                </fieldset>
            </div>

        </div>
    
    </div>
</div>


@endSection