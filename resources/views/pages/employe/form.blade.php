@include('errors.errors')
@include('success.success')
<form class="form">
    @csrf
    @method('POST')
    <div class="form-body">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="number" id="first-name-column"
                        class="form-control" placeholder="Code Employe"
                        name="fname-column">
                    <label for="first-name-column">Code Employe</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="last-name-column"
                        class="form-control" placeholder="Nom et Prenom"
                        name="lname-column">
                    <label for="last-name-column">Nom et Prenom</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="last-name-column"
                        class="form-control" placeholder="Adresse"
                        name="lname-column">
                    <label for="last-name-column">Addresse</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="last-name-column"
                        class="form-control" placeholder="CNI_Date de delivrance"
                        name="lname-column">
                    <label for="last-name-column">CNI_Date de delivrance</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="last-name-column"
                        class="form-control" placeholder="Autres Contacts"
                        name="lname-column">
                    <label for="last-name-column">Autres Contacts</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="text" id="last-name-column"
                        class="form-control" placeholder="Telephone"
                        name="lname-column">
                    <label for="last-name-column">Telephone</label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <input type="email" id="last-name-column"
                        class="form-control" placeholder="Email"
                        name="lname-column">
                    <label for="last-name-column">Email</label>
                </div>
            </div>
                <div class="col-md-6 col-12">
                <div class="form-label-group">
                    <div class="form-group">
                        <label for="">Agence</label>
                        <select class="select2 form-control">
                            <option value="square">Square</option>
                            <option value="rectangle">Rectangle</option>

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