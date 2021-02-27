<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Liste des courriers en cours de traitement</h4>
            </div>
            <div class="card-content">
                <div class="table-responsive mt-1">
                    <table class="table table-hover-animation mb-0">
                        <thead>
                            <tr>
                                <th>N° COURRIER</th>
                                <th>ETAT</th>
                                <th>CATEGORIE</th>
                                <th>OBJET</th>
                                <th>OPERATEUR</th>
                                <th>OBSERVATION</th>
                                <th>DATE ASSIGNE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($c_t as $courrier)
                            <tr>
                                <td>{{$courrier->id}}</td>
                                <td>
                                    <i class="fa fa-circle font-small-3 text-warning mr-50"></i>{{$courrier->etat}}
                                </td>
                                <td class="p-1">{{$courrier->categorie->intitule}} </td>
                                <td class="sorting_1 ellipsize" style="max-width: 250px;">{{$courrier->objet}}</td>
                                <td class="p-1 d-flex justify-content-center">
                                    <span data-toggle="tooltip" data-popup="tooltip-custom"
                                        data-placement="bottom"
                                        data-original-title="{{$a_c_t[$loop->index]->agent->personne->nom}} {{$a_c_t[$loop->index]->agent->personne->prenom}}"
                                        class="avatar pull-up">
                                        <img class="media-object rounded-circle"
                                            src="{{$a_c_t[$loop->index]->agent->profile}}"
                                            alt="Avatar" height="30" width="30"/>
                                    </span>
                                </td>
                                <td>
                                    <span>{{$a_p[$loop->index]}}</span>%
                                    <div class="progress progress-bar-primary mt-1 mb-0">
                                        <div class="progress-bar" role="progressbar" style="{{'width: ' . $a_p[$loop->index] . '%;'}}" aria-valuenow="{{$a_p[$loop->index]}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td>{{App\Models\Utils::full_date_format($a_c_t[$loop->index]->created_at)}}</td>
                                <td>
                                    <a data-toggle="tooltip" data-popup="tooltip-custom"  data-original-title="Details"
                                        href="/{{strtolower(Auth::user()->role)}}/courier-details/{{$courrier->id}}" class="btn d-inline btn-info btn-sm">
                                        <i class="feather icon-file-text" style="font-size: 1rem;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
