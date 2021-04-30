@extends('layouts.subtest')


@section('test_content')
<div class= "container">
<div class="subtest_container">
<div id="app" class = "timer">
<form action = "{{ route('test.sub.index') }}">
    @foreach($questions as $key => $question)
    <div class="card-body">
                <div class="card">
            
                    <div class="card-header">
                        {{ $loop->iteration }}.{{  $question->question }}

                    </div>
                    <div class="card-body">
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
    <div class="point">
    <span>Оноо : {{ $point }} </span>
    </div>
    <button type="submit" class="btn btn-outline-dark">Дуусгах</button>
    <form>
    </div>
    </div>
    </div>
@endsection()