<div class="card">
    <div class="card-header">
        <div class="d-flex mb-3">
        <a href="/{{strtolower(Auth::user()->role)}}/adjoints" class="ml-1 text-secondary" style="font-size: 2rem;"><i class="feather icon-arrow-left"></i></a>&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;<h4 class="font-weight-bolder">Formulaire de modification des information d'un adjoint.</h4>
        </div>
    </div>
    <div class="card-content">
        @include('errors.errors')
        <form action="/{{strtolower(Auth::user()->role)}}/adjoints/{{$adjoint->id}}/update" class="form pb-1" method="post">
            @csrf
            <div class="row justify-content-center w-100 px-0 m-0">

                <div class="col-md-6 col-12 mx-0 px-0">
                    <fieldset class="form-group border mx-1 pb-1">
                        <legend class="scheduler-border text-small" style="font-size: 1rem;">Information personnels</legend>
                        <div class="row px-1">
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="nom">Nom *</label>
                                <input value="{{$adjoint->personne->nom}}" type="text" name="nom" id="nom" class="form-control @if($errors->has('nom')) is-invalid @endif">
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="prenom"> Prenom *</label>
                                <input value="{{$adjoint->personne->prenom}}" type="text" name="prenom" id="prenom" class="form-control @if($errors->has('prenom')) is-invalid @endif">
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="telephone"> Telephone *</label>
                                <input value="{{$adjoint->personne->telephone}}" type="text" name="telephone" id="telephone" class="form-control @if($errors->has('telephone')) is-invalid @endif">
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="cni">CNI *</label>
                                <input value="{{$adjoint->personne->cni}}" type="text" name="cni" id="cni" class="form-control @if($errors->has('cni')) is-invalid @endif">
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="email">Email </label>
                                <input value="{{$adjoint->personne->email}}" type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="col-md-6 col-12 form-group mb-0">
                                <label for="localisation">Localisation *</label>
                                <select class="select2 form-control @if($errors->has('localisation')) is-invalid @endif" id="localisation" name="localisation">
                                    <option
                                        value=""
                                        @if($adjoint->personne->localisation == '') selected @endif>
                                            ....
                                    </option>
                                    @foreach($locations as $location)
                                        <option
                                            value="{{$location->intitule}}"
                                            @if($adjoint->personne->localisation == $location->intitule) selected @endif>
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
                                            <input type="radio" name="sexe" @if($adjoint->personne->sexe == 'Feminin') checked @endif value="Feminin">
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
                                            <input type="radio" name="sexe" @if($adjoint->personne->sexe == 'Masculin') checked @endif value="Masculin">
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
                                            <input type="radio" name="status" @if($adjoint->personne->status == 'Marié') checked @endif value="Marié">
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
                                            <input type="radio" name="status" @if($adjoint->personne->status == 'Célibataire') checked @endif value="Célibataire">
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
                        <legend class="scheduler-border text-small" style="font-size: 1rem;">Categories de courriers à gérer</legend>
                        <div class="row px-1">
                            
                            @foreach ($categories as $category)
                            <div class="form-group col-4">
                                <div class=" btn text-left">
                                    <fieldset class="checkbox">
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            
                                            <input type="checkbox" @if(in_array($category->id, $adjoint_categories))
                                                checked
                                            @endif name="categories[]" value="{{$category->id}}">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span class="">{{$category->intitule}}</span>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </fieldset>
                </div>
                
            </div>
            <div class="container d-flex justify-content-end">
                <button class="btn btn-primary mx-1" type="submit">Valider</button>
                <button class="btn btn-danger mx-1" type="reset">Annuler</button>
            </div>
        </form>
    </div>
</div>
