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
                        <form method="POST" action="{{ route('store.production') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf

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
                                        <input class="form-control" name="date_reception" type="date" id="date_reception" />
                                        @error('date_reception')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- ... Previous input fields ... -->

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nom de Police: <span class="login-danger">*</span></label>
                                        <input name="nom_police" type="text" id="nom_police" class="form-control @error('nom_police') is-invalid @enderror" placeholder="Entrez le nom de la police">
                                        @error('nom_police')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nom Assuré: <span class="login-danger">*</span></label>
                                        <input name="nom_assure" type="text" id="nom_assure" class="form-control @error('nom_assure') is-invalid @enderror" placeholder="Entrez le nom d'assuré">
                                        @error('nom_assure')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Branche: <span class="login-danger">*</span></label>
                                        <select class="form-control select  @error('branche_id') is-invalid @enderror" name="branche_id" id="branche_id">
                                            <option selected disabled>Sélectionnez un branche</option>
                                            @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('branche_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Acte de Gestion: <span class="login-danger">*</span></label>
                                        <select class="form-control select  @error('act_gestion_id') is-invalid @enderror" name="act_gestion_id" id="act_gestion_id">
                                            <option selected disabled>Sélectionnez un acte de gestion</option>
                                            @foreach ($act_gestions as $act_gestion)
                                            <option value="{{ $act_gestion->id }}">{{ $act_gestion->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('act_gestion_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Chargé de Compte: <span class="login-danger">*</span></label>
                                        <select class="form-control select  @error('charge_compte_id') is-invalid @enderror" name="charge_compte_id" id="charge_compte_id">
                                            <option selected disabled>Sélectionnez un chargé de compte</option>
                                            @foreach ($charge_comptes as $charge_compte)
                                            <option value="{{ $charge_compte->id }}">{{ $charge_compte->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('charge_compte_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Companie: <span class="login-danger">*</span></label>
                                        <select class="form-control select  @error('compagnie_id') is-invalid @enderror" name="compagnie_id" id="compagnie_id">
                                            <option selected disabled>Sélectionnez une compagnie</option>
                                            @foreach ($compagnies as $company)
                                            <option value="{{ $company->id }}">{{ $company->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('compagnie_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Date de Remise: <span class="login-danger">*</span></label>
                                        <input class="form-control mb-4 mb-md-0" name="date_remise" type="date" id="date_remise" />
                                        @error('date_remise')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Date de Traitement: <span class="login-danger">*</span></label>
                                        <input class="form-control mb-4 mb-md-0" name="date_traitement" type="date" id="date_traitement" />
                                        @error('date_traitement')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12 col-sm-12">
                                    <div class="form-group local-forms">
                                        <label>Observation:</label>
                                        <textarea class="form-control" id="observation" name="observation" rows="5"></textarea>
                                        @error('observation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary me-2">Soumettre</button>
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