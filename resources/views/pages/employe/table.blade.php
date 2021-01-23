<table class="table table-striped dataex-html5-selectors">
    <thead>
        <tr>
            <th>Code</th>
            <th>Nom Complet</th>
            <th>Adresse</th>
            <th>Telephone</th>
            <th>CNI</th>
            <th>Email</th>
            <th>Autres Contacts</th>
            <th>Agence</th>
        </tr>
    </thead>
    <tbody>

    @foreach($emploies as $employe)
        <tr>
            <td>{{$employe->codeEmploye}}</td>
            <td>{{$employe->nomComplet}}</td>
            <td>{{$employe->adresse}}</td>
            <td>{{$employe->telephone}}</td>
            <td>{{$employe->cni}}</td>
            <td>{{$employe->emailemp}}</td>
            <td>{{$employe->autreContact}}</td>
            <td>{{$employe->sonAgence}}</td>
        </tr>

    @endforeach

    </tbody>

</table>