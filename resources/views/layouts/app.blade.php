<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <title>{{ config('app.name', 'Smart University System') }}</title> -->
    <title>Smart University System</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <link id="bs-css" href="https://netdna.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet"> -->






    
</head>
<body>
    <div style="background-image: url('img/background.jpg'); height: 3000px;" id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
               
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                   
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home </a>
                        </li>
                        @if (Auth::check() && Auth::user()->roleNo == 0)
                        <li class="nav-item">
                            <a class="nav-link" href="/guestbooking">Booking Details</a>
                        </li>
                        @endif
                        @if (Auth::check() && Auth::user()->roleNo == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">Admin</a>
                        </li>
                        @endif
                        @if (Auth::check() && Auth::user()->roleNo == 2)
                        <li class="nav-item">
                            <a class="nav-link" href="/vc">Booking Details</a>
                        </li>
                        @endif
                        @if (Auth::check() && Auth::user()->roleNo == 3)
                        <li class="nav-item">
                            <a class="nav-link" href="/agricoordinator">Coordinator</a>
                        </li>
                        @endif
                        @if (Auth::check() && Auth::user()->roleNo == 4)
                        <li class="nav-item">
                            <a class="nav-link" href="/avucoordinator">Coordinator</a>
                        </li>
                        @endif
                        @if (Auth::check() && Auth::user()->roleNo == 5)
                        <li class="nav-item">
                            <a class="nav-link" href="/hrcoordinator">Coordinator</a>
                        </li>
                        @endif
                        @if (Auth::check() && Auth::user()->roleNo == 6)
                        <li class="nav-item">
                            <a class="nav-link" href="/nestcoordinator">Coordinator</a>
                        </li>
                        @endif
                        @if (Auth::check() && Auth::user()->roleNo == 7)
                        <li class="nav-item">
                            <a class="nav-link" href="/hrreg">Booking Details</a>
                        </li>
                        @endif
                        @if (Auth::check() && Auth::user()->roleNo == 8)
                        <li class="nav-item">
                            <a class="nav-link" href="/nestreg">Booking Details</a>
                        </li>
                        @endif
                        @if (Auth::check() && Auth::user()->roleNo == 9)
                        <li class="nav-item">
                            <a class="nav-link" href="/viewcthrbooking">Care Taker</a>
                        </li>
                        @endif
                        @if (Auth::check() && Auth::user()->roleNo == 10)
                        <li class="nav-item">
                            <a class="nav-link" href="/view_reports">View Reports </a>
                        </li>
                        @endif
                        @if (Auth::check() && Auth::user()->roleNo >= 11)
                        <li class="nav-item">
                            <a class="nav-link" href="/dean_hod">Booking Details</a>
                        </li>
                        @endif
                        
                        <li class="nav-item">
                            <a class="nav-link" href="/af">Kabanas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/afd">Dining Room </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/nest">NEST</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/hr">Holiday Resort</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/avu">Audio Visual Unit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/contact">Contact Us</a>
                        </li>
                       
                        
                       
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

        <main class="py-4">
        <div class = "container">
        @if(Request::is('/'))
            @include('inc.showcase')
        @endif
    <div class = "row">
    <div class = "col-md-12 col-lg-12">
    
        
    @include('inc.messages')
             @yield('content')
    </div>
    <!-- <div class = "col-md-4 col-lg-4">
    
             @include('inc.sidebar')
    </div> -->
    </div>
    
    </div>
    </br>
    {{-- @include('inc.footer') --}}
        </main>
    </div>
</body>
</html>
