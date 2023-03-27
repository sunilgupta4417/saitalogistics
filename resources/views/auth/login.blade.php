@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <h3 class="account-title">Login</h3> -->
    <div class="account-box">
       <div class="account-wrapper">
          <div class="account-logo">
             <a href="{{ url('/') }}"><img src="{{ asset('admin/img/logo.png') }}" alt="SchoolAdmin"></a>
          </div>
          <form method="POST" action="{{ route('login') }}">
            @csrf
             <div class="form-group">
                <label>Username or Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
             </div>
             <div class="form-group">
                <label>Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
             </div>
             <div class="form-group text-center custom-mt-form-group">
                <button class="btn btn-primary btn-block account-btn" type="submit">Login</button>
             </div>
             <div class="text-center">
                <a href="{{ route('password.request') }}">Forgot your password?</a>
             </div>
          </form>
       </div>
    </div>
 </div>
@endsection
