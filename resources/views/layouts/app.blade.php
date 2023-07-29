<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MarcadorWeb</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/modApp.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link id="modo" href="{{ asset('css/estilosPropios.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                MarcadoresWeb
                </a>
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('marcador.listado') }}">Ultimos Marcadores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('marcador.buscar') }}">Buscar</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->nick }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('categoria.add') }}">
                                        Categorias <img width="35" height="35" src="https://img.icons8.com/stencil/35/categorize.png"/>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('marcador.add') }}">
                                        Marcadores <img width="35" height="35" src="https://img.icons8.com/stickers/35/marker.png"/>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('configuracion') }}">
                                        Configuración <img width="35" height="35" src="https://img.icons8.com/external-sbts2018-flat-sbts2018/35/external-me-basic-ui-elements-2.3-sbts2018-flat-sbts2018.png"/>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('marcador.guardado') }}">
                                        Guardado <img width="35" height="35" src="https://img.icons8.com/stickers/35/pin.png"/>
                                    </a>
                                    <a id="cambiarModo" class="dropdown-item">
                                        Modo: <img id="icono" width="35" height="35" src="https://img.icons8.com/external-flaticons-flat-flat-icons/35/external-sun-100-most-used-icons-flaticons-flat-flat-icons-2.png"/>
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }} <img width="35" height="35" src="https://img.icons8.com/clouds/35/exit.png" alt="exit"/>
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
            @yield('content')
        </main>
    </div>
</body>
</html>
