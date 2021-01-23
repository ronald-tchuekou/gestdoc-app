<table class="table table-striped dataex-html5-selectors">
    <thead>
        <tr>
            <th>Numero</th>
            <th>Nom</th>
            <th>Adresse</th>Ad
            <th>Telephone</th>
            <th>Email</th>
            <th>Numero Contribuable</th>
            <th>Registre Commerce</th>
            <th>Agence</th>
            <th>Categorie</th>
            <th>Avoirs</th>
        </tr>
    </thead>
    <tbody>

    @foreach($clients as $client)

        <tr>
            <td>{{$client->idClient}}</td>
            <td>{{$client->nomClient}}</td>
            <td>{{$client->adresse}}</td>
            <td>{{$client->telephoneClient}}</td>
            <td>{{$client->emailClient}}</td>
            <td>{{$client->numContr}}</td>
            <td>{{$client->registCom}}</td>
            <td>{{$client->agences}}</td>
            <td>{{$client->categorieClient}}</td>
            <td>{{$client->avoirs}}</td>
        </tr>
    
    @endforeach

    </tbody>

</table>