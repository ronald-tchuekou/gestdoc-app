<table class="table table-striped dataex-html5-selectors">
    <thead>
        <tr>
            <th>Designation</th>
            <th>Qte Entree</th>
            <th>Date peremtion</th>
            <th>Reference</th>
            <th>Prix Achat</th>
            <th>observations</th>
            <th>margasin d'origine</th>
        </tr>
    </thead>
    <tbody>
        @foreach($entreeStocks as $entreeStock)

            <tr>
                <td>{{$entreeStock->idEntree}}</td>
                <td>{{$entreeStock->get_detailStock->qtEntree}}</td>
                <td>{{$entreeStock->get_detailStock->datePeremption}}</td>
                <td>{{$entreeStock->get_detailStock->reference}}</td>
                <td>{{$entreeStock->get_detailStock->prixAchat}}</td>
                <td>{{$entreeStock->get_detailStock->observation}}</td>
                <td>{{$entreeStock->magOrigine}}</td>
            </tr>

        @endforeach
    
    </tbody>

</table>