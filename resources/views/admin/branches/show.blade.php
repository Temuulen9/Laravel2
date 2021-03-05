@extends('layouts.dashboard')

@section('user_content')
<div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">{{ $branch->name }} хэрэглэгчид </div>

                                    <div class="card-body">
                                        <table class="table" style="overflow-x:auto;">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Овог</th>
                                                <th scope="col">Нэр</th>
                                                <th scope="col">Регистер</th>
                                                <th scope="col">Сургалтын төрөл</th>
                                                <th scope="col">Цахим хаяг</th>
                                                <th scope="col">Бүртгүүлсэн огноо</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                            @if($user->hasAnyRoles(['user', 'payed_user']))
                                                    <tr>
                                                        <th>1</th>
                                                        <th scope="row">{{ $user->id }}</th>
                                                        <td>{{ $user->lastname }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->register }}</td>
                                                        <td>{{ $user->lesson_type }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ date("d M Y", strtotime($user->created_at)) }}</td>

                                                        <td>
                                                            @can('edit-users')
                                                                <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                                            @endcan
                                                            @can('delete-users')

                                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                                                    @csrf
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" class="btn btn-warning">Delete</button>
                                                                </form>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>                
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

