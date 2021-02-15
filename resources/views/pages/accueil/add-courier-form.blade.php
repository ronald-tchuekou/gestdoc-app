<div class="card">
    <div class="card-header">
        <div class="d-flex mb-3">
            <a href="/accueil/couriers" class="ml-1 text-secondary" style="font-size: 2rem;"><i class="feather icon-arrow-left"></i></a>&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;<h4 class="font-weight-bolder">Initialisation d'un nouveau courier</h4>
        </div>
    </div>
    <div class="card-content">
        @include('errors.errors')
        <form action="/accueil/couriers/store" class="form pb-1" method="post">

        
@csrf
    <div class="row w-100 px-0 m-0">
        <div class="col-md-6 col-12 mx-0 px-0">
            <fieldset class="form-group border mx-1 pb-1">
                <legend class="scheduler-border text-small" style="font-size: 1rem;">Information de perstataire</legend>
                <div class="row px-1">
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="nom">Nom *</label>
                        <input @if($courier_mode == 'edit') readonly @endif value="{{old('nom')}}" type="text" name="nom" id="nom" class="form-control @if($errors->has('nom')) is-invalid @endif">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="prenom"> Prenom *</label>
                        <input value="{{old('prenom')}}" type="text" name="prenom" id="prenom" class="form-control @if($errors->has('prenom')) is-invalid @endif">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="telephone"> Telephone *</label>
                        <input value="{{old('telephone')}}" type="text" name="telephone" id="telephone" class="form-control @if($errors->has('telephone')) is-invalid @endif">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="cni">CNI *</label>
                        <input value="{{old('cni')}}" type="text" name="cni" id="cni" class="form-control @if($errors->has('cni')) is-invalid @endif">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="email">Email </label>
                        <input value="{{old('email')}}" type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="localisation">Localisation</label>
                        <input value="{{old('localisation')}}" type="localisation" name="localisation" id="localisation" class="form-control">
                    </div>
                </div>
                <div class="row px-1" style="padding-top: 4px; padding-bottom: 4px;">
                    <div class="col-4">Sexe *</div>
                    <div class="col-4">
                        <li class="d-inline-block mr-2">
                            <fieldset>
                                <div class="vs-radio-con">
                                    <input type="radio" name="sexe" @if(old('sexe', 'Feminin') == 'Feminin') checked @endif value="Feminin">
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
                                    <input type="radio" name="sexe" @if(old('sexe') == 'Masculin') checked @endif value="Masculin">
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
                                    <input type="radio" name="status" @if(old('status') == 'Marié') checked @endif value="Marié">
                                    <span class="vs-radio">
                                        <span class="vs-radio--border"></span>
                                        <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="">Marié</span>
                                </div>
                            </fieldset>
                        </li>
                    </div>
                    <div class="col-4">
                        <li class="d-inline-block mr-2">
                            <fieldset>
                                <div class="vs-radio-con">
                                    <input type="radio" name="status" @if(old('status', 'Célibataire') == 'Célibataire') checked @endif value="Célibataire">
                                    <span class="vs-radio">
                                        <span class="vs-radio--border"></span>
                                        <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="">Célibataire</span>
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
                        <label for="nom">Categorie *</label>
                        <select class="select2 form-control @if($errors->has('categorie_id')) is-invalid @endif" id="categorie" name="categorie_id">
                            <option
                                value="" 
                                @if(old('categorie_id') == '') selected @endif>
                                    ....
                            </option>
                            @foreach($categories as $categorie)
                                <option
                                    value="{{$categorie->id}}"
                                    @if(old('categorie_id') == $categorie->id) selected @endif>
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
                                @if(old('prestataire') == '') selected @endif>
                                    ....
                            </option>
                            @foreach($prestataires as $prestataire)
                                <option
                                    value="{{$prestataire}}" 
                                    @if(old('prestataire') == $prestataire) selected @endif>
                                        {{ $prestataire }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mx-1 mb-0">
                    <label for="objet">Objet *</label>
                    <textarea rows="2" name="objet" id="objet" class="form-control @if($errors->has('objet')) is-invalid @endif">{{old('objet')}}</textarea>
                </div>
                <div class="row px-1">
                    <div class="col-md-6 col-12 form-group mb-0">
                        <label for="nbPiece">Nombre de pièce *</label>
                        <input value="{{old('nbPiece')}}" type="number" name="nbPiece" id="nbPiece" class="form-control @if($errors->has('nbPiece')) is-invalid @endif">
                    </div>
                </div>
                <div class="form-group mx-1 mb-0">
                    <label for="observation">Observation *</label>
                    <input value="{{old('observation')}}" type="text" name="observation" id="observation" class="form-control @if($errors->has('observation')) is-invalid @endif"/>
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
                    <select class="select2 form-control @if($errors->has('service_id')) is-invalid @endif" id="service" name="service_id">
                        <option
                            value="" 
                            @if(old('service_id') == '') selected @endif>
                                ....
                        </option>
                        @foreach($services as $service)
                            <option
                                value="{{$service->id}}" 
                                @if(old('service_id') == $service->id) selected @endif>
                                    {{ $service->intitule }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-12 form-group mb-0">
                    <label for="recommandation">Recommandation </label>
                    <input value="{{old('recommandation')}}" type="text" name="recommandation" id="recommandation" class="form-control"/>
                </div>
                <div class="col-md-3 col-12 form-group mb-0">
                    <label for="tache">Tâche </label>
                    <input value="{{old('tache')}}" type="text" name="tache" id="tache" class="form-control"/>
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