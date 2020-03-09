<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
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
                                <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrate</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
            <div class="col-md-6 mx-auto">
                @if (session('info'))
                <div class="container alert alert-info">
                    <div class="row">
                        <div class="col h1 text-info font-weight-bold">
                            <i class="fas fa-info-circle"></i> Información
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{ session('info') }}
                        </div>
                    </div>
                </div>
                @elseif(count($errors))
                <div class="container alert alert-danger">
                    <div class="row">
                        <div class="col h1 text-danger font-weight-bold">
                            {{-- <i class="fas fa-exclamation-triangle"></i> --}}
                            <i class="fas fa-times-circle"></i> Error
                        </div>
                    </div>
                    @foreach($errors->all() as $error)
                    <div class="row">
                        <div class="col">
                            {{$error}}
                        </div>
                    </div>
                    @endforeach
                </div>
                @elseif (session('warning'))
                <div class="container alert alert-warning">
                    <div class="row">
                        <div class="col-md h1 text-warning font-weight-bold">
                            <i class="fas fa-exclamation-triangle"></i> Precaución
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            {{ session('warning') }}
                        </div>
                    </div>
                </div>
                @elseif (session('success'))
                <div class="container alert alert-success">
                    <div class="row">
                        <div class="col-md h1 text-success font-weight-bold">
                            <i class="fas fa-check-circle"></i> Éxito
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @yield('content')
        </main>
    </div>
</body>
</html>
