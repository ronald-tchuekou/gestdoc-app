<div class="tab-pane fade" id="courier-tab-modify" role="tabpanel" aria-labelledby="courier-pill-modify" aria-expanded="false">
    <div class="card">
        <div class="card-header d-flex justify-content-between p-0 pt-2 px-1">
            <h5 class="font-weight-bolder">Couriers modifiés</h5>
        </div>
        <div class="card-body mt-0">
            <table  class="table table-striped table-bordered table-responsive" style="width:100%" id="modify_courier_table_admin">
                <thead class="thead-light">
                    <tr role="row">
                        <th style="width: 30px;"></th>
                        <th style="width: auto;">Code</th>
                        <th style="width: auto;">Prestataire</th>
                        <th style="width: auto;">Dépositaire</th>
                        <th style="width: 250px;">Objet</th>
                        <th style="width: auto;" class="text-nowrap">Nb Pièce</th>
                        <th style="width: auto;">Status</th>
                        <th style="width: auto;">Modifié le</th>
                        <th style="width: 40px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="admin-modify-courriers">
                    @forelse($couriers_modifie as $courier)
                    <tr role="row" class="odd hover" id="row-{{$courier->id}}">
                        <td class="p-1">
                            @if ($courier->recieved == 1)
                                <a href="/{{strtolower(Auth::user()->role)}}/courriers/marck-as-not-recieved/{{$courier->id}}" data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Marquer comme non reçut" class="cursor-pointer" data-id="{{$courier->id}}" >
                                    <i class="feather icon-compass text-success" style="font-size: 2rem;
                                        font-weight: bold;"></i>
                                </a>
                            @else
                                <a href="/{{strtolower(Auth::user()->role)}}/courriers/marck-as-recieved/{{$courier->id}}" data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Marquer comme reçut" class="cursor-pointer" data-id="{{$courier->id}}" >
                                    <i class="feather icon-aperture text-warning" style="font-size: 2rem;
                                        font-weight: bold;"></i>
                                </a>
                            @endif
                        </td>
                        <td class="text-dark text-bold-700">{{$courier->code}} </td>
                        <td>{{$courier->prestataire}}</td>
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
                        <td><span class="badge badge-pill badge-light-info" text-capitalized="">{{$courier->etat}}</span></td>
                        <td class="text-truncate align-middle text-nowrap">{{App\Models\Utils::full_date_format($courier->updated_at)}}</td>
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
                                        data-courier="{{$courier->id}}/{{$courier->categorie->intitule}}/{{$courier->nbPiece}}/{{$courier->id}}"
                                        data-toggle="modal"
                                        data-target="#assign-doc-modal">

                                        <i class="feather icon-send" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Assigner
                                    </a>
                                    <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                                        tabindex="0"
                                        aria-controls="courier_table_admin"
                                        type="button"
                                        data-courier="{{$courier->id}}/reject/{{$courier->id}}"
                                        data-toggle="modal"
                                        data-target="#confirm-reject-modal">

                                        <i class="feather icon-x-circle" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Rejeter
                                    </a>
                                    <a href="javascript:void()" class="dropdown-item reject_btn" style="padding: 7px 9px;"
                                        tabindex="0"
                                        aria-controls="courier_table_admin"
                                        type="button"
                                        data-courier="{{$courier->id}}/modify/{{$courier->id}}"
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
