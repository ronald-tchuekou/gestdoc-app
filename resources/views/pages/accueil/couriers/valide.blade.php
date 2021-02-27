<div class="tab-pane fade" id="courier-tab-valide" role="tabpanel" aria-labelledby="courier-pill-valide" aria-expanded="false">
    <div class="card">
        <div class="card-header d-flex justify-content-between p-0 pt-2 px-1">
            <h5 class="font-weight-bolder">Courriers validés</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" style="width:100%" id="valide_courier_table_accueil" >
                <thead class="thead-light">
                    <tr role="row">
                        <th>N° Courrier</th>
                        <th>Objet</th>
                        <th>Validé le</th>
                        <th>Prestataire</th>
                        <th>Dépositaire</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="accueil-valide">
                    @forelse($valide_couriers as $courier)
                    <tr role="row" class="odd hover" id="row-{{$loop->index}}">
                        <td>
                            {{$courier->id}}
                        </td>
                        <td class="sorting_1 ellipsize" style="max-width: 250px;">{{$courier->objet}}</td>
                        <td>{{App\Models\Utils::full_date_format($courier->updated_at)}}</td>
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
                        <td>
                            <a href="/{{$current_account}}/courier-details/{{$courier->id}}" class="btn btn-info btn-sm">
                                <i class="feather icon-file-text" style="font-size: 1rem;"></i>
                                &nbsp;&nbsp;&nbsp;Details
                            </a>
                </td>
                    </tr>
                    @empty
                    {{-- <tr id="row-empty"><td colspan="6" class="text-center"><span class="alert">Pas de courriers validés.</span></td></tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
