@extends('layouts.template')

@section('content')
<div class="row">
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-header"><h3>Liste de tous les service</h3></div>
            <div class="card-body">
                <ul class="list-group" id="service_id">
                    @foreach ($services as $service)
                        <li id="item-{{$service->id}}" class="list-group-item d-flex justify-content-between service-item align-items-center">
                            <span class="text-truncate">
                                {{$service->id}} <i class="feather icon-minus"></i> {{$service->intitule}}
                            </span>
                            <div class="options d-flex">
                                <span class="cursor-pointer edit" data-id="{{$service->id}}" data-intitule="{{$service->intitule}}"><i class="feather icon-edit-2"></i></span>
                                <span class="cursor-pointer delete" data-id="{{$service->id}}"><i class="feather icon-trash"></i></span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="card" id="service-form-content">
            <div class="card-header">
                <div class="d-flex mb-3">
                    <a id="form-back" class="ml-1 text-secondary" style="font-size: 2rem;"><i class="feather icon-arrow-left"></i></a>&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;<h3 class="font-weight-bolder" id="form-title">Formulaire d'ajout d'un nouveau service</h3>
                </div>
            </div>
            <div class="card-body">
                <form action="/{{strtolower(Auth::user()->role)}}/services/store" class="form" id="service_form">
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="service">Intitulé du service</label>
                            <input required minlength="5" type="text" class="form-control" name="service" id="service">
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
