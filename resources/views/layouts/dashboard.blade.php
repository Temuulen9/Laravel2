<?php
    use App\Models\Branch;
    $branches = Branch::all();
?>
@extends('layouts.app')
@section('styles')
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
    
@endsection

@section('content')
    <div class="main_container">
        @section('more')
            <div class="more">
            <span class="material-icons" onclick="openNav()">
            toc
            </span>
            </div>
        @endsection
        <div class="sidebar" id = "main_sidebar">
                <div class="wrapper">
                    <nav id="sidebar">
                        <div class="sidebar-header">
                            Хяналтын самбар
                        </div>
                        <ul class="lisst-unstyled components">
                            <li>
                                <a href="{{route('admin.users.index')}}">Хэрэглэгчид</a>
                            </li>
                             
                            <li>
                                <a href="{{route('admin.users.create' )}}">Хэрэглэгч нэмэх</a>
                            </li>
                            @can('owner')
                            <li>    
                                <a href="{{route('admins')}}">Админ</a>
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
                        </ul>
                    </nav>
                </div>
        </div>
        <div class="show_content" id = "show_content">
            @yield('user_content')
        </div>
    </div>

@endsection
