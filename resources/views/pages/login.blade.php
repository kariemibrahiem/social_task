@extends('web.layouts.app')

@section('title', 'Login')

@section('content')
<div class="login-area pt-80 pb-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-8">
                <div class="login-form-area text-center" style="background: #fff; padding: 40px; box-shadow: 0 0 20px rgba(0,0,0,0.1); border-radius: 10px;">
                    <div class="login-heading mb-30">
                        <h2 class="mb-20">Login</h2>
                        <p>Please login to your account.</p>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('front.login_check') }}" method="POST">
                        @csrf
                        <div class="input-box mb-20">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required value="{{ old('email') }}" style="height: 50px; border-radius: 5px;">
                        </div>
                        <div class="input-box mb-20">
                            <input type="password" name="password" class="form-control" placeholder="Password" required style="height: 50px; border-radius: 5px;">
                        </div>
                        <div class="login-footer mb-20">
                            <p>Don't have an account? <a href="{{ route('front.register') }}" class="text-primary">Register here</a></p>
                        </div>
                        <div class="submit-info">
                            <button class="btn btn-primary w-100" type="submit" style="height: 50px; border-radius: 5px; font-size: 16px; font-weight: 600;">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
