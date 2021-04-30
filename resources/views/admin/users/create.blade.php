
@extends('layouts.dashboard')

@section('user_content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Хэрэглэгч нэмэх</div>
                    <div class="card-body">
                    
                        <form action="{{ route('admin.users.store') }}"  method = "POST">
                            @csrf
                            <div class="form-group row">
                                <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Овог') }}</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Нэр') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Регистрийн дугаар') }}</label>

                                <div class="col-md-6">
                                    <input id="register" type="text" class="form-control @error('register') is-invalid @enderror" name="register" value="{{ old('register') }}"  required autocomplete="register"  autofocus>

                                    @error('register')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('И-Мэйл хаяг') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Сургалтын төрөл') }}</label>

                            <div class="col-md-6">
                     
                                <select name="lesson_type" id="lesson_type" class="form-control">
                                <option value="">-- Сургалтын төрлөө сонгоно уу! --</option>
                                
                                <option value="Шинэ жолоочийн сургалт">
                                    Шинэ жолоочийн сургалт
                                </option>
                                <option value="Ангилал ахиулах сургалт">
                                    Ангилал ахиулах сургалт
                                </option>
                                @error('lesson_type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Салбар') }}</label>

                            <div class="col-md-6">
                            <select name="branch" id="branch" class="form-control">

                                @can('owner')
                                <option value="">-- Салбараа сонгоно уу! --</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->name }}">
                                    {{ $branch->name }}
                                </option>
                                @endforeach
                                @endcan

                                @can('admin')
                                <option value="{{ Auth::user()->branch }}">{{ Auth::user()->branch }}</option>
                        
                                @endcan
                                @error('branch')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>
                            </div>
                        </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Нууц үг') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Нууц үг баталгаажуулалт') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-success">
                                        Хэрэглэгч нэмэх
                                    </button>
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
