<div class="tab-pane active" id="courier-tab-modify" role="tabpanel" aria-labelledby="courier-pill-modify" aria-expanded="true">
    <div class="card">
        <div class="card-header d-flex justify-content-between p-0 pt-2 px-1">
            <h5 class="font-weight-bolder">Courriers à modifiés</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-responsive" style="width:100%" id="modify_courier_table_accueil">
                <thead class="thead-light">
                    <tr role="row">
                        <th>N° Courrier</th>
                        <th>Objet</th>
                        <th>Motif (modification)</th>
                        <th>Renvoyé le</th>
                        <th style="width: 40px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="accueil-modify">
                    @forelse($modify_couriers as $courier)
                    <tr role="row" class="odd hover" id="row-{{$loop->index}}">
                        <td>{{$courier->id}}</td>
                        <td class="sorting_1 ellipsize" style="max-width: 250px;">{{$courier->objet}}</td>
                        <td><span class="text-truncate align-middle text-nowrap">{{$courier->to_modify->reason}}</span></td>
                        <td class="text-truncate align-middle text-nowrap">{{App\Models\Utils::full_date_format($courier->to_modify->created_at)}}</td>
                        <td>
                            <a href="/accueil/couriers/{{$courier->id}}/modify" class="btn btn-warning btn-sm">Modifier</a>
                        </td>
                    </tr>
                    @empty
                    {{-- <tr id="row-empty"><td colspan="6" class="text-center"><span class="alert">Pas de courriers à modifier.</span></td></tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
