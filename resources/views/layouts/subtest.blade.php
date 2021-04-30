@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/subtest.css') }}" rel="stylesheet">
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
                            Сэдвүүд
                        </div>
                        <ul class="subtest">
                          
                            <ul class = "substest">
                                @for($i = count($subs) - 1; $i >= 0; $i--)
                                    <li>
                                        <a href="{{ route('test.sub.show', $subs[$i]->sub) }}">{{ $subs[$i]->sub }}</a>
                                    </li>
                                @endfor
                            </ul>
                           
                            
                        </ul>
                    </nav>
                </div>
        </div>
        <div class="show_content" id = "show_content"> 
            @yield('test_content')
        </div>
    </div>
    

@endsection()

