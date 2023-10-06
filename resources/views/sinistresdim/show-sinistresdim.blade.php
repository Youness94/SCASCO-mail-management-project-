@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}


<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Sinistre DIM</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('all.sinistres.dim')}}">Retour aux Sinistres DIM</a></li>
                        <li class="breadcrumb-item active">Sinistres DIM</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="profile-header">
                    <div class="row align-items-center">
                        <div class="col-auto profile-image">

                        </div>
                        <div class="col ms-md-n2 profile-user-info">
                            <strong style="font-size: 3vw; display: inline-block; margin-right: 10px;">N° de déclaration:</strong>
                            <h1 class="form-title" style="font-size: 2vw; display: inline-block;">{{ $sinistres_dim->num_declaration }}</h1>
                        </div>
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">

                    <div class="tab-pane fade show active" id="per_details_tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                            <strong>Date de Reception:</strong>
                                            <h5> {{ $sinistres_dim->date_reception }}</h5>
                                        </div>
                                        <div class="row">
                                            <strong>Nom Assuré:</strong>
                                            <h5>{{ $sinistres_dim->nom_assure }}</h5>
                                        </div>
                                        <div class="row">
                                            <strong>Nom Adhèrent:</strong>
                                            <h5>{{ $sinistres_dim->nom_adherent}}</h5>
                                        </div>
                                        <div class="row">
                                            <strong>Branche:</strong>
                                            <h5>{{ optional($sinistres_dim->branches_dim)->nom }}</h5>
                                        </div>
                                        <div class="row">
                                            <strong>Compagnie:</strong>
                                            <h5>{{ optional($sinistres_dim->compagnies)->nom }}</h5>
                                        </div>
                                        <div class="row">
                                            <strong>Acte de gestion:</strong>
                                            <h5> {{ optional($sinistres_dim->acte_de_gestion_dim)->nom }}</h5>
                                        </div>
                                        <div class="row">
                                            <strong>Chargé de comptes:</strong>
                                            <h5>{{ optional($sinistres_dim->charge_compte_dim)->nom }}</h5>
                                        </div>
                                        
                                        <div class="row">
                                            <strong>Date de Remise:</strong>
                                            <h5> {{ $sinistres_dim->date_remise }}</h5>
                                        </div>
                                        <div class="row">
                                            <strong>Date de traitement:</strong>
                                            <h5> {{ $sinistres_dim->date_traitement }}</h5>
                                        </div>
                                        <div class="row">
                                            <strong>Délai de traitement:</strong>
                                            <h5>{{ $sinistres_dim->delai_traitement }} /Jours</h5>
                                        </div>
                                        <div class="row">
                                            <strong>Observation:</strong>
                                            <h5> {{ $sinistres_dim->observation }}</h5>
                                        </div>

                                        <br>
                                        <div class="col-12">
                                            <div class="student-submit">
                                                <a href="{{ url('/tous/sinistres-dim') }}" class="btn btn-primary">Retour aux  Sinistres AT&RD</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection




