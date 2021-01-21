<table class="table table-striped dataex-html5-selectors">
    <thead>
        <tr>
            <th>Numero</th>
            <th>Fournisseur</th>
            <th>Adresse</th>
            <th>Telephone</th>
            <th>Email</th>
                <th>Numero Contribuable</th>
            <th>Registre de Commerce</th>
        </tr>
    </thead>
    <tbody>

    @foreach($fournisseurs as $fournisseur)

        <tr>
            <td>{{$fournisseur->idFournisseur}}</td>
            <td>{{$fournisseur->nomFournisseur}}</td>
            <td>{{$fournisseur->adresse}}</td>
            <td>{{$fournisseur->telephoneFour}}</td>
            <td>{{$fournisseur->emailFour}}</td>
            <td>{{$fournisseur->nomContrF}}</td>
            <td>{{$fournisseur->regComF}}</td>
        </tr>

    @endforeach
        
    </tbody>

</table>