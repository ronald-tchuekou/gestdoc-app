<div class="tab-pane fade" id="courier-tab-finish" role="tabpanel" aria-labelledby="courier-pill-finish" aria-expanded="false">
    <div class="card">
        <div class="card-header d-flex justify-content-between p-0 pt-2 px-1">
            <h5 class="font-weight-bolder">Couriers Traités</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" style="width:100%" id="finish_courier_table_admin">
                <thead class="thead-light">
                    <tr role="row">
                        <th>N° Courier</th>
                        <th>Objet</th>
                        <th>Prestataire</th>
                        <th>Terminé le</th>
                        <th style="width: 50px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="admin-finish-courriers">
                    @forelse($couriers_traite as $courier)
                    <tr role="row" class="odd hover" id="row-{{$loop->index}}">
                        <td>{{$courier->id}}</td>
                        <td class="sorting_1 ellipsize" style="max-width: 250px;">{{$courier->objet}}</td>
                        <td class="sorting_1 ellipsize" style="max-width: 250px;">{{$courier->prestataire}}</td>
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
