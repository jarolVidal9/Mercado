<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mercado</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body> 
    @if(!in_array(Route::currentRouteName(), ['login', 'register']))
    <div class="py-2 text-center" style="background-color: #fff159">
        <h1 class="display-6 ">¡Bienvenido a nuestra tienda!</h1>
        <p class="lead ">Descubre nuestras increíbles ofertas.</p>
    </div>
    @endif
    <div id="app">  
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <strong>Mercado Libre</strong> 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesion') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @role('admin')
                                        <a class="dropdown-item" href="{{route('productsAdmin')}}">Productos</a>
                                        <a class="dropdown-item" href="{{route('users')}}" >Usuarios</a>
                                        <a class="dropdown-item" href="{{route('categories')}}" >Categorias</a>
                                    @endrole
                                    <a class="dropdown-item" href="{{route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @role('user')
                                <li class="nav-link"><a class="text-decoration-none text-black" href="{{ route('ShowCart') }}">Carrito</a></li>
                            @endrole
                        @endguest
                    </ul>
                </div>
               
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>
    @if(!in_array(Route::currentRouteName(), ['login', 'register']))
    <div class="bg-dark py-3 text-center mt-3">
        <p class="text-white m-0">Derechos de autor &copy; 2023 | Todos los derechos reservados</p>
    </div>
    @endif
</body>
</html>
