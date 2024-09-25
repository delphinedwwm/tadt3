<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Trivi-All Dev Trek</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/styles.css'])
</head>
<body>
    <div id="app">
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
                        <!-- ajout du logo -->
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
                            
                                <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">User</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('roles.index') }}">Role</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Category</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('questionsanswers.index') }}">Question Answer</a></li>
                            

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

    </div>

    <!-- Inclusion des scripts
    @stack('scripts') -->
    @push('scripts')
<script>
    // Détecter la fermeture ou le rafraîchissement du navigateur
    window.addEventListener('beforeunload', function (e) {
        // Envoi de la requête AJAX pour mettre la partie en pause
        navigator.sendBeacon('/game/pause');
    });

    // Gestion du bouton pause
    document.getElementById('pause-button').addEventListener('click', function() {
        fetch('/game/pause', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); // Optionnel : message de confirmation
        });
    });

    // Attache un événement 'submit' au formulaire d'id 'answerForm'
    document.getElementById('answerForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Empêche le comportement par défaut du formulaire (qui est de recharger la page)

        let form = this; // Récupère le formulaire actuel
        let formData = new FormData(form); // Crée un objet FormData pour capturer les données du formulaire
        let selectedAnswer = formData.get('answer'); // Récupère la réponse sélectionnée (l'ID de la réponse choisie)
        // Vérifie si une réponse a bien été sélectionnée
        if (!selectedAnswer) {
            alert('Veuillez sélectionner une réponse.'); // Si aucune réponse n'est sélectionnée, affiche une alerte
            return; // Arrête l'exécution du script
        }

        // Envoi des données du formulaire via AJAX (Fetch) // AJAX -> (Asynchronous JavaScript and XML) // Fetch  -> vous pouvez envoyer des données (comme celles d'un formulaire) vers un serveur et recevoir une réponse, tout en restant sur la même page web, ce qui permet de modifier dynamiquement une partie de la page sans la recharger entièrement.
        fetch(form.action, {
            method: 'POST', // Méthode d'envoi des données
            body: formData, // Les données du formulaire à envoyer
            headers: {
                'X-Requested-With': 'XMLHttpRequest', // Indique qu'il s'agit d'une requête AJAX
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value // Ajoute le token CSRF pour la protection des requêtes
            }
        })
        .then(response => response.json()) // Transforme la réponse en JSON
        .then(data => {
            // Réinitialise les classes CSS des options de réponse (supprime les anciennes couleurs)
            document.querySelectorAll('.answer-option').forEach(option => {
                option.classList.remove('correct', 'incorrect'); // Supprime les classes 'correct' et 'incorrect'
            });

            // Ajoute la classe "correct" à l'option correspondant à la bonne réponse
            document.getElementById('answer-' + data.correct_answer_id).classList.add('correct');

            // Si la réponse sélectionnée est incorrecte, ajoute la classe "incorrect"
            if (data.selected_answer_id != data.correct_answer_id) {
                document.getElementById('answer-' + data.selected_answer_id).classList.add('incorrect');
            }

            // Met à jour l'affichage des points dans l'élément d'id 'points'
            document.getElementById('points').innerText = 'Points: ' + data.points;
        })
        .catch(error => console.error('Erreur:', error)); // Gestion des erreurs éventuelles lors de l'envoi de la requête
    });
</script>
@endpush
</body>
</html>
