<!DOCTYPE html>
{{--Piotr adjusted app.blade.php--}}
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title> {{ config('app.name') }} @yield('title')</title>
<body>
<style>
    a {
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
</style>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-bold"><a href="{{ route('home.index') }}">PMWay</a></h5>
    <nav class="my-2 my-md-0 mr-md-3 ms-auto">
        <a class="p-2 text-dark" href="{{ route('home.index') }}">Home</a>
        <a class="p-2 text-dark" href="{{ route('home.contact') }}">Contact</a>
        <a class="p-2 text-dark" href="{{ route('posts.index') }}">Blog Posts</a>

        @auth
        <a class="p-2 text-dark" href="{{ route('posts.create') }}">Add</a>

        @endauth
        @guest
        <a class="p-2 text-dark" href="{{ route('login') }}">Add</a>
        @endguest

        @guest
            @if (Route::has('register'))
                <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>
            @endif
            <a class="p-2 text-dark" href="{{ route('login') }}">Login</a>
        @else
            <a class="p-2 text-dark" href="{{ route('logout') }}"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            >Logout ({{ Auth::user()->name }})</a>

            <form id="logout-form" action={{ route('logout') }} method="POST"
                  style="display: none;">
                @csrf
            </form>
        @endguest
    </nav>
</div>
<div class="container">
    @if(session()->has('status'))
        <div class="alert alert-success">
            {{ session()->get('status') }}
        </div>
    @endif

    @yield('content')
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
