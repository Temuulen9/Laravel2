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
                                                        <td>
                                                            @can('edit-users')
                                                                <a href="{{ route('admin.branches.edit', $branch) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                                            @endcan
                                                            @can('delete-users')

                                                                <form action="{{ route('admin.branches.destroy', $branch) }}" method="POST" class="float-left">
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