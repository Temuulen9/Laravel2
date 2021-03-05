@extends('layouts.dashboard')

@section('user_content')

        <div class = "container">
            <div class="col-md-14">
                <div class="card">
                    <div class="card-header">
                        Асуултууд
                    </div>
                    <div class="card-body">
                    <table class="table">
                    
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Ангилал</th>
                                                <th scope="col">Асуулт</th>
                                                <th scope="col">Зураг</th>
                                                <th scope="col">Хариулт 1</th>
                                                <th scope="col">Хариулт 2</th>
                                                <th scope="col">Хариулт 3</th>
                                                <th scope="col">Хариулт 4</th>
                                                <th scope="col">Хариулт 5</th>
                                                <th scope="col">Хариулт</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($questions as $question)
                                            
                                                    <tr>
                                                        <th scope="row">{{ $question->id }}</th>
                                                        <td>{{ $question->sub }}</td>
                                                        <td>{{ $question->question }}</td>
                                                        <td><img src="/storage/{{ $question->image }}" alt="" width="100" height="100"></td>
                                                        <td>{{ $question->option1 }}</td>
                                                        <td>{{ $question->option2 }}</td>
                                                        <td>{{ $question->option3 }}</td>
                                                        <td>{{ $question->option4 }}</td>
                                                        <td>{{ $question->option5 }}</td>
                                                        <td>{{ $question->answer }}</td>
                                                        <td>
                                                            @can('edit-users')
                                                                <a href="{{ route('admin.questions.edit', $question) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                                            @endcan
                                                            @can('delete-users')

                                                                <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" class="float-left">
                                                                    @csrf
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" class="btn btn-warning">Delete</button>
                                                                </form>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection

