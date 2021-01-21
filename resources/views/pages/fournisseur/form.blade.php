@include('errors.errors')
@include('success.success')
<form class="form" action="fournisseurs" method="post">
    @csrf
    @method('POST')
    <div class="form-body">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input disabled type="number" id="first-name-column" value="{{ old('id') }}"
                        class="form-control" placeholder="Numero"
                        name="id">
                    <label for="first-name-column">Numero</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="nomFournisseur" value="{{ old('nomFournisseur') }}"
                        class="form-control" placeholder="Nom et Prenom"
                        name="nomFournisseur">
                    <label for="nomFournisseur">Nom et Prenom</label>
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
                    <input type="text" id="nomContrF" value="{{ old('nomContrF') }}"
                        class="form-control" placeholder="N° Contribuable"
                        name="nomContrF">
                    <label for="nomContrF">N° Contribuable</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="regComF" value="{{ old('regComF') }}"
                        class="form-control" placeholder="Registre de Commerce"
                        name="regComF">
                    <label for="regComF">Registre de Commerce</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="telephoneFour" value="{{ old('telephoneFour') }}"
                        class="form-control" placeholder="Telephone"
                        name="telephoneFour">
                    <label for="telephoneFour">Telephone</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="email" id="emailFour" value="{{ old('emailFour') }}"
                        class="form-control" placeholder="Email"
                        name="emailFour">
                    <label for="emailFour">Email</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit"
                    class="btn btn-primary mr-1 mb-1">Ajouter</button>
            </div>
        </div>
    </div>
</form>