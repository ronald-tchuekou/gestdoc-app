@include('errors.errors')
@include('success.success')
<form class="form" action="clients" method="post">
    @csrf
    @method('POST')
    <div class="form-body">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="number" id="idClient" value="{{ old('idClient') }}"
                        class="form-control" placeholder="Numero"
                        disabled name="idClient">
                    <label for="idClient">Numero</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="nomClient" value="{{ old('nomClient') }}"
                        class="form-control" placeholder="Nom et Prenom"
                        name="nomClient">
                    <label for="nomClient">Nom et Prenom</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="adresse" value="{{ old('adresse') }}"
                        class="form-control" placeholder="Adresse"
                        name="adresse">
                    <label for="adresse">Addresse</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="telephoneClient"
                        class="form-control" value="{{ old('telephoneClient') }}"
                        placeholder="Telephone"
                        name="telephoneClient">
                    <label for="telephoneClient">Telephone</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="avoirs" value="{{ old('avoirs') }}"
                        class="form-control" placeholder="Avoir"
                        name="avoirs">
                    <label for="avoirs">Avoir</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="email" id="emailClient" value="{{ old('emailClient') }}"
                        class="form-control" placeholder="Email"
                        name="emailClient">
                    <label for="emailClient">Email</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="numContr" value="{{ old('numContr') }}"
                        class="form-control" placeholder="Numero Contribuable"
                        name="numContr">
                    <label for="numContr">Numero Contribuable</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="registCom" value="{{ old('registCom') }}"
                        class="form-control" placeholder="Registre de Commerce"
                        name="registCom">
                    <label for="registCom">Registre commerce</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <div class="form-group">
                        <label for="">Categorie</label>
                        <select class="select2 form-control" name="categorieClient">
                            <option 
                                value="square" 
                                @if(old('categorieClient') == 'square') selected @endif>
                                    Square
                            </option>
                            <option
                                value="rectangle" 
                                @if(old('categorieClient') == 'rectangle') selected @endif>
                                    Rectangle
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <div class="form-group">
                        <label for="">Agence</label>
                        <select class="select2 form-control" name="agences">
                            <option 
                                value="square" 
                                @if(old('agences') == 'square') selected @endif>
                                    Square
                            </option>
                            <option
                                value="rectangle" 
                                @if(old('agences') == 'rectangle') selected @endif>
                                    Rectangle
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit"
                    class="btn btn-primary mr-1 mb-1">Ajouter</button>
            </div>
        </div>
    </div>
</form>