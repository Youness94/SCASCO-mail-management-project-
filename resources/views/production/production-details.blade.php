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
                                    <h3 class="page-title">Détails de production</h3>
                                    <ul class="breadcrumb">
                                          <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Tableau de Bord</a></li>
                                          <li class="breadcrumb-item active">Détails de production</li>
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
                                    <div id="productionDateRemise"></div>
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
                                    <div id="productionDateTraitement"></div>
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
                                    <div id="productionDateTraitementNull"></div>
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
                                    <div id="productionDelaiMoyenTraitement"></div>
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
                                    <div id="productionChartByChargeCompte"></div>
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
                                    <div id="productionChartChargeCompteTwelve"></div>
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
                                    <div id="meanDelaiTraitementChartGlobal"></div>
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
                                    <div id="acteGestionMois"></div>
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
                                    <div id="acteGestionTwelveMois"></div>
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
                                    <div id="acteGestionAverageCurrentMois"></div>
                              </div>
                        </div>
                  </div>
            </div>


            <div class="row">
                  <div class="col-sm-12">
                        <div class="card card-table">
                              <div class="card-body">
                              <div class="card-body">
                                    <div class="page-header">
                                          <div class="row align-items-center">
                                                <div class="col">
                                                      <h3 class="page-title">Entrées / actes groupés</h3>
                                                </div>

                                          </div>
                                    </div>
                                    <div class="table-responsive">
                                          <table class="table table-striped">
                                                <thead>
                                                      <tr>
                                                            <!-- <th>Charge Compte ID</th> -->
                                                            <th>Nom</th>
                                                            @foreach($categories as $category)
                                                            <th>{{ $category }}</th>
                                                            @endforeach
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @foreach($data['data'] as $rowData)
                                                      <tr>
                                                            <!-- <td>{{ $rowData['charge_compte_id'] }}</td> -->
                                                            <td>{{ $rowData['charge_compte_name'] }}</td>
                                                            @foreach($categories as $category)
                                                            <td style="color: {{ $rowData[$category] == 0 ? 'gray' : 'blue' }}; font-size: {{ $rowData[$category] == 0 ? '14px' : '18px' }}">
                                                                  {{ $rowData[$category] == 0 ? '-' : $rowData[$category]  }}
                                                            </td>
                                                            @endforeach
                                                      </tr>
                                                      @endforeach
                                                </tbody>
                                          </table>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            
        
            <div class="row">
                  <div class="col-sm-12">
                        <div class="card card-table">
                              <div class="card-body">
                                    <div class="page-header">
                                          <div class="row align-items-center">
                                                <div class="col">
                                                      <h3 class="page-title">Sorties / actes groupés</h3>
                                                </div>

                                          </div>
                                    </div>
                                    <div class="table-responsive">
                                          <table class="table table-striped">
                                                <thead>
                                                      <tr>
                                                            <th>Nom</th>
                                                            @foreach($categories as $category)
                                                            <th>{{ $category }}</th>
                                                            @endforeach
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      @foreach($dataS['dataS'] as $rowData)
                                                      <tr>
                                                            <td>{{ $rowData['charge_compte_name'] }}</td>

                                                            @foreach($categories as $category)
                                                            <td style="color: {{ $rowData[$category] == 0 ? 'gray' : 'blue' }}; font-size: {{ $rowData[$category] == 0 ? '14px' : '18px' }}">
                                                                  {{ $rowData[$category] == 0 ? '-' : $rowData[$category]  }}</td>
                                                            @endforeach
                                                      </tr>
                                                      @endforeach
                                                </tbody>
                                          </table>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <div class="row">
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Instances / actes groupés</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <!-- <th>Charge Compte ID</th> -->
                                <th>Nom</th>
                                @foreach($categories as $category)
                                <th>{{ $category }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataN['dataN'] as $rowData)
                            <tr>
                                <!-- <td>{{ $rowData['charge_compte_id'] }}</td> -->
                                <td>{{ $rowData['charge_compte_name'] }}</td>
                                @foreach($categories as $category)
                                <td style="color: {{ $rowData[$category] == 0 ? 'gray' : 'blue' }}; font-size: {{ $rowData[$category] == 0 ? '14px' : '18px' }}">
                                    {{ $rowData[$category] == 0 ? '-' : $rowData[$category]  }}
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
            <!-- =================================== -->




      </div>
</div>
@endsection