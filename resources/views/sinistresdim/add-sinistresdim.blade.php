@extends('layouts.master')

@section('content')
{{-- Toastr message --}}
{!! Toastr::message() !!}

<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Add this container where you want to display the Bootstrap alert -->
        <div id="yourAlertContainer">
            <!-- <strong>Success!</strong> Indicates a successful or positive action. -->
        </div>

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Ajouter Sinistre DIM</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('all.sinistres.at.rd') }}">Sinistre DIM</a></li>
                            <li class="breadcrumb-item active">Ajouter Sinistre DIM</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card comman-shadow">
                    <div class="card-body">
                        <form method="POST" action="{{route('store.sinistre.dim')}}" class="forms-sample" enctype="multipart/form-data">
                            @csrf

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
                                        <input class="form-control @error('date_reception') is-invalid @enderror" name="date_reception" type="date" id="date_reception" />
                                        @error('date_reception')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>N° de déclaration: <span class="login-danger">*</span></label>
                                        <input name="num_declaration" type="text" id="num_declaration" class="form-control @error('num_declaration') is-invalid @enderror" placeholder="Entrez le N° de déclaration" />
                                        @error('num_declaration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nom Assuré: <span class="login-danger">*</span></label>
                                        <input name="nom_assure" type="text" id="nom_assure" class="form-control @error('nom_assure') is-invalid @enderror" placeholder="Entrez le nom assuré" />
                                        @error('nom_assure')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Nom Adhèrent: <span class="login-danger">*</span></label>
                                        <input name="nom_adherent" type="text" id="nom_adherent" class="form-control @error('nom_adherent') is-invalid @enderror" placeholder="Entrez le nom adhèrent">
                                        @error('nom_adherent')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Branche: <span class="login-danger">*</span></label>
                                        <select class="form-control" name="branche_dim_id" id="branche_dim_id">
                                            <option selected disabled>Select a branche</option>
                                            @foreach ($branches_dim as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->nom }}</option>

                                            @endforeach
                                        </select>
                                        @error('branche_dim_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Acte de Gestion: <span class="login-danger">*</span></label>
                                        <select class="form-control" name="acte_gestion_dim_id" id="acte_gestion_dim_id">
                                            <option selected disabled>Sélectionnez un Acte de Gestion</option>
                                            @foreach ($acte_de_gestion_dim as $act_gestion)
                                            <option value="{{ $act_gestion->id }}">{{ $act_gestion->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('acte_gestion_dim_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Chargé de Compte: <span class="login-danger">*</span></label>
                                        <select class="form-control" name="charge_compte_dim_id" id="charge_compte_dim_id">
                                            <option selected disabled>Sélectionnez un chargé de compte</option>
                                            @foreach ($charge_compte_dim as $charge_compte)
                                            <option value="{{ $charge_compte->id }}">{{ $charge_compte->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('charge_compte_dim_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Companie: <span class="login-danger">*</span></label>
                                        <select class="form-control" name="compagnie_id" id="compagnie_id">
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
                                        <button type="submit" class="btn btn-primary me-2" id='submitBtn'>Submit</button>
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
<script>
    // Add this script to handle form submission
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('submitBtn').addEventListener('click', function() {
            // Assuming you have a variable named success that indicates successful form submission
            var success = true;

            if (success) {
                // If submission is successful, show a success message
                toastr.success('Formulaire ajouté avec succès!');

                // Display a Bootstrap alert as well
                var successAlert = '<div class="alert alert-success" role="alert">This is a success alert—check it out!</div>';
                document.getElementById('yourAlertContainer').innerHTML = successAlert;
            }
        });
    });
</script>


@endsection