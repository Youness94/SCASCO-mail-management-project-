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
                        <h3 class="page-title">Modifier Sinistre DIM</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('all.sinistres.dim') }}">Sinistre DIM</a></li>
                            <li class="breadcrumb-item active">Modifier Sinistre DIM</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                    <form method="POST" action="{{ route('update.sinistre.dim', ['id' => $sinistres_dim->id]) }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $sinistres_dim->id }}">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title">Informations sur la Sinistre DIM
                                        <span>
                                            <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                        </span>
                                    </h5>
                                </div>

                                {{-- Input fields --}}
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Date de Réception:<span class="login-danger">*</span></label>
                                        <input class="form-control" name="date_reception" type="date" id="date_reception" value="{{ $sinistres_dim->date_reception }}" />
                                     
                                    </div>
                                </div>

                                <!-- ... Previous input fields ... -->

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>N° de déclaration: <span class="login-danger">*</span></label>
                                        <input name="num_declaration" type="text" id="num_declaration" value="{{ $sinistres_dim->num_declaration }}" class="form-control"  />
                                      
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nom Assuré: <span class="login-danger">*</span></label>
                                        <input name="nom_assure" type="text" id="nom_assure" class="form-control" value="{{ $sinistres_dim->nom_assure }}">
                                      
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nom Adhèrent: <span class="login-danger">*</span></label>
                                        <input name="nom_adherent" type="text" id="nom_adherent" value="{{ $sinistres_dim->nom_adherent }}" class="form-control" >
                                       
                                    </div>
                                </div>
                                
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="branche_dim_id">Branche: <span class="login-danger">*</span></label>
                                        <select class="form-control" name="branche_dim_id" id="branche_dim_id">
                                            <option selected disabled>Select a branche</option>
                                            @foreach ($branches_dim as $branch)
                                            <option value="{{ $branch->id }}" {{ $branch->id == $sinistres_dim->branche_dim_id ? 'selected' : '' }}>{{ $branch->nom }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="acte_gestion_dim_id">Acte de Gestion: <span class="login-danger">*</span></label>
                                        <select class="form-control" name="acte_gestion_dim_id" id="acte_gestion_dim_id">
                                            <option selected disabled>Sélectionnez un Acte de Gestion</option>
                                            @foreach ($acte_de_gestion_dim as $act_gestion)
                                            <option value="{{ $act_gestion->id }}" {{ $act_gestion->id == $sinistres_dim->acte_gestion_dim_id ? 'selected' : '' }}>{{ $act_gestion->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="charge_compte_dim_id">Chargé de Compte: <span class="login-danger">*</span></label>
                                        <select class="form-control" name="charge_compte_dim_id" id="charge_compte_dim_id">
                                            <option selected disabled>Sélectionnez un chargé de compte</option>
                                            @foreach ($charge_compte_dim as $charge_compte)
                                            <option value="{{ $charge_compte->id }}" {{ $charge_compte->id == $sinistres_dim->charge_compte_dim_id ? 'selected' : '' }}>{{ $charge_compte->nom }}</option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="compagnie_id">Companie: <span class="login-danger">*</span></label>
                                        <select class="form-control" name="compagnie_id" id="compagnie_id">
                                            <option selected disabled>Sélectionnez une compagnie</option>
                                            @foreach ($compagnies as $company)
                                            <option value="{{ $company->id }}" {{ $company->id == $sinistres_dim->compagnie_id ? 'selected' : '' }}>{{ $company->nom }}</option>
                                            @endforeach
                                        </select>
                                       
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Date de Remise: <span class="login-danger">*</span></label>
                                        <input class="form-control mb-4 mb-md-0" name="date_remise" type="date" id="date_remise" value="{{ $sinistres_dim->date_remise }}" />
                                        
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Date de Traitement: <span class="login-danger">*</span></label>
                                        <input class="form-control mb-4 mb-md-0" name="date_traitement" type="date" id="date_traitement" value="{{ $sinistres_dim->date_traitement }}" />
                                       
                                    </div>
                                </div>


                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Observation:</label>
                                        <textarea class="form-control" id="observation" name="observation" rows="5"  value="{{$sinistres_dim->observation}}">{{$sinistres_dim->observation}}</textarea>

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