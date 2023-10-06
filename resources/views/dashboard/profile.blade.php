@extends('layouts.master')
@section('content')
            @php        
              $id = Auth::user()->id;
              $users = App\Models\User::find($id);
            @endphp
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('accueil') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>
           
        <div class="row">
            <div class="col-md-12">
                <div class="profile-header">
                    <div class="row align-items-center">
                        <div class="col-auto profile-image">
                            <a href="#">
                            <img class="rounded-circle" src="{{ (!empty($users->photo)) ? asset('upload/admin_images/'.$users->photo) : asset('/images/photo_defaults.jpg') }}" alt="profile" width="31">

                            </a>
                        </div>
                        <div class="col ms-md-n2 profile-user-info">
                            <h1 class="user-name mb-0">{{ Session::get('name') }}</h1><br>
                            <h6 class="text-muted">{{ Session::get('position') }}</h6>
                            <div class="user-Location">{{ Session::get('role_name') }}</div>
                        </div>
                        
                    </div>
                </div>
                <div class="profile-menu">
                    <ul class="nav nav-tabs nav-tabs-solid">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content profile-tab-cont">

                    <div class="tab-pane fade show active" id="per_details_tab">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Données Personnelles</span>
                                            </h5>
                                            <div class="row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $users->name }}" required autocomplete="name" autofocus>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse Électronique') }}</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $users->email }}" required autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Poste') }}</label>
                                                <input id="position" type="text" class="form-control @error('position') is-invalid @enderror" name="position" value="{{  $users->position }}" required>

                                                @error('position')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Numéro de Téléphone') }}</label>
                                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $users->phone_number }}" required>

                                                @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Département') }}</label>
                                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ $users->department }}" required>

                                                @error('department')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>
                                                <input id="image" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">

                                                @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div><br>
                                            <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label" for="formFile"></label>
                                                <img id='showImage' class="rounded-circle" src="{{ (!empty($users->photo)) ? url('upload/admin_images/'.$users->photo) : url('images/photo_defaults.jpg')}}" alt="profile" width="120">
                                            </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Mettre à Jour le Profil') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </div>

                            </form>

                            <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#image').change(function(e) {
                                        var reader = new FileReader();
                                        reader.onload = function(e) {
                                            $("#showImage").attr('src', e.target.result);
                                        }
                                        reader.readAsDataURL(e.target.files[0]);
                                    })
                                })
                            </script>
                            <div class="col-lg-3">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title d-flex justify-content-between">
                                            <span>Account Status</span>
                                            <!-- <a class="edit-link" href="#"><i class="far fa-edit me-1"></i>Edit</a> -->
                                        </h5>
                                        <button class="btn btn-success" type="button"><i class="fe fe-check-verified"></i> {{ Session::get('status') }}</button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div id="password_tab" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Change Password</h5>
                                <div class="row">
                                    <div class="col-md-10 col-lg-6">
                                        <form action="{{ route('change/password') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" value="{{ old('current_password') }}">
                                                @error('current_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="{{ old('new_password') }}">
                                                @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" value="{{ old('new_confirm_password') }}">
                                                @error('new_confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection