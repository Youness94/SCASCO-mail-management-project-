@extends('layouts.master')

@section('content')
{{-- Toastr message --}}
{!! Toastr::message() !!}

<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Ajouter Production</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('all.productions') }}">Productions</a></li>
                            <li class="breadcrumb-item active">Ajouter Production</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <form method="POST" action="{{route('update.production',['id' => $production->id])}}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$production->id}}">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title">Informations sur la Production
                                        <span>
                                            <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                        </span>
                                    </h5>
                                </div>

                                {{-- Input fields --}}
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Date de Réception:<span class="login-danger">*</span></label>
                                        <input class="form-control" name="date_reception" type="date" id="date_reception" value="{{$production->date_reception}}" />

                                    </div>
                                </div>

                                <!-- ... Previous input fields ... -->

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nom de Police: <span class="login-danger">*</span></label>
                                        <input name="nom_police" type="text" id="nom_police" class="form-control" value="{{$production->nom_police}}">

                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nom Assuré: <span class="login-danger">*</span></label>
                                        <input name="nom_assure" type="text" id="nom_assure" class="form-control" value="{{$production->nom_assure}}">

                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="branche_id">Branche: <span class="login-danger">*</span></label>
                                        <select class="form-control" name="branche_id" id="branche_id">
                                            @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ $branch->id == $production->branche_id ? 'selected' : '' }}>
                                                {{ $branch->nom }}
                                            </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="act_gestion_id">Acte de Gestion: <span class="login-danger">*</span></label>
                                        <select class="form-control" name="act_gestion_id" id="act_gestion_id">
                                            @foreach ($act_gestions as $act_gestion)
                                            <option value="{{ $act_gestion->id }}" {{ $act_gestion->id == $production -> act_gestion_id ? 'selected' : '' }}>
                                                {{ $act_gestion->nom }}
                                            </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="charge_compte_id">Chargé de Compte: <span class="login-danger">*</span></label>
                                        <select class="form-control" name="charge_compte_id" id="charge_compte_id">
                                            @foreach ($charge_comptes as $charge_compte)
                                            <option value="{{ $charge_compte->id }}" {{ $charge_compte->id == $production -> charge_compte_id ? 'selected' : '' }}>
                                                {{ $charge_compte->nom }}
                                            </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="compagnie_id">Companie: <span class="login-danger">*</span></label>
                                        <select class="form-control" name="compagnie_id" id="compagnie_id">
                                            @foreach ($compagnies as $company)
                                            <option value="{{ $company->id }}" {{ $company->id == $production -> compagnie_id ? 'selected' : '' }}>
                                                {{ $company->nom  }}
                                            </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>

                              

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Date de Remise: <span class="login-danger">*</span></label>
                                        <input class="form-control mb-4 mb-md-0" name="date_remise" type="date" id="date_remise"  value="{{$production->date_remise}}"/>

                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Date de Traitement: <span class="login-danger">*</span></label>
                                        <input class="form-control mb-4 mb-md-0" name="date_traitement" type="date" id="date_traitement"  value="{{$production->date_traitement}}"/>

                                    </div>
                                </div>


                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Observation:</label>
                                        <textarea class="form-control" id="observation" name="observation" rows="5"  value="{{$production->observation}}">{{$production->observation}}</textarea>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection