<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TriviAll Dev Trek</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'TriviAll Dev Trek') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <!-- Espace vide ou éléments de navigation supplémentaires -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                            @role('admin')
                                <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Manage User</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Manage Category</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('questionsanswers.index') }}">Manage Question Answer</a></li>
                            @endrole
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

        <!-- Main content -->
        <main class="py-4">
            @yield('content')
        </main>

        <!-- Game Controls Section -->
        <div class="container py-4 text-center">
            @auth
            <div class="btn-group" role="group" aria-label="Game Controls">
                <a href="#" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('start-game-form').submit();">Démarrer la Partie</a>
                <form id="start-game-form" action="{{ route('games.start') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('stop-game-form').submit();">Arrêter la Partie</a>
                <form id="stop-game-form" action="{{ route('games.stop') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <a href="#" class="btn btn-warning" onclick="event.preventDefault(); document.getElementById('resume-game-form').submit();">Reprendre la Partie</a>
                <form id="resume-game-form" action="{{ route('games.resume') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            @endauth
        </div>

    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
