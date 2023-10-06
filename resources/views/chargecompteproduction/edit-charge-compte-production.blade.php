
@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Modifier Chargé de compte</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('all.charge.compte.sinistres.dim')}}">Chargés de compte</a></li>
                            <li class="breadcrumb-item active">Modifier chargés de compte</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                        <form method="POST" action="{{route('update.charge_compte')}}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id"  value="{{$charge_comptes->id}}">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Détails du chargés de compte</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nom<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="nom" value="{{$charge_comptes->nom}}">
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
