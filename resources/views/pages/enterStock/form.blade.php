@include('errors.errors')
@include('success.success')
<form class="form" action="entree-stock" method="post">
    @csrf
    @method('POST')
    <div class="form-body">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input disabled type="number" id="first-name-column"
                        class="form-control" placeholder="Numero" value="{{old('id') }}"
                        name="id">
                    <label for="first-name-column">Numero</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="date" id="last-name-column"
                        class="form-control" placeholder="Date"
                        value="{{old('dateEntree') }}" name="dateEntree">
                    <label for="last-name-column">Date</label>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="city-column" class="form-control" value="{{old('reference') }}"
                        placeholder="Numero de lot " name="reference">
                    <label for="city-column">Numero de lot</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="country-floating"
                        class="form-control" name="prixAchat" value="{{old('prixAchat') }}"
                        placeholder="Prix d'Achat">
                    <label for="country-floating">Prix d'Achat</label>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <div class="form-group">
                        <label for="">Fournisseur</label>
                        <select class="select2 form-control" name="fournisseur" value="{{old('fournisseur') }}">
                            <option 
                                value="square" 
                                @if(old('fournisseur') == 'square') selected @endif>
                                    Square
                            </option>
                            <option
                                value="rectangle" 
                                @if(old('fournisseur') == 'rectangle') selected @endif>
                                    Rectangle
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <div class="form-group">
                        <label for="">Magasin d'origine</label>
                        <select class="select2 form-control" name="magOrigine" value="{{ old('magOrigine') }}">
                            <option 
                                value="square" 
                                @if(old('magOrigine') == 'square') selected @endif>
                                    Square
                            </option>
                            <option
                                value="rectangle" 
                                @if(old('magOrigine') == 'rectangle') selected @endif>
                                    Rectangle
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <div class="form-group">
                        <label for="">Magasin destination</label>
                        <select class="select2 form-control" name="magDestination" value="{{ old('magDestination') }}">
                            <option 
                                value="square" 
                                @if(old('magDestination') == 'square') selected @endif>
                                    Square
                            </option>
                            <option
                                value="rectangle" 
                                @if(old('magDestination') == 'rectangle') selected @endif>
                                    Rectangle
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <div class="form-group">
                        <label for="">Motif entree</label>
                        <select class="select2 form-control" name="motifEntree" value="{{ old('motifEntree') }}">
                            <option 
                                value="square" 
                                @if(old('motifEntree') == 'square') selected @endif>
                                    Square
                            </option>
                            <option
                                value="rectangle" 
                                @if(old('motifEntree') == 'rectangle') selected @endif>
                                    Rectangle
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <div class="form-group">
                        <label for="">Produit</label>
                        <select class="select2 form-control" name="idProduit">
                            <option 
                                value="square" 
                                @if(old('idProduit') == 'square') selected @endif>
                                    Square
                            </option>
                            <option
                                value="rectangle" 
                                @if(old('idProduit') == 'rectangle') selected @endif>
                                    Rectangle
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="date" id="datePeremption" value="{{ old('datePeremption') }}"
                        class="form-control" placeholder="Date Peremption"
                        name="datePeremption">
                    <label for="datePeremption">Date Peremption</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="selecteur" value="{{ old('selecteur') }}"
                        class="form-control" placeholder="Selecteur"
                        name="selecteur">
                    <label for="selecteur">Selecteur</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="qtEntree" value="{{ old('qtEntree') }}"
                        class="form-control" placeholder="Qte"
                        name="qtEntree">
                    <label for="qtEntree">Qte</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-label-group">
                    <textarea type="text" id="observation"
                        class="form-control  ag-large-textarea" placeholder="Observation"
                        name="observation">{{ old('observation') }}</textarea>
                    <label for="observation">Observation</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit"
                    class="btn btn-primary mr-1 mb-1">Ajouter</button>
            </div>
        </div>
    </div>
</form>