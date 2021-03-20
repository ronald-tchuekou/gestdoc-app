<div class="tab-pane" id="courier-tab-finish" role="tabpanel" aria-labelledby="courier-pill-finish" aria-expanded="true">
    <div class="card">
        <div class="card-header d-flex justify-content-between p-0 pt-2 px-1">
            <h5 class="font-weight-bolder">Courriers à traités</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-responsive" style="width:100%" id="finish_courier_table_agent">
                <thead class="thead-light">
                    <tr role="row">
                        <th style="width: 30px;"></th>
                        <th style="width: auto;">Code</th>
                        <th>Prestataire</th>
                        <th>Depositaire</th>
                        <th>Objet</th>
                        <th>Tâche à faire</th>
                        <th>Assigné le</th>
                        <th style="width: 50px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="agent-finish">
                    @forelse($finish_couriers as $courier)
                    <tr role="row" class="odd hover" id="row-{{$loop->index}}">
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
                        <td class="sorting_1 ellipsize" style="max-width: 300px;">{{$courier->objet}}</td>
                        <td class="sorting_1 ellipsize" style="max-width: 350px;"><span>{{$courier->assignes()->where('user_id', Auth::user()->id)->first()->tache}}</span></td>
                        <td class="text-truncate align-middle text-nowrap">{{App\Models\Utils::full_date_format(
                            $courier->assignes()->where('user_id', Auth::user()->id)->first()->created_at
                        )}}</td>
                        <td>
                            <button data-courier="{{$courier->id}}" class="btn btn-secondary btn-sm btn-traitement-finish">Terminer</button>
                        </td>
                    </tr>
                    @empty
                    {{-- <tr id="row-empty"><td colspan="6" class="text-center"><span class="alert">Pas de courriers à traité.</span></td></tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
