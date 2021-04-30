@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/test.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="test_container">

    <div id="app" class = "timer">

    @if(Auth::user()->lesson_type == "Шинэ жолоочийн сургалт")
        <timer :minute = "19"></timer>
    @else
        <timer :minute = "9"></timer>
    @endif
        
    
    <form action = "{{ route('test.exam.check') }}">
    @foreach($questions as $key => $question)
    <div class="card-body">
        
                <div class="card" >
            
                    <div class="card-header">
                        {{ $loop->iteration }}.{{  $question->question }}
                     
                    </div>
                    <div class="pt-3 pb-3">
                        @if( strlen($question->image) > 0)
                            <img src="/storage/{{ $question->image }}" class = "test_image" alt="" width="80%" height="40%"></br>
                        @endif
                        </div>
                        <div class = "answers">
                        <input type="hidden" id="question" name="responses[{{ $key }}][ question_id ]" value="{{ $question->id }}" >
                        <input type="radio" id="option1" name="responses[{{ $key }}][ answer_id ]" value="{{ $question->option1 }}" required >
                        <label >{{ $question->option1 }}</label></br>
                        <input type="radio" id="option2" name="responses[{{ $key }}][ answer_id ]" value="{{ $question->option2 }}">
                        <label >{{ $question->option2 }}</label></br>
                        @if( strlen($question->option3) > 0)
                            <input type="radio" id="option3" name="responses[{{ $key }}][ answer_id ]" value="{{ $question->option3 }}">
                            <label >{{ $question->option3 }}</label></br>
                        @endif
                        @if( strlen($question->option4) > 0)
                            <input type="radio" id="option4" name="responses[{{ $key }}][ answer_id ]" value="{{ $question->option4 }}">
                            <label >{{ $question->option4 }}</label></br>
                        @endif
                        @if( strlen($question->option5) > 0)
                            <input type="radio" id="option5" name="responses[{{ $key }}][ answer_id ]" value="{{ $question->option5 }}">
                            <label >{{ $question->option5 }}</label></br>
                        @endif
                        </div>
                     
                
        </div>
    </div>
    @endforeach
    <input type="hidden" name="date_start" value= "{{ $mytime1 = Carbon\Carbon::now() }}">
    <button type="submit" class="btn btn-outline-success">Шалгах</button>
    </form>
    </div>
</div>

@endsection()

