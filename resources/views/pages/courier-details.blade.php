@extends('layouts.template')

@section('content')

<?php use App\Models\Utils; ?>

<div class="card">
<div class="card-header">
    <div class="d-flex mb-3">
        <a class="ml-1 text-secondary backPerss" style="font-size: 2rem;"><i class="feather icon-arrow-left"></i></a>&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;<h4 class="font-weight-bolder">Initialisation d'un nouveau courrier</h4>
    </div>
</div>
<div class="card-content">
        
    <div class="row w-100 px-0 m-0">
        <div class="col-md-6 col-12 mx-0 px-0">
            <fieldset class="form-group border mx-1 pb-1">
                <legend class="scheduler-border text-small" style="font-size: 1rem;">Information du dépositaire</legend>
                <div class="row px-1">
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="nom">Nom : </label>
                        <input disabled value="{{$courier->personne->nom}}" type="text" name="nom" id="nom" class="form-control @if($errors->has('nom')) is-invalid @endif">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="prenom"> Prenom : </label>
                        <input disabled value="{{$courier->personne->prenom}}" type="text" name="prenom" id="prenom" class="form-control @if($errors->has('prenom')) is-invalid @endif">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="telephone"> Telephone : </label>
                        <input disabled value="{{$courier->personne->telephone}}" type="text" name="telephone" id="telephone" class="form-control @if($errors->has('telephone')) is-invalid @endif">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="cni">CNI : </label>
                        <input disabled value="{{$courier->personne->cni}}" type="text" name="cni" id="cni" class="form-control @if($errors->has('cni')) is-invalid @endif">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="email">Email :  </label>
                        <input disabled value="{{$courier->personne->email}}" type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="localisation">Localisation : </label>
                        <input disabled value="{{$courier->personne->localisation}}" type="localisation" name="localisation" id="localisation" class="form-control">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="sexe">Sexe : </label>
                        <input disabled value="{{$courier->personne->sexe}}" type="sexe" name="sexe" id="sexe" class="form-control">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="sexe">Status matrimonial : </label>
                        <input disabled value="{{$courier->personne->sexe}}" type="sexe" name="sexe" id="sexe" class="form-control">
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-6 col-12 mx-0 px-0">
            <fieldset class="form-group border mx-1 pb-1">
                <legend class="scheduler-border text-small" style="font-size: 1rem;">Information du courrier</legend>
                <div class="row px-1">
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label>N° Courrier : </label>
                        <input disabled value="{{$courier->id}}" class="form-control">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label>Nombre de pièce : </label>
                        <input disabled value="{{$courier->nbPiece}}" class="form-control">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label>Categorie : </label>
                        <input disabled value="{{$courier->categorie->intitule}}" class="form-control">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label>Prestataire : </label>
                        <input disabled value="{{$courier->prestataire}}" class="form-control">
                    </div>
                </div>
                <div class="col-12 form-group mb-0">
                    <label>Objet : </label>
                    <div class="border rounded-sm p-1">{{$courier->objet}} </div>
                </div>
                <div class="col-12 form-group mb-0">
                    <label>Observation : </label>
                    <input disabled value="{{$courier->observation}}" class="form-control">
                </div>
            </fieldset>
        </div>
    </div>
   
</div>
</div>

