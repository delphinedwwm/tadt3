<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Trivi-All Dev Trek</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/styles.css'])
</head>
<body>
    <div id="app">
        <!-- Navbar -->
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Trivi-All Dev Trek') }}
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
                            <!-- LIENS ADMIN SEULEMENT -->
                            @if(Auth::user()->hasRole('admin'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">User</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">Role</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Category</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('questionsanswers.index') }}">Question Answer</a></li>
                            @endif

                            <!-- TOUJOURS VISIBLE (Admin ET User) -->
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link" style="border:none; padding:0; margin:0; color:inherit; text-decoration:none; background:none; cursor:pointer;">
                                        {{ Auth::user()->name }} - {{ __('Logout') }}
                                    </button>
                                </form>
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
    </div>

    @push('scripts')
    <script>
        // Pause game on page unload
        window.addEventListener('beforeunload', function (e) {
            navigator.sendBeacon('/game/pause');
        });

        // Gestion du formulaire de réponse (si les éléments existent)
        document.addEventListener('DOMContentLoaded', function() {
            const answerForm = document.getElementById('answerForm');
            
            if (answerForm) {
                answerForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    let formData = new FormData(this);
                    let selectedAnswer = formData.get('answer');
                    
                    if (!selectedAnswer) {
                        alert('Veuillez sélectionner une réponse.');
                        return;
                    }

                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.querySelectorAll('.answer-option').forEach(option => {
                            option.classList.remove('correct', 'incorrect');
                        });

                        if (data.correct_answer_id) {
                            document.getElementById('answer-' + data.correct_answer_id).classList.add('correct');
                        }

                        if (data.selected_answer_id && data.selected_answer_id != data.correct_answer_id) {
                            document.getElementById('answer-' + data.selected_answer_id).classList.add('incorrect');
                        }

                        if (document.getElementById('points')) {
                            document.getElementById('points').innerText = 'Points: ' + data.points;
                        }
                    })
                    .catch(error => console.error('Erreur:', error));
                });
            }

            // Gestion du bouton pause (si existe)
            const pauseButton = document.getElementById('pause-button');
            if (pauseButton) {
                pauseButton.addEventListener('click', function() {
                    fetch('/game/pause', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                    });
                });
            }
        });
    </script>
    @endpush
</body>
</html>