@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

@endsection
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    <div>
                    {{$user->name}} - хэрэглэгчийн мэдээлэл
                    </div>
                    <div>
                        <a href="{{route('profile.changePassword', Auth::user())}} ">
                        <button type="submit" class="btn btn-secondary">
                                Нууц үг солих
                            </button>
                        </a>
                        </div>
                    </div>

                    <div class="card-body">
                    <div>
                        <form action="{{ route('profile.update', $user) }}"  method = "POST">
 
                        @csrf
                            {{ method_field('PUT') }}
                        <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">ID</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->id}}" readonly required autofocus>

                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Овог</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname }}" autocomplete="off" required >

                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Нэр</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name}}" autocomplete="off" required >

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="register" class="col-md-3 col-form-label text-md-right">Регистрийн дугаар</label>

                                <div class="col-md-6">
                                    <input id="register" type="text" class="form-control @error('register') is-invalid @enderror" name="register" value="{{ $user->register}}" readonly required autofocus>

                                    @error('register')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lesson_type" class="col-md-3 col-form-label text-md-right">Сургалтын төрөл</label>

                                <div class="col-md-6">
                                    <input id="lesson_type" type="text" class="form-control @error('name') is-invalid @enderror" name="lesson_type" value="{{ $user->lesson_type}}" readonly required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">Цахим хаяг</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="off" >

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            

                            <button type="submit" class="btn btn-outline-success">
                                Шинэчлэх
                            </button>

                        </form>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection