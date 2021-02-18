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
                        <a class="dropdown-item courrier-date_intervalle" href="#" data-content = "28d">Il ya 28 jours</a>
                        <a class="dropdown-item courrier-date_intervalle" href="#" data-content = "1m">Il ya 1 moi</a>
                        <a class="dropdown-item courrier-date_intervalle" href="#" data-content = "1y">Il ya 1 an</a>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div id="courrier-order-chart" class="mb-3"></div>
                    <div class="chart-info d-flex justify-content-between mb-1">
                        <div class="series-info d-flex align-items-center">
                            <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                            <span class="text-bold-600 ml-50">Validé</span>
                        </div>
                        <div class="product-result">
                            <span id="total_valide_courrier">23043</span>
                        </div>
                    </div>
                    <div class="chart-info d-flex justify-content-between mb-1">
                        <div class="series-info d-flex align-items-center">
                            <i class="fa fa-circle-o text-bold-700 text-warning"></i>
                            <span class="text-bold-600 ml-50">Traité</span>
                        </div>
                        <div class="product-result">
                            <span id="total_traite_courrier">14658</span>
                        </div>
                    </div>
                    <div class="chart-info d-flex justify-content-between mb-75">
                        <div class="series-info d-flex align-items-center">
                            <i class="fa fa-circle-o text-bold-700 text-danger"></i>
                            <span class="text-bold-600 ml-50">Rejeté</span>
                        </div>
                        <div class="product-result">
                            <span id="total_reject_courrier">4758</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-12">
    <div class="card">
            <div class="card-header d-flex justify-content-between pb-0">
                <h4>Rapport des utilisateurs</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div id="users-chart" class="mb-3"></div>
                    <div class="container mt-auto">
                        <div class="chart-info d-flex justify-content-between mb-1">
                            <div class="series-info d-flex align-items-center">
                                <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                                <span class="text-bold-600 ml-50">Actifs</span>
                            </div>
                            <div class="product-result">
                                <span id="total_valide_courrier">23043</span>
                            </div>
                        </div>
                        <div class="chart-info d-flex justify-content-between mb-1">
                            <div class="series-info d-flex align-items-center">
                                <i class="fa fa-circle-o text-bold-700 text-warning"></i>
                                <span class="text-bold-600 ml-50">Non actifs</span>
                            </div>
                            <div class="product-result">
                                <span id="total_traite_courrier">14658</span>
                            </div>
                        </div>
                        <div class="chart-info d-flex justify-content-between mb-75">
                            <div class="series-info d-flex align-items-center">
                                <i class="fa fa-circle-o text-bold-700 text-danger"></i>
                                <span class="text-bold-600 ml-50">Supprimés</span>
                            </div>
                            <div class="product-result">
                                <span id="total_reject_courrier">4758</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    @include('pages.admin.components.recent_activities')
    
</div>

@include('pages.admin.components.current_assignment')

@endSection