@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
      <div class="content container-fluid">
            <div class="page-header">
                  <div class="row align-items-center">
                        <div class="col-sm-12">
                              <div class="page-sub-header">
                                    <h3 class="page-title">Détails de Sinisters AT & RD</h3>
                                    <ul class="breadcrumb">
                                          <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Tableau de Bord</a></li>
                                          <li class="breadcrumb-item active">Détails de Sinisters AT & RD</li>
                                    </ul>
                              </div>
                        </div>
                  </div>
            </div>









            <!-- ===================================== -->
            <div class="row">

                  <div class="col-md-6 col-lg-6">
                        <div class="card card-chart">
                              <div class="card-header">
                                    <div class="row align-items-center">
                                          <div class="col-6">
                                                <h5 class="card-title">Entrées</h5>
                                          </div>
                                          <div class="col-6">
                                                <ul class="chart-list-out">
                                                      <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <div id="sinisterAtRdRemis"></div>
                              </div>
                        </div>
                  </div>

                  <div class="col-md-6 col-lg-6">
                        <div class="card card-chart">
                              <div class="card-header">
                                    <div class="row align-items-center">
                                          <div class="col-6">
                                                <h5 class="card-title">Sorties</h5>
                                          </div>
                                          <div class="col-6">
                                                <ul class="chart-list-out">
                                                      <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <div id="sinisterAtRDateTraitement"></div>
                              </div>
                        </div>
                  </div>

            </div>

            <div class="row">

                  <div class="col-md-6 col-lg-6">
                        <div class="card card-chart">
                              <div class="card-header">
                                    <div class="row align-items-center">
                                          <div class="col-6">
                                                <h5 class="card-title">Instance</h5>
                                          </div>
                                          <div class="col-6">
                                                <ul class="chart-list-out">
                                                      <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <div id="sinisterAtRdDateTraitementNull"></div>
                              </div>
                        </div>
                  </div>

                  <div class="col-md-6 col-lg-6">
                        <div class="card card-chart">
                              <div class="card-header">
                                    <div class="row align-items-center">
                                          <div class="col-6">
                                                <h5 class="card-title">Délai moyen de traitement en Jours</h5>
                                          </div>
                                          <div class="col-6">
                                                <ul class="chart-list-out">
                                                      <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <div id="sinisterAtRdDelaiMoyenTraitement"></div>
                              </div>
                        </div>
                  </div>

            </div>
            <div class="row">
            <div class="col-md-12 col-lg-12">
                        <div class="card card-chart">
                              <div class="card-header">
                                    <div class="row align-items-center">
                                          <div class="col-6">
                                                <h5 class="card-title">Données du Mois</h5>
                                          </div>
                                          <div class="col-6">
                                                <ul class="chart-list-out">
                                                      <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <div id="sinisterAtRdChartByChargeCompte"></div>
                              </div>
                        </div>
                  </div>
                  </div>
                  <div class="row">
            <div class="col-md-12 col-lg-12">
                        <div class="card card-chart">
                              <div class="card-header">
                                    <div class="row align-items-center">
                                          <div class="col-6">
                                                <h5 class="card-title">Données Cumulées</h5>
                                          </div>
                                          <div class="col-6">
                                                <ul class="chart-list-out">
                                                      <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <div id="sinisterAtRdChartChargeCompteTwelve"></div>
                              </div>
                        </div>
                  </div>
                  </div>

                  <div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card card-chart">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title">Délai moyen de traitement en Jours</h5>
                    </div>
                    <div class="col-6">
                        <ul class="chart-list-out">
                            <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Add this div for the chart -->
                <div id="meanDelaiTraitementGlobalSinisterAtRd"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
                  <div class="col-md-12 col-lg-12">
                        <div class="card card-chart">
                              <div class="card-header">
                                    <div class="row align-items-center">
                                          <div class="col-6">
                                                <h5 class="card-title">Actes de gestion du mois</h5>
                                          </div>
                                          <div class="col-6">
                                                <ul class="chart-list-out">
                                                      <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <!-- Add this div for the chart -->
                                    <div id="acteGestionMoisAtRd"></div>
                              </div>
                        </div>
                  </div>
            </div>

            <div class="row">
                  <div class="col-md-12 col-lg-12">
                        <div class="card card-chart">
                              <div class="card-header">
                                    <div class="row align-items-center">
                                          <div class="col-6">
                                                <h5 class="card-title">Actes de gestion cumulés</h5>
                                          </div>
                                          <div class="col-6">
                                                <ul class="chart-list-out">
                                                      <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <!-- Add this div for the chart -->
                                    <div id="acteGestionTwelveMoisAtRd"></div>
                              </div>
                        </div>
                  </div>
            </div>

            <div class="row">
                  <div class="col-md-12 col-lg-12">
                        <div class="card card-chart">
                              <div class="card-header">
                                    <div class="row align-items-center">
                                          <div class="col-6">
                                                <h5 class="card-title">Délai moyen de traitement</h5>
                                          </div>
                                          <div class="col-6">
                                                <ul class="chart-list-out">
                                                      <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                              <div class="card-body">
                                    <!-- Add this div for the chart -->
                                    <div id="acteGestionAverageCurrentMoisAtRd"></div>
                              </div>
                        </div>
                  </div>
            </div>
            <!-- =================================== -->




      </div>
</div>
@endsection