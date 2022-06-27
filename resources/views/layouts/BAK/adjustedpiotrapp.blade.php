{{-- NB was originally there from the bootstrap --auth --}}
{{--<!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--    <!-- CSRF Token -->--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--    <!-- Scripts -->--}}
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

{{--    <!-- Fonts -->--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

{{--    <!-- Styles -->--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--</head>--}}
{{--Ends was originally there from the bootstrap --auth --}}
{{--NB added by Piotr--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Document</title>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">PMWay</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{ route('home') }}">Home</a>
        <a class="p-2 text-dark" href="{{ route('home.contact') }}">Contact</a>
        <a class="p-2 text-dark" href="{{ route('posts.index') }}">Blog Posts</a>
        <a class="p-2 text-dark" href="{{ route('posts.create') }}">Add</a>

        @guest
            @if (Route::has('register'))
                <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>
            @endif
            <a class="p-2 text-dark" href="{{ route('login') }}">Login</a>
        @else
            <a class="p-2 text-dark" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            >Logout</a>

            <form id="logout-form" action={{ route('logout') }} method="POST"
                  style="display: none;">
                @csrf
            </form>
        @endguest
    </nav>
</div>

{{--NB end of added by Piotr--}}
{{-- NB was originally there from the bootstrap --auth --}}

{{--    <div id="app">--}}
{{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav me-auto">--}}

{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav ms-auto">--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        @guest--}}
{{--                            @if (Route::has('login'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('home.index') }}">Home</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('home.contact') }}">Contact</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('posts.index') }}">Blog Posts</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a  class="nav-link" href="{{ route('posts.create') }}">Add</a>--}}
{{--                            </li>--}}

{{--Ends was originally there from the bootstrap --auth --}}
{{--NB added by Piotr--}}
{{--                            @guest--}}
{{--                                @if (Route::has('register'))--}}
{{--                                    <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>--}}
{{--                                @endif--}}
{{--                                <a class="p-2 text-dark" href="{{ route('login') }}">Login</a>--}}
{{--                            @else--}}
{{--                                <a class="p-2 text-dark" href="{{ route('logout') }}"--}}
{{--                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();"--}}
{{--                                >Logout</a>--}}

{{--                                <form id="logout-form" action={{ route('logout') }} method="POST"--}}
{{--                                      style="display: none;">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                            @endguest--}}
{{--NB end of added by Piotr--}}


{{-- NB was originally there from the bootstrap --auth --}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                    {{ Auth::user()->name }}--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}

{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endguest--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

{{--        <main class="py-4">--}}
{{--            @yield('content')--}}
{{--        </main>--}}
{{--    </div>--}}
{{--</body>--}}
{{--</html>--}}
{{--Ends was originally there from the bootstrap --auth --}}




<div class="container">
    @if(session()->has('status'))
        <p style="color: green">
            {{ session()->get('status') }}
        </p>
    @endif

    @yield('content')
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
