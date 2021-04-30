@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/test.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="test_container">

<div id="app" class = "timer">

<form action = "{{ route('test.exam.result') }}">
    @foreach($questions as $key => $question)
    <div class="card-body">

                <div class="card">
            
                    <div class="card-header">
                        {{ $loop->iteration }}.{{  $question->question }}

                    </div>
                    <div class="pt-3 pb-3">
                        @if( strlen($question->image) > 0)
                            <img src="/storage/{{ $question->image }}" alt="" width="80%" height="40%"></br>
                        @endif
                        <div class = "results">
                           <span type="hidden" id="question" name="responses[{{ $key }}][ question_id ]" value="{{ $question->id }}" >

                        
                        @if ( $question->answer === $answers[ $loop->iteration - 1 ])
                            <p style="background-color:#90EE90">{{ $question->answer }}</p>
                        @else
                            <p style="background-color:#90EE90">{{ $question->answer }}</p>
                            <p style="background-color:#F08080">{{ $answers[$loop->iteration - 1] }}</p>
                        @endif
                        </div>
                    </div>
                </div>
       
    </div>
    
    @endforeach
    
    <input type="hidden" name="point" value= "{{ $point }}">
    <input type="hidden" name="id" value= "{{ Auth::user()->id }}">
    <input type="hidden" name="date_start" value= "{{ $date_start }}">
    <input type="hidden" name="date_end" value= "{{ $mytime1 = Carbon\Carbon::now() }}">
    <div class="point">
    <span>Оноо : {{ $point }} </span>
    </div>
    <button type="submit" class="btn btn-outline-dark">Дуусгах</button>
    <form>
    </div>
    </div>

@endsection()