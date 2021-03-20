<div class="tab-pane fade" id="account-vertical-courrier_categories" role="tabpanel" aria-labelledby="account-pill-courrier_categories" aria-expanded="false">
   
    <div class="h3">Type de courriers dont la gestion sera éffectuer par vous</div>

    <div class="row">
        <div class="card-body">
            <ul class="list-group" id="cat_courrier_id">
                @foreach ($categories as $category)
                    <li id="item-{{$category->id}}" class="list-group-item d-flex justify-content-between cat-item align-items-center">
                        <span class="text-truncate">
                            {{$category->id}} <i class="feather icon-minus"></i> {{$category->intitule}}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>