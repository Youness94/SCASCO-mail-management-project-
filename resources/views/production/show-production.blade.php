@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Production</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('all.productions')}}">Retour aux Productions</a></li>
                        <li class="breadcrumb-item active">Productions</li>
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
                            <div style="font-size: 3vw;" class="text-warning">Nom de police:</div>
                            <h1 class="form-title" style="font-size: 2vw; display: inline-block;">{{ $production->nom_police }}</h1>
                        </div>
                        <div class="col ms-md-n2 ">
                            <div style="font-size: 1vw;" class="text-warning">Nom de police:</div>
                            <h1 class="form-title" style="font-size: 1vw; display: inline-block;">{{ optional($production->user)->name }}</h1>
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
                                            <div style="font-size: 2vw;" class="text-warning">Date de Reception:</div>
                                            <h5>{{ $production->date_reception }}</h5>
                                        </div>
                                        <div class="row">
                                            <div style="font-size: 2vw;" class="text-warning">Branche:</div>
                                            <h5>{{ optional($production->branches)->nom }}</h5>
                                        </div>
                                        <div class="row">
                                            <div style="font-size: 2vw;" class="text-warning">Compagnie:</div>
                                            <h5>{{ optional($production->compagnies)->nom }}</h5>
                                        </div>
                                        <div class="row">
                                            <div style="font-size: 2vw;" class="text-warning">Acte de gestion:</div>
                                            <h5>{{ optional($production->act_gestions)->nom }}</h5>
                                        </div>
                                        <div class="row">
                                            <div style="font-size: 2vw;" class="text-warning">Chargé de comptes:</div>
                                            <h5>{{ optional($production->charge_comptes)->nom }}</h5>
                                        </div>
                                        <div class="row">
                                            <div style="font-size: 2vw;" class="text-warning">Date de remise:</div>
                                            <h5> {{ $production->date_remise }}</h5>
                                        </div>
                                        <div class="row">
                                            <div style="font-size: 2vw;" class="text-warning">Date de traitement:</div>
                                            <h5> {{ $production->date_traitement }}</h5>
                                        </div>
                                        <div class="row">
                                            <div style="font-size: 2vw;" class="text-warning">Délai de traitement:</div>
                                            <h5>{{ $production->delai_traitement }} /Jours</h5>
                                        </div>
                                        <div class="row">
                                            <div style="font-size: 2vw;" class="text-warning">Observation:</div>
                                            <h5> {{ $production->observation }}</h5>
                                        </div>

                                        <br>
                                        <div class="col-12">
                                            <div class="student-submit">
                                                <a href="{{ url('/tous/productions') }}" class="btn btn-primary">Retour aux Productions</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endsection