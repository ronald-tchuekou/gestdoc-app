@extends('layouts.template')
 
@section('content')

@include('success.success')

@if(isset($courier_mode) && $courier_mode == 'add')

    @include('pages.agent.add-courier-form')

@elseif(isset($courier_mode) && $courier_mode == 'edit')

    @include('pages.agent.edit-courier-form')

@else

<div class="card">
    <div class="card-header d-flex justify-content-between p-0 pt-2 px-1">
        <h5 class="font-weight-bolder">Couriers initialisés</h5>
        <div class="d-flex justify-content-between">
            <input type="search" class="form-control" placeholder="Rechercher" aria-controls="DataTables_Table_0" />
            <div class="text-md-center">
                <a href="/{{$current_account}}/couriers/add" class="btn btn-primary text-white ml-1 text-nowrap btn-sm" style="font-size: 1rem;">
                     <i class="feather icon-plus" style="font-size: 1.3rem;"></i>&nbsp;&nbsp;Ajouter
                </a>
            </div>
        </div>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
            <table class="user-list-table table dataTable no-footer dtr-column collapsed" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info" >
                <thead class="thead-light">
                    <tr role="row">
                        <th>Dépositaire</th>
                        <th style="width: 250px;">Objet</th>
                        <th class="text-nowrap">Nb Pièce</th>
                        <th>Prestataire</th>
                        <th>Status</th>
                        <th style="width: 40px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($couriers as $courier)
                    <tr role="row" class="odd hover">
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
                                    <a href="/agent/courier-details/{{$courier->id}}" class="dropdown-item" style="padding: 7px 9px;">
                                        <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Details
                                    </a>
                                    <a href="/agent/couriers/{{$courier->id}}/edit" class="dropdown-item" style="padding: 7px 9px;">
                                        <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Edit
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center"><span class="alert">Pas de couriers à l'état initial.</span></td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-between mx-2 row mb-1">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                        1 à 10 / 50 couriers
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_paginate paging_simple_numbers" id="">
                        <ul class="pagination w-auto float-right">
                            <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous">
                                <a
                                    href="#"
                                    aria-controls="DataTables_Table_0"
                                    data-dt-idx="0"
                                    tabindex="0"
                                    class="page-link"
                                >
                                    &nbsp;
                                </a>
                            </li>
                            <li class="paginate_button page-item active">
                                <a
                                    href="#"
                                    aria-controls="DataTables_Table_0"
                                    data-dt-idx="1"
                                    tabindex="0"
                                    class="page-link"
                                >
                                    1
                                </a>
                            </li>
                            <li class="paginate_button page-item">
                                <a
                                    href="#"
                                    aria-controls="DataTables_Table_0"
                                    data-dt-idx="2"
                                    tabindex="0"
                                    class="page-link"
                                >
                                    2
                                </a>
                            </li>
                            <li class="paginate_button page-item">
                                <a
                                    href="#"
                                    aria-controls="DataTables_Table_0"
                                    data-dt-idx="3"
                                    tabindex="0"
                                    class="page-link"
                                >
                                    3
                                </a>
                            </li>
                            <li class="paginate_button page-item next" id="DataTables_Table_0_next">
                                <a
                                    href="#"
                                    aria-controls="DataTables_Table_0"
                                    data-dt-idx="6"
                                    tabindex="0"
                                    class="page-link"
                                >
                                    &nbsp;
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif


@endSection