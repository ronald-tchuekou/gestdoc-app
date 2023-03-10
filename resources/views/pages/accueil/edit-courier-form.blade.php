<div class="card">
    <div class="card-header">
        <div class="d-flex mb-3">
            <a {{--href="{{URL::previous()}}"--}} class="ml-1 text-secondary backPerss" style="font-size: 2rem;"><i class="feather icon-arrow-left"></i></a>&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;<h4 class="font-weight-bolder">Modification d'un courrier</h4>
        </div>
    </div>
    <div class="card-content">
        @include('errors.errors')

        <form action="/accueil/couriers/item/{{$courier->id}}/update" class="form pb-1" method="post">
            {{-- @method('PUT') --}}
            @csrf
            <input type="hidden" name="modify" value="{{old('modify', 'none')}}">
            <div class="row w-100 px-0 m-0">
                <div class="col-md-6 col-12 mx-0 px-0">
                    <fieldset class="form-group border mx-1 pb-1">
                        <legend class="scheduler-border text-small" style="font-size: 1rem;">Information de perstataire</legend>
                        <div class="row px-1">
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="nom">Nom *</label>
                                <input value="{{$courier->personne->nom}}" type="text" name="nom" id="nom" class="form-control @if($errors->has('nom')) is-invalid @endif">
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="prenom"> Prenom *</label>
                                <input value="{{$courier->personne->prenom}}" type="text" name="prenom" id="prenom" class="form-control @if($errors->has('prenom')) is-invalid @endif">
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="telephone"> Telephone *</label>
                                <input value="{{$courier->personne->telephone}}" type="text" name="telephone" id="telephone" class="form-control @if($errors->has('telephone')) is-invalid @endif">
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="cni">CNI *</label>
                                <input value="{{$courier->personne->cni}}" type="text" name="cni" id="cni" class="form-control @if($errors->has('cni')) is-invalid @endif">
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="email">Email </label>
                                <input value="{{$courier->personne->email}}" type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="localisation">Localisation</label>
                                <select class="select2 form-control @if($errors->has('localisation')) is-invalid @endif" id="localisation" name="localisation">
                                    <option
                                        value=""
                                        @if($courier->personne->localisation == '') selected @endif>
                                            ....
                                    </option>
                                    @foreach($locations as $location)
                                        <option
                                            value="{{$location->intitule}}"
                                            @if($courier->personne->localisation == $location->intitule) selected @endif>
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
                                            <input type="radio" name="sexe" @if($courier->personne->sexe == 'Feminin') checked @endif value="Feminin">
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
                                            <input type="radio" name="sexe" @if($courier->personne->sexe == 'Masculin') checked @endif value="Masculin">
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
                            <div class="col-4">Status *</div>
                            <div class="col-4">
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="vs-radio-con">
                                            <input type="radio" name="status" @if($courier->personne->status == 'Mari??') checked @endif value="Mari??">
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
                                            <input type="radio" name="status" @if($courier->personne->status == 'C??libataire') checked @endif value="C??libataire">
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
                    </fieldset>
                </div>
                <div class="col-md-6 col-12 mx-0 px-0">
                    <fieldset class="form-group border mx-1 pb-1">
                        <legend class="scheduler-border text-small" style="font-size: 1rem;">Information du dossier</legend>
                        <div class="row px-1">
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="code">Code *</label>
                                <input value="{{$courier->code}}" type="text" name="code" id="code" class="form-control @if($errors->has('code')) is-invalid @endif">
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="nom">Categorie *</label>
                                <select class="select2 form-control @if($errors->has('categorie_id')) is-invalid @endif" id="categorie" name="categorie_id">
                                    <option
                                        value=""
                                        @if($courier->categorie_id == '') selected @endif>
                                            ....
                                    </option>
                                    @foreach($categories as $categorie)
                                        <option
                                            value="{{$categorie->id}}"
                                            @if($courier->categorie_id == $categorie->id) selected @endif>
                                                {{ $categorie->intitule }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="nom">Prestataire *</label>
                                <select class="select2 form-control @if($errors->has('prestataire')) is-invalid @endif" id="prestataire" name="prestataire">
                                    <option
                                        value=""
                                        @if($courier->prestataire == '') selected @endif>
                                            ....
                                    </option>
                                    @foreach($prestataires as $prestataire)
                                        <option
                                            value="{{$prestataire}}"
                                            @if($courier->prestataire == $prestataire) selected @endif>
                                                {{ $prestataire }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="nbPiece">Nombre de pi??ce *</label>
                                <input value="{{$courier->nbPiece}}" type="number" name="nbPiece" id="nbPiece" class="form-control @if($errors->has('nbPiece')) is-invalid @endif">
                            </div>
                        </div>
                        <div class="form-group mx-1 mb-0">
                            <label for="objet">Objet *</label>
                            <textarea rows="2" name="objet" id="objet" class="form-control @if($errors->has('objet')) is-invalid @endif">{{$courier->objet}}</textarea>
                        </div>
                        <div class="form-group mx-1 mb-0">
                            <label for="observation">Observation *</label>
                            <input value="{{$courier->observation}}" type="text" name="observation" id="observation" class="form-control @if($errors->has('observation')) is-invalid @endif"/>
                        </div>
                    </fieldset>
                </div>
            </div>
            <!-- <div class="container m-0">
                <fieldset class="form-group border pb-1">
                    <legend class="scheduler-border text-small" style="font-size: 1rem;">Information du service d'initialisation du courier</legend>
                    <div class="row px-1">
                        <div class="col-md-6 col-12 form-group mb-0">
                            <label for="nom">Sevice *</label>
                            <select disabled class="select2 form-control @if($errors->has('service_id')) is-invalid @endif" id="service" name="service_id">
                                @foreach($services as $service)
                                    <option
                                        value="{{$service->id}}"
                                        @if($courier->service_id == $service->id) selected @endif>
                                            {{ $service->intitule }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-12 form-group mb-0">
                            <label for="recommandation">Recommandation </label>
                            <input value="{{$courier->recommandation}}" type="text" name="recommandation" id="recommandation" class="form-control"/>
                        </div>
                        <div class="col-md-3 col-12 form-group mb-0">
                            <label for="tache">T??che </label>
                            <input value="{{$courier->tache}}" type="text" name="tache" id="tache" class="form-control"/>
                        </div>
                    </div>
                </fieldset>
            </div> -->
            <div class="container d-flex justify-content-end">
                <button class="btn btn-primary mx-1" type="submit">Valider</button>
                <button class="btn btn-danger mx-1" type="reset">Annuler</button>
            </div>

        </form>
    </div>
</div>