<div class="card">
    <div class="card-header"><h4 class="font-weight-bolder">Présentation de la situation du courrier</h4></div>
    <div class="card-body" style="overflow-x: auto;">
        <div class="state">
            <ul class="d-flex state-courier justify-content-between">
                <li class="state-item">
                    <div class="state-icon">
                        <label class="text-secondary font-size-small text-primary">Initial</label>
                        <span class="boule-wrapper bg-primary">
                            <i class="feather icon-plus font-medium-4 align-middle"></i>
                        </span>
                    </div>
                    <div class="state-desc">
                        <div>
                            <span class="text-secondary">
                                {{App\Models\Utils::date_format($courier->dateEnregistrement)}} à 
                                {{App\Models\Utils::hour_format($courier->dateEnregistrement)}}
                            </span>
                        </div>
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="avatar-wrapper">
                                <div class="avatar mr-1"><img src="{{$courier_user->profile}}" alt="Avatar" height="34" width="34" /></div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="" class="user_name text-truncate">
                                    <span class="font-weight-bold">{{$courier_user->personne->nom}} {{$courier_user->personne->prenom}}</span>
                                </a>
                                <small class="emp_post text-muted">{{$courier_user->personne->telephone}}</small>
                                <small class="text-dark">@if($courier_user->service != null) {{$courier_user->service->intitule}} @endif</small>
                            </div>
                        </div>
                    </div>
                </li>

                @if(count($assignments) == 1)

                <li class="state-item">
                    <div class="state-icon">
                        <label class="text-secondary font-size-small">Traitement</label>
                            @if($assignments[0]->terminer == 2)
                             <span class="boule-wrapper bg-warning">
                                <i class="feather icon-check font-medium-4 align-middle"></i>
                            </span>
                            @else
                             <span class="boule-wrapper bg-warning" style="opacity: .5;">
                                <i class="feather icon-alert-circle font-medium-4 align-middle"></i>
                            </span>
                            @endif
                    </div>
                    <div class="state-desc">
                        <div>
                            <span class="text-secondary">
                                {{App\Models\Utils::date_format($assignments[0]->date)}} à 
                                {{App\Models\Utils::hour_format($assignments[0]->date)}}
                            </span>
                        </div>
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="avatar-wrapper">
                                <div class="avatar mr-1"><img src="{{$assignments[0]->agent->profile}}" alt="Avatar" height="34" width="34" /></div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="" class="user_name text-truncate">
                                    <span class="font-weight-bold">{{$assignments[0]->agent->personne->nom}} {{$assignments[0]->agent->personne->prenom}}</span>
                                </a>
                                <small class="emp_post text-muted">{{$assignments[0]->agent->personne->telephone}}</small>
                                <small class="text-dark">{{$assignments[0]->agent->service->intitule}}</small>
                            </div>
                        </div>
                    </div>
                </li>

                @else

                @foreach($assignments as $assign)

                <li class="state-item">
                    <div class="state-icon">
                        <label class="text-secondary text-nowrap font-size-small">Traitement {{$assign->position}}</label>
                        @if($assign->terminer == 2)
                        <span class="boule-wrapper bg-warning">
                            <i class="feather icon-check font-medium-4 align-middle"></i>
                        </span>
                        @else
                        <span class="boule-wrapper bg-warning" style="opacity: .5;">
                            <i class="feather icon-alert-circle font-medium-4 align-middle"></i>
                        </span>
                        @endif
                    </div>
                    <div class="state-desc">
                        <div>
                            <span class="text-secondary">
                                {{App\Models\Utils::date_format($assign->date)}} à 
                                {{App\Models\Utils::hour_format($assign->date)}}
                            </span>
                        </div>
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="avatar-wrapper">
                                <div class="avatar mr-1"><img src="{{$assign->agent->profile}}" alt="Avatar" height="34" width="34" /></div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="" class="user_name text-truncate">
                                    <span class="font-weight-bold">{{$assign->agent->personne->nom}} {{$assign->agent->personne->prenom}}</span>
                                </a>
                                <small class="emp_post text-muted">{{$assign->agent->personne->telephone}}</small>
                                <small class="text-dark">{{$assign->agent->service->intitule}}</small>
                            </div>
                        </div>
                    </div>
                </li>

                @endforeach

                @endif

                @if($courier->etat == 'Traité')

                <li class="state-item">
                    <div class="state-icon">
                        <label class="text-secondary font-size-small">Traité</label>
                        <span class="boule-wrapper bg-info">
                            <i class="feather icon-info font-medium-4 align-middle"></i>
                        </span>
                    </div>
                    <div class="state-desc">
                        <div>
                            <span class="text-secondary">
                                {{App\Models\Utils::date_format($courier->updated_at)}} à 
                                {{App\Models\Utils::hour_format($courier->updated_at)}}
                            </span>
                        </div>
                        <div class="d-flex justify-content-left align-items-center">
                            Le traitement de ce courier est terminé, il ne reste plus que le maire valide, pour qu'il soit retransmi au service concerné.
                        </div>
                    </div>
                </li>

                @endif

                @if($courier->etat == 'Validé')

                <li class="state-item">
                    <div class="state-icon">
                        <label class="text-secondary font-size-small">Validé</label>
                        <span class="boule-wrapper bg-success">
                            <i class="feather icon-check font-medium-4 align-middle"></i>
                        </span>
                    </div>
                    <div class="state-desc">
                        <div>
                            <span class="text-secondary">
                                {{App\Models\Utils::date_format($courier->updated_at)}} à 
                                {{App\Models\Utils::hour_format($courier->updated_at)}}
                            </span>
                        </div>
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="avatar-wrapper">
                                <div class="avatar mr-1"><img src="{{$courier->valide->user->profile}}" alt="Avatar" height="34" width="34" /></div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="" class="user_name text-truncate">
                                    <span class="font-weight-bold">{{$courier->valide->user->personne->nom}} {{$courier_user->personne->prenom}}</span>
                                </a>
                                <small class="emp_post text-muted">{{$courier->valide->user->personne->telephone}}</small>
                            </div>
                        </div>
                    </div>
                </li>

                @endif

                @if($courier->etat == 'Rejeté')

                <li class="state-item">
                    <div class="state-icon">
                        <label class="text-secondary font-size-small">Rejeté</label>
                        <span class="boule-wrapper bg-danger">
                            <i class="feather icon-x font-medium-4 align-middle"></i>
                        </span>
                    </div>
                    <div class="state-desc">
                        <div>
                            <span class="text-secondary">
                                {{App\Models\Utils::date_format($courier->updated_at)}} à 
                                {{App\Models\Utils::hour_format($courier->updated_at)}}
                            </span>
                        </div>
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="avatar-wrapper">
                                <div class="avatar mr-1"><img src="{{$courier->reject->user->profile}}" alt="Avatar" height="34" width="34" /></div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="" class="user_name text-truncate">
                                    <span class="font-weight-bold">{{$courier->reject->user->personne->nom}} {{$courier->reject->user->personne->prenom}}</span>
                                </a>
                                <small class="emp_post text-muted">{{$courier->reject->user->personne->telephone}}</small>
                            </div>
                        </div>
                    </div>
                </li>

                @endif

            </ul>
        </div>
    </div>
</div>

@endSection