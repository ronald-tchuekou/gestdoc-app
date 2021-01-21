@include('errors.errors')
@include('success.success')
<form class="form" action="sortie-stock" method="post">
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
                        value="{{old('dateSortie') }}" name="dateSortie">
                    <label for="last-name-column">Date</label>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="city-column" class="form-control" value="{{old('referenceP') }}"
                        placeholder="Numero de lot " name="referenceP">
                    <label for="city-column">Numero de lot</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <div class="form-group">
                        <label for="">Magasin de sortie</label>
                        <select class="select2 form-control" name="magSortie" value="{{ old('magSortie') }}">
                            <option 
                                value="square" 
                                @if(old('magSortie') == 'square') selected @endif>
                                    Square
                            </option>
                            <option
                                value="rectangle" 
                                @if(old('magSortie') == 'rectangle') selected @endif>
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
                        <select class="select2 form-control" name="magDest" value="{{ old('magDest') }}">
                            <option 
                                value="square" 
                                @if(old('magDest') == 'square') selected @endif>
                                    Square
                            </option>
                            <option
                                value="rectangle" 
                                @if(old('magDest') == 'rectangle') selected @endif>
                                    Rectangle
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <div class="form-group">
                        <label for="">Motif sortie</label>
                        <select class="select2 form-control" name="motifSortie" value="{{ old('motifSortie') }}">
                            <option 
                                value="square" 
                                @if(old('motifSortie') == 'square') selected @endif>
                                    Square
                            </option>
                            <option
                                value="rectangle" 
                                @if(old('motifSortie') == 'rectangle') selected @endif>
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
                    <input type="date" id="datePeremption" value="{{ old('datePeremptionS') }}"
                        class="form-control" placeholder="Date Peremption"
                        name="datePeremptionS">
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
                    <input type="text" id="qtSortie" value="{{ old('qtSortie') }}"
                        class="form-control" placeholder="Qte"
                        name="qtSortie">
                    <label for="qtSortie">Qte</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-label-group">
                    <textarea type="text" id="obserSortie"
                        class="form-control  ag-large-textarea" placeholder="Observation"
                        name="obserSortie">{{ old('obserSortie') }}</textarea>
                    <label for="obserSortie">Observation</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit"
                    class="btn btn-primary mr-1 mb-1">Ajouter</button>
            </div>
        </div>
    </div>
</form>