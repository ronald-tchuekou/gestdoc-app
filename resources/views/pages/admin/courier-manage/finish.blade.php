<div class="tab-pane fade" id="courier-tab-finish" role="tabpanel" aria-labelledby="courier-pill-finish" aria-expanded="false">
    <div class="card">
        <div class="card-header d-flex justify-content-between p-0 pt-2 px-1">
            <h5 class="font-weight-bolder">Couriers Traités</h5>
        </div>
        <div class="card-body mt-0">
            <table class="table table-striped table-bordered table-responsive" style="width:100%" id="finish_courier_table_admin">
                <thead class="thead-light">
                    <tr role="row">
                        <th style="width: 30px;"></th>
                        <th style="width: auto;">Code</th>
                        <th>Prestataire</th>
                        <th>Depositaire</th>
                        <th style="width: 250px;">Objet</th>
                        <th>Observation</th>
                        <th>Terminé le</th>
                        <th style="width: 50px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="admin-finish-courriers">
                    @forelse($couriers_traite as $courier)
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
                        <td class="sorting_1 ellipsize" style="max-width: 250px; width: 250px">{{$courier->prestataire}}</td>
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
                        <td class="sorting_1 ellipsize" style="max-width: 250px; width: 250px">{{$courier->objet}}</td>
                        <td class="sorting_1 ellipsize" style="max-width: 200px; width: 200px">{{$courier->observation}}</td>
                        <td><span class="text-truncate align-middle text-nowrap">{{App\Models\Utils::full_date_format($courier->updated_at)}}</span></td>
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
                                    <a href="javascript:void()" class="dropdown-item assigner_btn validate-courier" style="padding: 7px 9px;"
                                        type="button"
                                        data-courier="{{$courier->id}}">
                                        <i class="feather icon-check" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Valider
                                    </a>
                                    <a href="javascript:void()" class="dropdown-item observation_btn" style="padding: 7px 9px;"
                                        tabindex="0"
                                        aria-controls="courier_table_admin"
                                        type="button"
                                        data-courier="{{$courier->id}}/{{Auth::id()}}/{{strtolower(Auth::user()->role)}}"
                                        data-toggle="modal"
                                        data-target="#observation-modal">

                                        <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Observation
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    {{-- <tr><td colspan="6" class="text-center"><span class="alert">Pas de couriers déjà traité à afficher.</span></td></tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('partials.observation-modal')