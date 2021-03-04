@extends('layouts.template')

@section('content')

@include('success.success')

@if(isset($agent_mode) && $agent_mode == 'add')

    @include('pages.admin.agent-manage.add-agent-form')

@elseif(isset($agent_mode) && $agent_mode == 'edit')

    @include('pages.admin.agent-manage.edit-agent-form')

@else

{{-- <div class="card">
    <div class="card-header"><h5 class="font-weight-bloder">Eléments de filtrage</h5></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 col-12">
                <label for="nom">Services</label>
                <select class="select2 form-control" id="filter-agent-service">
                    @foreach($services as $service)
                        <option  value="{{$service->id}}">   {{ $service->intitule }}  </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 col-12">
                <label for="nom">Date de dernière connexion</label>
                <select class="select2 form-control" id="filter-agent-last_date_marge">
                    <option value="1h" >Il ya 1 heure</option>
                    <option value="1d" >Il ya 1 jour</option>
                    <option value="1m" >Il ya 1 moi</option>
                    <option value="1y" >Il ya 1 an</option>
                </select>
            </div>
            <div class="col-md-4 col-12">
                <label for="nom">Status du compte</label>
                <select class="select2 form-control" id="filter-agent-account_status">
                    <option value="active" >Activé</option>
                    <option value="notActive" >Pas activé</option>
                </select>
            </div>
        </div>
    </div>
</div> --}}


<div class="card">
    <div class="card-header d-flex justify-content-between p-0 pt-2 px-1">
        <h5 class="font-weight-bolder">Agents de la plate forme</h5>
        <div class="d-flex justify-content-between">
            <div class="text-md-center">
                <a href="/{{strtolower(Auth::user()->role)}}/agents/add" class="btn btn-primary text-white ml-1 text-nowrap btn-sm" style="font-size: 1rem;">
                    <i class="feather icon-plus" style="font-size: 1.3rem;"></i>&nbsp;&nbsp;Ajouter
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-responsive" style="width:100%" id="agents_table_admin">
            <thead class="thead-light">
                <tr role="row">
                    <th>Agent</th>
                    <th>E-mail</th>
                    <th>Localisation</th>
                    <th>Service</th>
                    <th>Dernière connexion</th>
                    <th>actif</th>
                    <th style="width: 40px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agents as $agent)
                <tr role="row" class="odd hover">
                    <td>
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="avatar-wrapper">
                                <div class="avatar mr-1"><img src="{{$agent->profile}}" alt="Avatar" height="34" width="34" /></div>
                            </div>
                            <div class="d-flex flex-column">
                                <a href="/{{strtolower(Auth::user()->role)}}/agents/{{$agent->id}}/details" class="user_name text-truncate">
                                    <span class="font-weight-bold">{{$agent->personne->nom}} {{$agent->personne->prenom}}</span>
                                </a>
                                <small class="emp_post text-muted">{{$agent->personne->telephone}}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{$agent->personne->email}}</td>
                    <td>{{$agent->personne->localisation}}</td>
                    <td>
                        {{$agent->service == null ? $agent->role : $agent->service->intitule}}
                    </td>
                    <td>{{$agent->last_connexion}}</td>
                    <td>
                        @if($agent->register_token == '')
                        <span data-toggle="tooltip" data-placement="bottom" title="Compte déjà créé" class="text-success cursor-pointer bg-success boule"></span>
                        @else
                        <span data-toggle="tooltip" title="Compte pas encore créé" class="text-success cursor-pointer bg-danger boule"></span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-sm hide-arrow" data-toggle="dropdown">
                            <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="/{{strtolower(Auth::user()->role)}}/agents/{{$agent->id}}/details"  class="dropdown-item" style="padding: 7px 9px;">
                                    <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                                    &nbsp;&nbsp;&nbsp;Details
                                </a>
                                <a href="/{{strtolower(Auth::user()->role)}}/agents/edition/{{$agent->id}}" class="dropdown-item" style="padding: 7px 9px;">
                                    <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                                    &nbsp;&nbsp;&nbsp;Edit
                                </a>
                                <a href="/{{strtolower(Auth::user()->role)}}/agents/{{$agent->id}}/delete" class="dropdown-item" style="padding: 7px 9px;">
                                    <i class="feather icon-trash-2" style="font-size: 1.5rem;"></i>
                                    &nbsp;&nbsp;&nbsp;Suprimer
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                {{-- <tr><td colspan="6" class="text-center"><span class="alert">Aucun agent enregistré.</span></td></tr> --}}
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif
@endSection
