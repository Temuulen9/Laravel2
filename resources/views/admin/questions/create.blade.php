@extends('layouts.dashboard')

@section('user_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Асуулт нэмэх</div>
                    <div class="card-body">
                        <form action="{{ route('admin.questions.store') }}"  method = "POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">

                                <label for="sub" class="col-md-4 col-form-label text-md-right">{{ __('Ангилал') }}</label>
                                <div class="col-md-6">
                                    <input id="sub" type="text" class="form-control @error('sub') is-invalid @enderror" name="sub" value="{{ old('sub') }}" required autocomplete="sub" autofocus>

                                    @error('sub')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Асуулт') }}</label>
                                <div class="col-md-6">
                                    <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}" required autocomplete="question" autofocus>

                                    @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row">

                                <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Зураг') }}</label>
                                <div class="col-md-6">
                                   

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" autofocus>
                                </div>
                                
                                
                            </div>


                            <div class="form-group row">

                                <label for="option1" class="col-md-4 col-form-label text-md-right">{{ __('Хариулт 1') }}</label>
                                <div class="col-md-6">
                                    <input id="option1" type="text" class="form-control @error('option1') is-invalid @enderror" name="option1" value="{{ old('option1') }}" required autocomplete="option1" autofocus>

                                    @error('option1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row">

                                <label for="option2" class="col-md-4 col-form-label text-md-right">{{ __('Хариулт 2') }}</label>
                                <div class="col-md-6">
                                    <input id="option2" type="text" class="form-control @error('option2') is-invalid @enderror" name="option2" value="{{ old('option2') }}" required autocomplete="option2" autofocus>

                                    @error('option2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row">

                                <label for="option3" class="col-md-4 col-form-label text-md-right">{{ __('Хариулт 3') }}</label>
                                <div class="col-md-6">
                                    <input id="option3" type="text" class="form-control @error('option3') is-invalid @enderror" name="option3" value="{{ old('option3') }}" required autocomplete="option3" autofocus>

                                    @error('option3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row">

                                <label for="option4" class="col-md-4 col-form-label text-md-right">{{ __('Хариулт 4') }}</label>
                                <div class="col-md-6">
                                    <input id="option4" type="text" class="form-control @error('option4') is-invalid @enderror" name="option4" value="{{ old('option4') }}" required autocomplete="option4" autofocus>

                                    @error('option4')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row">

                                <label for="option5" class="col-md-4 col-form-label text-md-right">{{ __('Хариулт 5') }}</label>
                                <div class="col-md-6">
                                    <input id="option5" type="text" class="form-control @error('option5') is-invalid @enderror" name="option5" value="{{ old('option5') }}" required autocomplete="option5" autofocus>

                                    @error('option5')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                            </div>


                            <div class="form-group row">

                                <label for="answer" class="col-md-4 col-form-label text-md-right">{{ __('Зөв хариулт') }}</label>
                                <div class="col-md-6">
                                    <input id="answer" type="text" class="form-control @error('answer') is-invalid @enderror" name="answer" value="{{ old('answer') }}" required autocomplete="answer" autofocus>

                                    @error('answer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Асуулт нэмэх
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
