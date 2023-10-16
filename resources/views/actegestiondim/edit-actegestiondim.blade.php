
@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Modifier acte de gestion</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('all.acte.gestion.sinistres.dim')}}">Actes de gestion</a></li>
                            <li class="breadcrumb-item active">Modifier Acte de gestion</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                        <form method="POST" action="{{route('update.acte.gestion.sinistre.dim')}}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id"  value="{{$acte_gestions_dim->id}}">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Détails du actye de gestion</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nom<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="nom" value="{{$acte_gestions_dim->nom}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Categorie <span class="login-danger">*</span></label>
                                        <select class="form-control select @error('categorie') is-invalid @enderror" name="categorie" id="categorie">
                                            <option selected disabled>Categorie Name</option>
                                            @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->categorie_name }}" {{ old('categorie', $acte_gestions_dim->categorie) == $categorie->categorie_name ? 'selected' : '' }}>
                                                {{ $categorie->categorie_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('categorie')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                    
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Soumettre</button>
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
