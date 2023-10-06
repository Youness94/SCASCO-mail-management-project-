resources/views/usermanagement/update_profile.blade.php
<!-- @extends('layouts.app')

@section('content') -->
    <!-- <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Update Profile</h6>
                    <form method="POST" action="{{ route('update.profile') }}" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}">
                        <div class="form-group">
                            <label>Name <span class="login-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $users->name }}">
                            
                        </div>

                        <div class="form-group">
                            <label>Email <span class="login-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="formFile">Image upload</label>
                            <input class="form-control" name="photo" type="file" id="image">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="formFile"></label>
                            <img id="showImage" class="wd-80 rounded-circle" src="{{ (!empty($user->photo)) ? url('upload/admin_images/'.$user->photo) : url('upload/no_image.jpg') }}" alt="profile">
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Save Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <script type="text/javascript">
                            $(document).ready(function() {
                                $('#image').change(function(e) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $("#showImage").attr('src', e.target.result);
                                    }
                                    reader.readAsDataURL(e.target.files[0]);
                                })
                            })
                        </script> -->
<!-- @endsection -->
