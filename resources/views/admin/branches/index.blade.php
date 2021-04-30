@extends('layouts.dashboard')

@section('user_content')

<div class = "container">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Салбарууд
                    </div>
                    <div class="card-body">
                    <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Нэр</th>
                                                <th scope="col">Зураг</th>
                                                <th scope="col">Холбогдох утасны дугаар</th>
                                                <th scope="col">Байрлал</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($branches as $branch)
                                            
                                                    <tr>
                                                        <th scope="row"> {{ $branch->id }}</th>
                                                        <td>{{ $branch->name }}</td>
                                                        <td><img src="/storage/{{ $branch->image }}" alt="" width="100" height="100"></td>
                                                        <td>{{ $branch->phone_number }}</td>
                                                        <td>{{ $branch->location }}</td>
                                                        <td style = "display: flex; align-items: center">
                                                        @can('owner')
                                                        <a href="{{ route('admin.branches.edit', $branch) }}">
                                                        <span class="material-icons">edit</span>
                                                        </a>
                                                        @endcan 
                                                  
                                                        @can('owner')
                                                    
                                                        <form action="{{ route('admin.branches.destroy', $branch) }}" method="POST" class="float-left" onsubmit = "return confirm('Салбарыг устгах уу?')">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn">
                                                            <span class="material-icons">
                                                            delete
                                                            </span>
                                                            </button>
                                                            
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