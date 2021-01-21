<table class="table table-striped dataex-html5-selectors">
    <thead>
        <tr>
            <th>ref</th>
            <th>Designation</th>
            <th>Qte Sortie</th>
            <th>observations</th>
            <th>Date Peremption</th>
            <th>Provenance</th>
            <th>Destination</th>
        </tr>
    </thead>
    <tbody>

        @foreach($sortieStocks as $sortieStock)

            <tr>
                <td>{{$sortieStock->idSortie}}</td>
                <td>{{$sortieStock->get_detailStock->referenceP}}</td>
                <td>{{$sortieStock->get_detailStock->qteSortie}}</td>
                <td>{{$sortieStock->get_detailStock->obserSortie}}</td>
                <td>{{$sortieStock->get_detailStock->datePeremptionS}}</td>
                <td>{{$sortieStock->get_detailStock->magSortie}}</td>
                <td>{{$sortieStock->get_detailStock->magDest}}</td>
            </tr>

        @endforeach

    </tbody>

</table>