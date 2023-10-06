
@extends('layouts.master')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Chargés de compte</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Tableau de Bord</a></li>
                        <li class="breadcrumb-item active">Chargés de compte</li>
                    </ul>
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
                                    <h3 class="page-title">Chargés de compte</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <!-- <a href="#" class="btn btn-outline-primary me-2"><i
                                            class="fas fa-download"></i> Télécharger</a> -->
                                    <a href="{{ route('add.charge_compte') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                   
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                    <th>Cree par</th>
                                </tr>
                            </thead>
                            @foreach ($charge_comptes as $key => $item)
                                <tr>
                                   
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$item -> nom}}
                                    </td>
                                    
                                    <td>
                                        <a href="{{route('edit.charge_compte',$item->id)}}" class="btn btn-inverse-warning"><i class="feather-edit"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('delete.charge_compte',$item->id)}}"  class="btn btn-inverse-danger"><i class="feather-trash"></i></a>
                                    </td>
                                    <td>{{$item -> user->name}}</td>
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


@section('script')
   
@endsection

@endsection
