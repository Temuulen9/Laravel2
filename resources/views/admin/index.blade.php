@extends('layouts.dashboard')

@section('user_content')
<div class="container">
            <div class="tables">
                <div>
                    @can('owner')
                        <div class="row justify-content-center " >
                            <div class="col-md-12" >
                                <div class="card">
                                    <div class="card-header">Админ</div>
                                    <div class="card-body" style="overflow-x:auto;">
                                        <table class="table">
                                       
                                    
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Овог</th>
                                                <th scope="col">Нэр</th>
                                                <th scope="col">Регистр</th>
                                                <th scope="col">Салбар</th>
                                                <th scope="col">Цахим хаяг</th>
                                                <th scope="col">Бүртгүүлсэн огноо</th>
                                                <th scope="col">Үйлдэл</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $number = 1; ?>
                                            @foreach($users as $user)
                                                    <tr>
                                                        <th scope="row">{{ $number }}</th>
                                                        <?php $number++; ?>
                                                        <td>{{ $user->lastname }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->register }}</td>
                                                        <td>{{ $user->branch }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ date("d M Y", strtotime($user->created_at)) }}</td>

                                                        <td style = "display: flex; align-items: center">
                                                
                                                <a href="{{ route('admin.users.edit', $user->id) }}">
                                                    <span class="material-icons">edit</span>
                                                </a>
                                                
                                                  
                                                    
                                                    
                                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left" onsubmit = "return confirm('Хэрэглэгчийг устгах уу?')">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn" >
                                                            <span class="material-icons">
                                                            delete
                                                            </span>
                                                            </button>
                                                            
                                                        </form>
                                                   
                                                    
                                                </td>
                                                    </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                    @endcan

                   
                        </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
