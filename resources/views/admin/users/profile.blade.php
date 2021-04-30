@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">


@endsection

@section('content')
        <div class="profile">
            <div class="card mb-3">
            <div class="card-header"> 
            <div>
            Хэрэглэгчийн мэдээлэл
            </div>  
            <div class = "edit">
            <a href="{{ route('profile.edit', Auth::user()) }}">
            <span class="material-icons">
                edit
                </span>
                                                </a>
            </div>
            </div>
                <div class="card-body">

                <div class="row">
                <div class="col-sm-4">
                      <h6 class="mb-0">ID</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                    {{ $user->id  }}
                    </div>
                    
                </div>
                <hr>

                <div class="row">
                <div class="col-sm-4">
                      <h6 class="mb-0">Овог</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                    {{ $user->lastname  }}
                    </div>
                    
                </div>
               
                <hr>
                <div class="row">
                <div class="col-sm-4">
                      <h6 class="mb-0">Нэр</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                    {{ $user->name  }}
                    </div>
                    
                </div>

                <hr>

                <div class="row">
                <div class="col-sm-4">
                      <h6 class="mb-0">Регистрийн дугаар</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                    {{ $user->register  }}
                    </div>
                    
                </div>
                
                <hr>

                <div class="row">
                <div class="col-sm-4">
                      <h6 class="mb-0">Цахим хаяг</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                    {{ $user->email  }}
                    </div>
                    
                </div>
                <hr>

                <div class="row">
                <div class="col-sm-4">
                      <h6 class="mb-0">Сургалтын төрөл</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                    {{ $user->lesson_type  }}
                    </div>
                    
                </div>
                <hr>

                <div class="row">
                <div class="col-sm-4">
                      <h6 class="mb-0">Салбар</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                    {{ $user->branch  }}
                    </div>
                    
                </div>
                <hr>

                <div class="row">
                <div class="col-sm-4">
                      <h6 class="mb-0">Бүртгүүлсэн хугацаа</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                    {{ date("Y M d", strtotime($user->created_at))  }}
                    </div>
                    
                </div>
                

                @if($user->role == 'payed_user')
                <hr>
                <div class="row">
                <div class="col-sm-4">
                      <h6 class="mb-0">Төлбөр төлсөн хугацаа</h6>
                    </div>
                    <div class="col-sm-8 text-secondary">
                    {{  date("Y M d", strtotime($user->verified_date)) }}
                    </div>
                    
                </div>
                @endif
                
                </div>
            </div>

                  @if($user->role == 'payed_user')

                <div class="card mb-3">
                <div class="card-header">Шалгалтын тестийн үр дүн</div>
                <div class="card-body">

                    <div class="row">
                    <div class="col-sm-4">
                        <h6 class="mb-0">Нийт гүйцэтгэсэн</h6>
                        </div>
                        <div class="col-sm-8 text-secondary">
                        {{ count($user->hasResults) }}
                        </div>
                        
                    </div>
                    <hr>
                    @if(count($user->hasResults) > 0)
                    <div class="row">
                    <div class="col-sm-4">
                        <h6 class="mb-0">Тэнцсэн</h6>
                        </div>
                        <div class="col-sm-8 text-secondary">
                        {{ $counter }}
                        </div>
                        
                    </div>
                    <hr>

                    <div class="row">
                    <div class="col-sm-4">
                        <h6 class="mb-0">Хамгийн сүүлд гүйцэтгэсэн хугацаа</h6>
                        </div>
                        <div class="col-sm-8 text-secondary">
                        {{ $user->hasResults[count($user->hasResults) - 1]->start_time }}
                        </div>
                        
                    </div>
                    @endif
                </div>
                </div>
                @endif
                                    
                  

                  
                       
        </div>
     
@endsection
