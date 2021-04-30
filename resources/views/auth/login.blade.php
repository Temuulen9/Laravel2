@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Нэвтрэх') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="register" class="col-md-4 col-form-label text-md-right">{{ __('Регистрийн дугаар') }}</label>

                            <div class="col-md-6">
                                <input id="register" type="register" class="form-control @error('register') is-invalid @enderror" name="register" value="{{ old('register') }}" required autocomplete="register" autofocus>

                                @error('register')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Нууц үг') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-outline-success">
                                    {{ __('Нэвтрэх') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" style = "color:black" href="{{ route('password.request') }}">
                                        {{ __('Нууц үгээ мартсан уу?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
