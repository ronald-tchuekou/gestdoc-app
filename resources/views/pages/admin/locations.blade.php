@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header"><h3>Liste de tous les localisations</h3></div>
            <div class="card-body">
                <ul class="list-group" id="location_id" data-role="{{strtolower(Auth::user()->role)}}">
                    @foreach ($locations as $location)
                        <li id="item-{{$location->id}}" class="list-group-item d-flex justify-content-between location-item align-items-center">
                            <span class="text-truncate">
                                {{$location->id}} <i class="feather icon-minus"></i> {{$location->intitule}}
                            </span>
                            <div class="options d-flex">
                                <span class="cursor-pointer edit" data-id="{{$location->id}}" data-intitule="{{$location->intitule}}"><i class="feather icon-edit-2"></i></span>
                                <span class="cursor-pointer delete" data-id="{{$location->id}}"><i class="feather icon-trash"></i></span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card" id="location-form-content">
            <div class="card-header">
                <div class="d-flex mb-3">
                    <a id="form-back" class="ml-1 text-secondary" style="font-size: 2rem;"><i class="feather icon-arrow-left"></i></a>&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;<h3 class="font-weight-bolder" id="form-title">Formulaire d'ajout d'une nouvelle localisation</h3>
                </div>
            </div>
            <div class="card-body">
                <form action="/{{strtolower(Auth::user()->role)}}/localisations/store" class="form" id="location_form">
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="location">Intitulé de la localisation</label>
                            <input required minlength="5" type="text" class="form-control" name="location" id="location">
                        </div>
                        <div class="col-8">
                            <button class="btn btn-primary m-0" type="submit">Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
