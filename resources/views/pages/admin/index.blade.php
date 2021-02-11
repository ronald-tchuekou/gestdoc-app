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
    <div class="col-lg-4 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Activités réçentes</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <ul class="activity-timeline timeline-left list-unstyled">
                        <li>
                            <div class="timeline-icon bg-primary">
                                <i class="feather icon-plus font-medium-2 align-middle"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold mb-0">Client Meeting</p>
                                <span class="font-small-3">Bonbon macaroon jelly beans gummi bears
                                    jelly lollipop apple</span>
                            </div>
                            <small class="text-muted">25 mins ago</small>
                        </li>
                        <li>
                            <div class="timeline-icon bg-warning">
                                <i class="feather icon-alert-circle font-medium-2 align-middle"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold mb-0">Email Newsletter</p>
                                <span class="font-small-3">Cupcake gummi bears soufflé caramels
                                    candy</span>
                            </div>
                            <small class="text-muted">15 days ago</small>
                        </li>
                        <li>
                            <div class="timeline-icon bg-danger">
                                <i class="feather icon-check font-medium-2 align-middle"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold mb-0">Plan Webinar</p>
                                <span class="font-small-3">Candy ice cream cake. Halvah gummi
                                    bears</span>
                            </div>
                            <small class="text-muted">20 days ago</small>
                        </li>
                        <li>
                            <div class="timeline-icon bg-success">
                                <i class="feather icon-check font-medium-2 align-middle"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold mb-0">Launch Website</p>
                                <span class="font-small-3">Candy ice cream cake. </span>
                            </div>
                            <small class="text-muted">25 days ago</small>
                        </li>
                        <li>
                            <div class="timeline-icon bg-primary">
                                <i class="feather icon-check font-medium-2 align-middle"></i>
                            </div>
                            <div class="timeline-info">
                                <p class="font-weight-bold mb-0">Marketing</p>
                                <span class="font-small-3">Candy ice cream. Halvah bears Cupcake
                                    gummi bears.</span>
                            </div>
                            <small class="text-muted">28 days ago</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Liste des courriers en cours de traitement</h4>
            </div>
            <div class="card-content">
                <div class="table-responsive mt-1">
                    <table class="table table-hover-animation mb-0">
                        <thead>
                            <tr>
                                <th>CATEGORIE</th>
                                <th>ETAT</th>
                                <th>OPERATEUR</th>
                                <th>PROBLEME</th>
                                <th>OBSERVATION</th>
                                <th>DATE DEBUT</th>
                                <th>DATE FIN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#879985</td>
                                <td><i
                                        class="fa fa-circle font-small-3 text-success mr-50"></i>Moving
                                </td>
                                <td class="p-1">
                                    <ul
                                        class="list-unstyled users-list m-0  d-flex align-items-center">
                                        <li data-toggle="tooltip" data-popup="tooltip-custom"
                                            data-placement="bottom"
                                            data-original-title="Vinnie Mostowy"
                                            class="avatar pull-up">
                                            <img class="media-object rounded-circle"
                                                src="../images/portrait/small/avatar-s-5.jpg"
                                                alt="Avatar" height="30" width="30"/>
                                        </li>
                                    </ul>
                                </td>
                                <td>Anniston, Alabama</td>
                                <td>
                                    <span>80%</span>
                                    <div class="progress progress-bar-success mt-1 mb-0">
                                        <div class="progress-bar" role="progressbar"
                                                style=" width: '80%' " aria-valuenow="80" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td>14:58 26/07/2018</td>
                                <td>28/07/2018</td>
                            </tr>
                            <tr>
                                <td>#156897</td>
                                <td><i
                                        class="fa fa-circle font-small-3 text-warning mr-50"></i>Pending
                                </td>
                                <td class="p-1">
                                    <ul
                                        class="list-unstyled users-list m-0  d-flex align-items-center">
                                        <li data-toggle="tooltip" data-popup="tooltip-custom"
                                            data-placement="bottom"
                                            data-original-title="Trina Lynes"
                                            class="avatar pull-up">
                                            <img class="media-object rounded-circle"
                                                src="../images/portrait/small/avatar-s-1.jpg"
                                                alt="Avatar" height="30" width="30"/>
                                        </li>
                                        
                                    </ul>
                                </td>
                                <td>Cordova, Alaska</td>
                                <td>
                                    <span>60%</span>
                                    <div class="progress progress-bar-warning mt-1 mb-0">
                                        <div class="progress-bar" role="progressbar"
                                                style=" width: '60%' " aria-valuenow="60" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td>14:58 26/07/2018</td>
                                <td>28/07/2018</td>
                            </tr>
                            <tr>
                                <td>#568975</td>
                                <td><i
                                        class="fa fa-circle font-small-3 text-success mr-50"></i>Moving
                                </td>
                                <td class="p-1">
                                    <ul
                                        class="list-unstyled users-list m-0  d-flex align-items-center">
                                        <li data-toggle="tooltip" data-popup="tooltip-custom"
                                            data-placement="bottom"
                                            data-original-title="Lai Lewandowski"
                                            class="avatar pull-up">
                                            <img class="media-object rounded-circle"
                                                src="../images/portrait/small/avatar-s-6.jpg"
                                                alt="Avatar" height="30" width="30"/>
                                        </li>
                                        
                                    </ul>
                                </td>
                                <td>Florence, Alabama</td>
                                <td>
                                    <span>70%</span>
                                    <div class="progress progress-bar-success mt-1 mb-0">
                                        <div class="progress-bar" role="progressbar"
                                                style=" width: '70%' " aria-valuenow="70" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td>14:58 26/07/2018</td>
                                <td>28/07/2018</td>
                            </tr>
                            <tr>
                                <td>#245689</td>
                                <td><i
                                        class="fa fa-circle font-small-3 text-danger mr-50"></i>Canceled
                                </td>
                                <td class="p-1">
                                    <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                                        <li data-toggle="tooltip" data-popup="tooltip-custom"
                                            data-placement="bottom"
                                            data-original-title="Vinnie Mostowy"
                                            class="avatar pull-up">
                                            <img class="media-object rounded-circle"
                                                src="../images/portrait/small/avatar-s-5.jpg"
                                                alt="Avatar" height="30" width="30"/>
                                        </li>
                                    </ul>
                                </td>
                                <td>Clifton, Arizona</td>
                                <td>
                                    <span>95%</span>
                                    <div class="progress progress-bar-danger mt-1 mb-0">
                                        <div class="progress-bar" role="progressbar"
                                                style=" width: '95%' " aria-valuenow="95" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </td>
                                <td>14:58 26/07/2018</td>
                                <td>28/07/2018</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endSection