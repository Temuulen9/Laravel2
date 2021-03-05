<?php
    use App\Models\Branch;
    $branches = Branch::all();
?>
@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main_container">
        <div class="sidebar">
                <div class="wrapper">
                    <nav id="sidebar">
                        <div class="sidebar-header">
                            Dashboard
                        </div>
                        <ul class="lisst-unstyled components">
                            <li>
                                <a href="{{route('admin.users.index')}}">Хэрэглэгчид</a>
                            </li>
                             
                            <li>
                                <a href="{{route('admin.users.create' )}}">Хэрэглэгч нэмэх</a>
                            </li>
                            @can('delete-users')
                            <li>
                                <a href="#">Админ нэмэх</a>  <!-- admin nemeh heseg -->
                            </li>  
                            <li>
                                <a href="{{route('admin.branches.index' )}}">Салбарууд</a>
                                <!--
                                    niit salbaruud dropdown menu baidlaar garch irne
                                    tuhain salbar deer darahad tuhain salbariin hereglegchidiin medeelel garna
                                -->
                            </li>
                            <ul>
                                @foreach($branches as $branch)
                                    <li>
                                        <a href="{{ route('admin.branches.show', $branch) }}">{{ $branch->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <li>
                                <a href="{{route('admin.branches.create' )}}">Салбар нэмэх</a>
                                <!--
                                    niit salbaruud dropdown menu baidlaar garch irne
                                    tuhain salbar deer darahad tuhain salbariin hereglegchidiin medeelel garna
                                -->
                               
                            </li>
                            
                            @endcan
                           
                            <li>
                                <a href="{{ route('admin.questions.index') }}">Асуулт</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.questions.create') }}">Асуулт нэмэх</a>
                            </li>
                            <li>
                                <a href="">Ангилал</a>
                            </li>
                        </ul>
                    </nav>
                </div>
        </div>
        <div class="show_content">
            @yield('user_content')
        </div>
    </div>

@endsection
