@include('errors.errors')
@include('success.success')
<form class="form" action="emploies" method="post">
    @csrf
    @method('POST')
    <div class="form-body">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="codeEmploye" value="{{ old('codeEmploye') }}"
                        class="form-control" placeholder="Code Employe"
                        name="codeEmploye">
                    <label for="codeEmploye">Code Employe</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="nomComplet" value="{{ old('nomComplet') }}"
                        class="form-control" placeholder="Nom et Prenom"
                        name="nomComplet">
                    <label for="nomComplet">Nom et Prenom</label>
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
                    <input type="text" id="cni" value="{{ old('cni') }}"
                        class="form-control" placeholder="CNI_Date de delivrance"
                        name="cni">
                    <label for="cni">CNI_Date de delivrance</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="autreContact" value="{{ old('autreContact') }}"
                        class="form-control" placeholder="Autres Contacts"
                        name="autreContact">
                    <label for="autreContact">Autres Contacts</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="telephone" value="{{ old('telephone') }}"
                        class="form-control" placeholder="Telephone"
                        name="telephone">
                    <label for="telephone">Telephone</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="email" id="emailemp" value="{{ old('emailemp') }}"
                        class="form-control" placeholder="Email"
                        name="emailemp">
                    <label for="emailemp">Email</label>
                </div>
            </div>
                <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <div class="form-group">
                        <label for="">Agence</label>
                        <select class="select2 form-control" name="sonAgence">
                            <option 
                                value="square" 
                                @if(old('sonAgence') == 'square') selected @endif>
                                    Square
                            </option>
                            <option
                                value="rectangle" 
                                @if(old('sonAgence') == 'rectangle') selected @endif>
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