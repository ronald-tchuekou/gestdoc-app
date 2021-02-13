<div class="tab-pane fade" id="courier-tab-modify" role="tabpanel" aria-labelledby="courier-pill-modify" aria-expanded="false">
    <div class="card">
        <div class="card-header d-flex justify-content-between p-0 pt-2 px-1">
            <h5 class="font-weight-bolder">Couriers modifiés</h5>
            <div class="d-flex justify-content-between">
                <input type="search" class="form-control" placeholder="Rechercher" aria-controls="courier_table_admin" />
            </div>
        </div>
        <div class="card-datatable table-responsive pt-0">
            <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                <table class="user-list-table table dataTable no-footer dtr-column collapsed" id="courier_table_admin" role="grid" aria-describedby="courier_table_admin_info" >
                    <thead class="thead-light">
                        <tr role="row">
                            <th>N° Courier</th>
                            <th>Objet</th>
                            <th>Prestataire</th>
                            <th>Modifié le</th>
                            <th>Par</th>
                            <th style="width: 40px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($couriers_modifie as $courier)
                        <tr role="row" class="odd hover" id="row-{{$loop->index}}">
                            <td>{{$courier->id}}</td>
                            <td class="sorting_1 ellipsize" style="max-width: 250px;">{{$courier->objet}}</td>
                            <td>{{$courier->prestataire}}</td>
                            <td><span class="text-truncate align-middle text-nowrap">{{App\Models\Utils::full_date_format($courier->updated_at)}}</span></td>
                            <td>
                                <div class="d-flex justify-content-left align-items-center">
                                    <div class="d-flex flex-column">
                                        <a href="javascript:void()" class="user_name text-truncate">
                                            <span class="font-weight-bold">{{$courier->user->personne->nom}} {{$courier->user->personne->prenom}}</span>
                                        </a>
                                        <small class="emp_post text-muted">{{$courier->user->personne->telephone}}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm hide-arrow" data-toggle="dropdown">
                                        <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- <a href="/admin/couriers/{{$courier->id}}" id="type-success" class="dropdown-item" style="padding: 7px 9px;"> -->
                                        <a href="/{{$current_account}}/courier-details/{{$courier->id}}" class="dropdown-item" style="padding: 7px 9px;">
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
                        <tr><td colspan="6" class="text-center"><span class="alert">Pas de couriers modifiés à afficher.</span></td></tr>
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
</div>