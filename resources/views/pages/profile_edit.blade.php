@extends('web.layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="register-area pt-80 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-10">
                <div class="register-form-area" style="background: #fff; padding: 40px; box-shadow: 0 0 20px rgba(0,0,0,0.1); border-radius: 10px;">
                    <div class="register-heading mb-30 text-center">
                        <h2 class="mb-20">Edit Profile</h2>
                        <p>Update your account information below.</p>
                    </div>

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('front.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-20">
                            <label for="name"><strong>Name</strong></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required style="height: 50px; border-radius: 5px;">
                        </div>

                        <div class="form-group mb-20">
                            <label for="email"><strong>Email</strong></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required style="height: 50px; border-radius: 5px;">
                        </div>

                        <div class="form-group mb-20">
                            <label for="phone"><strong>Phone</strong></label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}" style="height: 50px; border-radius: 5px;">
                        </div>

                        <div class="form-group mb-20">
                            <label for="status"><strong>Status</strong></label>
                            <input type="text" name="status" id="status" class="form-control" value="{{ old('status', $user->status) }}" style="height: 50px; border-radius: 5px;">
                        </div>

                        <div class="form-group mb-20">
                            <label for="image"><strong>Profile Image</strong></label>
                            @if ($user->image)
                            <div class="mb-10">
                                <img src="{{ asset($user->image) }}" alt="Current Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
                            </div>
                            @endif
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>

                        <hr>

                        <div class="form-group mb-20">
                            <label for="password"><strong>New Password</strong> <small class="text-muted">(leave empty to keep current)</small></label>
                            <input type="password" name="password" id="password" class="form-control" style="height: 50px; border-radius: 5px;">
                        </div>

                        <div class="form-group mb-20">
                            <label for="password_confirmation"><strong>Confirm Password</strong></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" style="height: 50px; border-radius: 5px;">
                        </div>

                        <div class="submit-info mt-30">
                            <button class="btn btn-primary w-100" type="submit" style="height: 50px; border-radius: 5px; font-size: 16px; font-weight: 600;">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection