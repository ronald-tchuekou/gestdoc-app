@extends('layouts.template')

@section('content')

@include('success.success')

@if(isset($courier_mode) && $courier_mode == 'add')

    @include('pages.accueil.add-courier-form')

@elseif(isset($courier_mode) && $courier_mode == 'edit')

    @include('pages.accueil.edit-courier-form')

@else

<div class="card">
    <div class="card-header d-flex justify-content-between p-0 pt-2 px-1">
        <h5 class="font-weight-bolder">Courriers initialisés</h5>
        <div class="d-flex justify-content-between">
            <div class="text-md-center">
                <a href="/{{$current_account}}/couriers/add" class="btn btn-primary text-white ml-1 text-nowrap btn-sm" style="font-size: 1rem;">
                    <i class="feather icon-plus" style="font-size: 1.3rem;"></i>&nbsp;&nbsp;Ajouter
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" style="width:100%" id="init_courier_table_accueil" >
            <thead class="thead-light">
                <tr role="row">
                    <th>N° Courrier</th>
                    <th>Dépositaire</th>
                    <th style="width: 250px;">Objet</th>
                    <th class="text-nowrap">Nb Pièce</th>
                    <th>Prestataire</th>
                    <th>Status</th>
                    <th style="width: 40px;">Actions</th>
                </tr>
            </thead>
            <tbody id="accueil-init-courrier">
                @forelse($couriers as $courier)
                <tr role="row" class="odd hover" data-row="{{$courier->id}}">
                    <td>{{$courier->id}}</td>
                    <td>
                        <div class="d-flex justify-content-left align-items-center">
                            <div class="d-flex flex-column">
                                <a href="javascript:void()" class="user_name text-truncate">
                                    <span class="font-weight-bold">{{$courier->personne->nom}} {{$courier->personne->prenom}}</span>
                                </a>
                                <small class="emp_post text-muted">{{$courier->personne->telephone}}</small>
                            </div>
                        </div>
                    </td>
                    <td class="sorting_1 ellipsize" style="max-width: 250px;">{{$courier->objet}}</td>
                    <td><span class="text-truncate align-middle text-nowrap">{{$courier->nbPiece}}</span></td>
                    <td>{{$courier->prestataire}}</td>
                    <td><span class="badge badge-pill badge-light-info" text-capitalized="">{{$courier->etat}}</span></td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-sm hide-arrow" data-toggle="dropdown">
                            <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="/accueil/courier-details/{{$courier->id}}" class="dropdown-item" style="padding: 7px 9px;">
                                    <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                                    &nbsp;&nbsp;&nbsp;Details
                                </a>
                                <a href="/accueil/couriers/{{$courier->id}}/edit" class="dropdown-item" style="padding: 7px 9px;">
                                    <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                                    &nbsp;&nbsp;&nbsp;Edit
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                {{-- <tr><td colspan="6" class="text-center"><span class="alert">Pas de courriers à l'état initial.</span></td></tr> --}}
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endif


@endSection
