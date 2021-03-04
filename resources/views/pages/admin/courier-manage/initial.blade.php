<?php use App\Models\Utils; ?>
<div role="tabpanel" class="tab-pane active" id="courier-tab-initial" aria-labelledby="courier-pill-initial" aria-expanded="true">
    <div class="card">
        <div class="card-header d-flex justify-content-between p-0 pt-2 px-1">
            <h5 class="font-weight-bolder">Couriers initialisés</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-responsive" style="width:100%" id="init_courier_table_admin">
                <thead class="thead-light">
                    <tr role="row">
                        <th>N° Courier</th>
                        <th>Dépositaire</th>
                        <th style="width: 250px;">Objet</th>
                        <th class="text-nowrap">Nb Pièce</th>
                        <th>Prestataire</th>
                        <th>Status</th>
                        <th>Fait le</th>
                        <th style="width: 40px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="admin-initial-courriers">
                    @forelse($couriers_initial as $courier)
                    <tr role="row" class="odd hover" id="row-{{$loop->index}}">
                        <td>{{$courier->id}} </td>
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
                        <td>{{App\Models\Utils::full_date_format($courier->dateEnregistrement)}}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-sm hide-arrow" data-toggle="dropdown">
                                    <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!-- <a href="/{{strtolower(Auth::user()->role)}}/couriers/{{$courier->id}}" id="type-success" class="dropdown-item" style="padding: 7px 9px;"> -->
                                    <a href="/{{strtolower(Auth::user()->role)}}/courier-details/{{$courier->id}}" class="dropdown-item" style="padding: 7px 9px;">
                                        <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Details
                                    </a>
                                    <a href="javascript:void()" class="dropdown-item assigner_btn" style="padding: 7px 9px;"
                                        tabindex="0"
                                        aria-controls="courier_table_admin"
                                        type="button"
                                        data-courier="{{$courier->id}}/{{$courier->categorie->intitule}}/{{$courier->nbPiece}}/{{$loop->index}}"
                                        data-toggle="modal"
                                        data-target="#assign-doc-modal">

                                        <i class="feather icon-send" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Assigner
                                    </a>
                                    <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                                        tabindex="0"
                                        aria-controls="courier_table_admin"
                                        type="button"
                                        data-courier="{{$courier->id}}/reject/{{$loop->index}}"
                                        data-toggle="modal"
                                        data-target="#confirm-reject-modal">

                                        <i class="feather icon-x-circle" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Rejeter
                                    </a>
                                    <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                                        tabindex="0"
                                        aria-controls="courier_table_admin"
                                        type="button"
                                        data-courier="{{$courier->id}}/modify/{{$loop->index}}"
                                        data-toggle="modal"
                                        data-target="#confirm-reject-modal">

                                        <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Modifier
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    {{-- <tr id="row-empty"><td colspan="6" class="text-center"><span class="alert">Pas de couriers à l'état initial.</span></td></tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@include('pages.admin.courier-manage.asigin-modal')
