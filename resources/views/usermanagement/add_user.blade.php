@extends('layouts.master')

@section('content')
{{-- Include any Toastr messages --}}
{!! Toastr::message() !!}

<div class="page-wrapper">
      <div class="content container-fluid">
      <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Ajouter Utilisateur</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('all.users') }}">Liste des Utilisateurs</a></li>
                            <li class="breadcrumb-item active">Ajouter Utilisateur</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

            <div class="row">
                  <div class="col-sm-12">
                        <div class="card comman-shadow">
                              <div class="card-body">
                                    {{-- Add User Form --}}
                                    <form method="POST" action="{{ route('store.user') }}" class="forms-sample" enctype="multipart/form-data">
                                          @csrf

                                          {{-- Your form fields go here --}}
                                          <div class="form-group local-forms">
                                                <label>Name: <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" required>
                                          </div>

                                          <div class="form-group local-forms">
                                                <label>Email: <span class="login-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" required>
                                          </div>

                                          <div class="form-group local-forms">
                                                <label>Role Name <span class="login-danger">*</span></label>
                                                <select class="form-control select @error('role_name') is-invalid @enderror" name="role_name" id="role_name">
                                                      <option selected disabled>Role Type</option>
                                                      @foreach ($roles as $role)
                                                      <option value="{{ $role->role_type }}">{{ $role->role_type }}</option>
                                                      @endforeach
                                                </select>
                                                @error('role_name')
                                                <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                          </div>

                                          {{-- Add more fields as needed --}}

                                          <div class="form-group local-forms">
                                                <label>Password: <span class="login-danger">*</span></label>
                                                <input type="password" class="form-control" name="password" required>
                                          </div>

                                          <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Add User</button>
                                          </div>
                                    </form>
                                    {{-- End of Add User Form --}}
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</div>
@endsection