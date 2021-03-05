<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Номуунбаялаг</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            @guest
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <div><img src="/svg/logo.svg" alt="" style="height: 60px;" class="pr-3"></div>
                    <div class="pt-3">Номуунбаялаг</div>
                </a>
            @else
                <a class="navbar-brand d-flex" href="{{ url('/home') }}">
                    <div><img src="/svg/logo.svg" alt="" style="height: 60px;" class="pr-3"></div>
                    <div class="pt-3">Номуунбаялаг</div>
                </a>
            @endguest
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Нэвтрэх') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Бүртгүүлэх') }}</a>
                            </li>
                        @endif
                    @else
                        @can('is-payed')
                        <a href="/durem" class="nav-link">Дүрэм</a>
                        <a href="/test" class="nav-link">Дүрмийн тест</a>
                        @endcan()
                        @can('is-user')
                        <a href="#" class="nav-link">Дүрэм</a>
                        <a href="#" class="nav-link">Дүрмийн тест</a>
                        @endcan
                        <li class="nav-item dropdown">
                        

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @can('is-user')
                                    <a class="dropdown-item" href="{{route('profile.show', Auth::user())}}">
                                        Edit profile
                                    </a>
                                @endcan
                                @can('manage-users')
                                    <a class="dropdown-item" href="{{route('admin.users.index')}}">
                                        User Management
                                    </a>
                                @endcan
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="container">
            @include('partials.alerts')
        </div>

        @yield('content')
    </main>
</div>
</body>
</html>
