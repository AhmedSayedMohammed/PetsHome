<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PetsHome') }}</title>

    <!-- Scripts -->
  

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}"> 
    <style>
    body
    {
        background-image: url("/storage/background/background.png");
        background-attachment: fixed;
    }
    nav
    {
        background-color: #ff9934;
    }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light  fixed-top">
            <div class="container">
            <a class="navbar-brand text-light" href="{{ url('/') }}">
                    {{ config('app.name', 'PetsHome') }}
                    <img src="{{asset('storage/logo/logo.png')}}" style="width:35px; height:35px;" alt="">
                </a>
                
                <a href="{{ url('/home') }}" class="navbar-brand text-light">   &#8739;<i class="fa fa-home" aria-hidden="true">Home</i></a>
                <a href=></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  <img src="{{Auth::user()->avatar}}"  class="rounded-circle"style="width:30px; height:30px;">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                <a href="{{route('profile.show')}}" class="dropdown-item">profile</a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
           
        </nav>

        <main class="py-4 mt-5" >
            @yield('content')
        </main>
    </div>
    </div>
    <script>var BASE_URL='{{URL::to('/')}}'</script>

    <script type="text/javascript" src="/js/app.js?v=2.4.1"></script>
</body>
</html>
