<div class="tab-pane fade" id="user-tab-accueil" role="tabpanel" aria-labelledby="user-pill-accueil" aria-expanded="true">
    <div class="card">
        <div class="card-header d-flex justify-content-between flex-nowrap p-0 pt-2 px-1">
            <h5 class="font-weight-bolder sorting_1 ellipsize" style="min-width: 250px;">Liste de tous les agents de service d'accueil</h5>
            <div class="d-flex justify-content-between">
                <div class="text-md-center">
                    <a href="/{{strtolower(Auth::user()->role)}}/accueil-account/add" class="btn btn-primary text-white ml-1 text-nowrap btn-sm" style="font-size: 1rem;">
                        <i class="feather icon-plus" style="font-size: 1.3rem;"></i>&nbsp;&nbsp;Ajouter
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered table-responsive" style="width:100%" id="account_table_accueil">
                <thead class="thead-light">
                    <tr role="row">
                        <th>Utilisateur</th>
                        <th>E-mail</th>
                        <th>Localisation</th>
                        <th>Role</th>
                        <th>Dernière connexion</th>
                        <th>actif</th>
                        <th style="width: 40px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($accueil_users as $agent)
                    <tr role="row" class="odd hover">
                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="avatar-wrapper">
                                    <div class="avatar mr-1"><img src="{{$agent->profile}}" alt="Avatar" height="34" width="34" /></div>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="/{{strtolower(Auth::user()->role)}}/agents/{{$agent->id}}/details" class="user_name text-truncate">
                                        <span class="font-weight-bold">{{$agent->personne->nom}} {{$agent->personne->prenom}}</span>
                                    </a>
                                    <small class="emp_post text-muted">{{$agent->personne->telephone}}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{$agent->personne->email}}</td>
                        <td>{{$agent->personne->localisation}}</td>
                        <td>
                            {{$agent->role}}
                        </td>
                        <td>{{$agent->last_connexion}}</td>
                        <td>
                            @if($agent->register_token == '')
                            <span data-toggle="tooltip" data-placement="bottom" title="Compte déjà créé" class="text-success cursor-pointer bg-success boule"></span>
                            @else
                            <span data-toggle="tooltip" title="Compte pas encore créé" class="text-success cursor-pointer bg-danger boule"></span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-sm hide-arrow" data-toggle="dropdown">
                                <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="/{{strtolower(Auth::user()->role)}}/accueil-account/{{$agent->id}}/details"  class="dropdown-item" style="padding: 7px 9px;">
                                        <i class="feather icon-file-text" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Details
                                    </a>
                                    <a href="/{{strtolower(Auth::user()->role)}}/accueil-account/{{$agent->id}}" class="dropdown-item" style="padding: 7px 9px;">
                                        <i class="feather icon-edit-2" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Edit
                                    </a>
                                    <a href="/{{strtolower(Auth::user()->role)}}/root-account/{{$agent->id}}/delete" class="dropdown-item" style="padding: 7px 9px;">
                                        <i class="feather icon-trash-2" style="font-size: 1.5rem;"></i>
                                        &nbsp;&nbsp;&nbsp;Suprimer
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    {{-- <tr id="row-empty"><td colspan="6" class="text-center"><span class="alert">Pas de courriers rejetés.</span></td></tr> --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
