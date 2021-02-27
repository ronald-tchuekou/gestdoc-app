<div class="tab-pane" id="courier-tab-finish" role="tabpanel" aria-labelledby="courier-pill-finish" aria-expanded="true">
    <div class="card">
        <div class="card-header d-flex justify-content-between p-0 pt-2 px-1">
            <h5 class="font-weight-bolder">Courriers à traités</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered" style="width:100%" id="finish_courier_table_agent">
                <thead class="thead-light">
                    <tr role="row">
                        <th>N° Courrier</th>
                        <th>Objet</th>
                        <th>Tâche à faire</th>
                        <th>Assigné le</th>
                        <th style="width: 50px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="agent-finish">
                    @forelse($finish_couriers as $courier)
                    <tr role="row" class="odd hover" id="row-{{$loop->index}}">
                        <td>
                            {{$courier->id}}
                        </td>
                        <td class="sorting_1 ellipsize" style="max-width: 250px;">{{$courier->objet}}</td>
                        <td><span>{{$courier->assignes()->where('user_id', Auth::user()->id)->first()->tache}}</span></td>
                        <td>{{App\Models\Utils::full_date_format(
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
