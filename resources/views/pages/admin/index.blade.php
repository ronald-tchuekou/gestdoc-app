@extends('layouts.template')
 
@section('content')

<div class="row match-height">
    <div class="col-lg-4 col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between pb-0">
                <h4>Rapport de courier</h4>
                <div class="dropdown chart-dropdown">
                    <button class="btn btn-sm border-0 dropdown-toggle p-0" type="button"
                        id="dropdownItem2" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        Il ya 7 jours
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem2">
                        <a class="dropdown-item" href="#">Il ya 28 jours</a>
                        <a class="dropdown-item" href="#">Il ya 1 moi</a>
                        <a class="dropdown-item" href="#">Il ya 1 an</a>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div id="product-order-chart" class="mb-3"></div>
                    <div class="chart-info d-flex justify-content-between mb-1">
                        <div class="series-info d-flex align-items-center">
                            <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                            <span class="text-bold-600 ml-50">Validé</span>
                        </div>
                        <div class="product-result">
                            <span>23043</span>
                        </div>
                    </div>
                    <div class="chart-info d-flex justify-content-between mb-1">
                        <div class="series-info d-flex align-items-center">
                            <i class="fa fa-circle-o text-bold-700 text-warning"></i>
                            <span class="text-bold-600 ml-50">Traité</span>
                        </div>
                        <div class="product-result">
                            <span>14658</span>
                        </div>
                    </div>
                    <div class="chart-info d-flex justify-content-between mb-75">
                        <div class="series-info d-flex align-items-center">
                            <i class="fa fa-circle-o text-bold-700 text-danger"></i>
                            <span class="text-bold-600 ml-50">Rejeté</span>
                        </div>
                        <div class="product-result">
                            <span>4758</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-start">
                <div>
                    <h4 class="card-title">Situation de comptes</h4>
                    <p class="text-muted mt-25 mb-0">Il ya 1 moi</p>
                </div>
                <div class="dropdown chart-dropdown">
                    <button class="btn btn-sm border-0 p-0" type="button"
                        id="account_state" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="feather icon-more-vertical font-medium-3 text-muted cursor-pointer"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="account_state">
                        <a class="dropdown-item" href="#">Il ya 2 mois</a>
                        <a class="dropdown-item" href="#">Il ya 5 mois</a>
                        <a class="dropdown-item" href="#">Il ya 1 an</a>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body px-0">
                    <div id="sales-chart"></div>
                </div>
            </div>
        </div>
    </div>
    
    @include('pages.admin.components.recent_activities')
    
</div>

@include('pages.admin.components.current_assignment')

@endSection