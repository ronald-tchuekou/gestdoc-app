<form action="{{ $action_form }}" class="form pb-1" method="post">
    @csrf
    <input type="hidden" name="personne_id" value="{{$personne->id}}">
    <div class="row w-100 px-0 m-0">
        <div class="col-md-12 col-12 mx-0 px-0">
            <div class="row px-1">
                <div class="col-md-6 col-12 form-group mb-0">
                    <label for="nom">Nom *</label>
                    <input value="{{$personne->nom}}" type="text" name="nom" id="nom" class="form-control @if($errors->has('nom')) is-invalid @endif">
                </div>
                <div class="col-md-6 col-12 form-group mb-0">
                    <label for="prenom"> Prenom *</label>
                    <input value="{{$personne->prenom}}" type="text" name="prenom" id="prenom" class="form-control @if($errors->has('prenom')) is-invalid @endif">
                </div>
                <div class="col-md-6 col-12 form-group mb-0">
                    <label for="telephone"> Telephone *</label>
                    <input value="{{$personne->telephone}}" type="text" name="telephone" id="telephone" class="form-control @if($errors->has('telephone')) is-invalid @endif">
                </div>
                <div class="col-md-6 col-12 form-group mb-0">
                    <label for="cni">CNI *</label>
                    <input value="{{$personne->cni}}" type="text" name="cni" id="cni" class="form-control @if($errors->has('cni')) is-invalid @endif">
                </div>
                <div class="col-md-6 col-12 form-group mb-0">
                    <label for="email">Email </label>
                    <input value="{{$personne->email}}" type="email" name="email" id="email" class="form-control">
                </div>
                <div class="col-md-6 col-12 form-group mb-0">
                    <label for="localisation">Localisation</label>
                    <select class="select2 form-control @if($errors->has('localisation')) is-invalid @endif" id="localisation" name="localisation">
                        <option
                            value=""
                            @if($personne->localisation == '') selected @endif>
                                ....
                        </option>
                        @foreach($locations as $location)
                            <option
                                value="{{$location->intitule}}"
                                @if($personne->localisation == $location->intitule) selected @endif>
                                    {{ $location->intitule }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row px-1" style="padding-top: 4px; padding-bottom: 4px;">
                <div class="col-4">Sexe *</div>
                <div class="col-4">
                    <li class="d-inline-block mr-2">
                        <fieldset>
                            <div class="vs-radio-con">
                                <input type="radio" name="sexe" @if($personne->sexe == 'Feminin') checked @endif value="Feminin">
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">Feminin</span>
                            </div>
                        </fieldset>
                    </li>
                </div>
                <div class="col-4">
                    <li class="d-inline-block mr-2">
                        <fieldset>
                            <div class="vs-radio-con">
                                <input type="radio" name="sexe" @if($personne->sexe == 'Masculin') checked @endif value="Masculin">
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">Masculin</span>
                            </div>
                        </fieldset>
                    </li>
                </div>
            </div>
            <div class="row px-1" style="padding-top: 4px; padding-bottom: 4px;">
                <div class="col-4">Status</div>
                <div class="col-4">
                    <li class="d-inline-block mr-2">
                        <fieldset>
                            <div class="vs-radio-con">
                                <input type="radio" name="status" @if($personne->status == 'Mari??') checked @endif value="Mari??">
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">Mari??</span>
                            </div>
                        </fieldset>
                    </li>
                </div>
                <div class="col-4">
                    <li class="d-inline-block mr-2">
                        <fieldset>
                            <div class="vs-radio-con">
                                <input type="radio" name="status" @if($personne->status == 'C??libataire') checked @endif value="C??libataire">
                                <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                </span>
                                <span class="">C??libataire</span>
                            </div>
                        </fieldset>
                    </li>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-end">
        <button class="btn btn-primary mx-1" type="submit">Valider</button>
        <button class="btn btn-danger mx-1" type="reset">Annuler</button>
    </div>
</form>
@include('success.success')
