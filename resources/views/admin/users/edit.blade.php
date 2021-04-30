@extends('layouts.dashboard')

@section('user_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$user->name}} - хэрэглэгчийн мэдээлэл шинэчлэх</div>

                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user) }}"  method = "POST">


                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Овог</label>

                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname}}" required autofocus>

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
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name}}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Регистрийн дугаар') }}</label>

                            <div class="col-md-6">
                                <input id="register" type="text" class="form-control @error('register') is-invalid @enderror" name="register" value="{{ $user->register }}"  required  autofocus>

                                @error('register')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">Цахим хаяг</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">Сургалтын төрөл</label>

                                <div class="col-md-6">
                            <select name="lesson_type" id="lesson_type" class="form-control" required>

                               
                                <option value="">-- Сургалтын төрлөө сонгоно уу! --</option>
                                @if($user->lesson_type == "Шинэ жолоочийн сургалт")
                                        <option value="{{ $user->lesson_type }}" selected>
                                        {{ $user->lesson_type }}
                                        </option>
                                        <option value="Ангилал ахиулах сургалт">
                                        Ангилал ахиулах сургалт
                                        </option>
                                    @else
                                        <option value="{{ $user->lesson_type }}" selected>
                                        {{ $user->lesson_type }}
                                        </option>
                                        <option value="Шинэ жолоочийн сургалт">
                                        Шинэ жолоочийн сургалт
                                        </option>
                                    @endif
                                

                            
                                @error('branch')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </select>
                            </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">Салбар</label>

                                <div class="col-md-6">
                            <select name="branch" id="branch" class="form-control" required>

                                @can('owner')
                                <option value="">-- Салбараа сонгоно уу! --</option>
                                @foreach($branches as $branch)
                                    @if($branch->name == $user->branch)
                                        <option value="{{ $branch->name }}" selected>
                                        {{ $branch->name }}
                                        </option>
                                    @else
                                        <option value="{{ $branch->name }}">
                                        {{ $branch->name }}
                                        </option>
                                    @endif
                                
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

                            

                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group row">
                                <label for="roles" class="col-md-3 col-form-label text-md-right">Roles</label>
                                <div class="col-md-6">
                            @foreach($roles as $role)
                                <div class="form-radio">
                                    @if($role->name == $user->role)
                                        <input type="radio" name="roles" value="{{ $role->name }}" checked>
                                        <label>{{ $role->name }}</label>
                                        
                                    @else
                                    <input type="radio" name="roles" value="{{ $role->name }}" >
                                        <label>{{ $role->name }}</label>
                                    @endif
                                    
                                </div>
                            @endforeach
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
@endsection
