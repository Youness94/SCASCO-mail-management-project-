@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Sinistres AT&RD</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Sinistres AT&RD</li>
                    </ul>
                </div>
            </div>
        </div>
        @if (Session::get('role_name') === 'Super Admin')
        <form method="GET" action="/filter/sinistres_at_rd">
            <div class=" row group-form d-flex justify-content-end ">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="form-group">
                            <input class="form-control" type="date" name="date_debut" id="date_debut">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="form-group">
                            <input class="form-control" type="date" name="date_fin" id="date_fin">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <button class="btn btn-outline-primary type=" submit">Filtre</button>
                        <a href="/reset/sinistre_at_rd" class="btn btn-outline-warning">Réinitialiser</a>
                    </div>

                </div>
            </div>
        </form>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Sinistres AT&RD</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    @if(isset($date_debut) && isset($date_fin) && $dataExists)
                                    <a href="{{ route('export.filtered.sinistres.at.rd', ['date_debut' => $date_debut, 'date_fin' => $date_fin]) }}" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Télécharger</a> @endif

                                    <a href="{{ route('add.sinistre.at.rd') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table border-0  table-center mb-0 datatable table-striped">
                                <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>Date de Réception</th>
                                        <th>Nom de police</th>
                                        <th>Numero Sinistre</th>
                                        <th>Nom Assuré</th>
                                        <th>Nom de Victime</th>
                                        <th>Branche</th>
                                        <th>Compagnie</th>
                                        <th>Acte de gestion</th>
                                        <th>Chargé de compte</th>
                                        <th>Date de remise</th>
                                        <th>Date de traitement</th>
                                        <th>Délai de traitement</th>
                                        <th>Afficher</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sinistres as $key => $item)
                                    <tr>

                                        <td>{{$key+1}}</td>
                                        <td>{{$item->date_reception}}</td>
                                        <td>{{$item->nom_police}}</td>
                                        <td>{{$item->num_sinistre}}</td>
                                        <td>{{$item->nom_assure}}</td>
                                        <td>{{$item->nom_victime}}</td>
                                        <td>{{ $item->branches_sinistres ? $item->branches_sinistres->nom : 'N/A' }}</td>
                                        <td>{{ $item->compagnies ? $item->compagnies->nom : 'N/A' }}</td>
                                        <td>{{ $item->acte_de_gestion_sinistres ? $item->acte_de_gestion_sinistres->nom : 'N/A' }}</td>
                                        <td>{{ $item->charge_compte_sinistres ? $item->charge_compte_sinistres -> nom : 'N/A' }}</td>
                                        <td>{{$item->date_remise}}</td>
                                        <td>{{$item->date_traitement}}</td>
                                        <td>{{$item->delai_traitement}}</td>
                                        <td>
                                            <a href="{{route('show.sinistre.at.rd',$item->id)}}" class=" btn btn-inverse-danger"><i class="feather-eye"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{route('edit.sinistre.at.rd',$item->id)}}" class="btn btn-inverse-warning"><i class="feather-edit"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{route('delete.sinistre.at.rd',$item->id)}}" class=" btn btn-inverse-danger"><i class="feather-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@section('script')

@endsection

@endsection