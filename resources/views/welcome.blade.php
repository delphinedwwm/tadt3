<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trivi-All Dev Trek</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/welcomeStyles.css'])
</head>
<body>
    <!-- En-tête de la page -->
    <header>
        @if (Route::has('login'))
        <nav>
            @auth
            <a href="{{ url('/home') }}">Dashboard</a>
            @else
            <a href="{{ route('login') }}">Login</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </nav>
        @endif
    </header>

    <div class="centered-content">
        <h1>Trivi-All Dev Trek</h1>
        <h2> A Trek I-Tech, <br> Apprendre le code sans prise de tête !</h2>
        <!-- Conteneur des logos -->
        <div class="logos-container">
            <img src="logos/html_32.png" alt="HTML Logo" class="logo">
            <img src="logos/css_32.png" alt="CSS Logo" class="logo">
            <img src="logos/js_32.png" alt="JS Logo" class="logo">
            <img src="logos/php_32.png" alt="PHP Logo" class="logo">
            <img src="logos/sql_32.png" alt="SQL Logo" class="logo">
            <img src="logos/laravel_32.png" alt="SQL Logo" class="logo">
        </div>
    </div>

    <!-- Appel à l'action -->
    <main class="cta">
        <h3>Bienvenue dans l'Aventure du Dev !</h3>
        <p>Alors ça y est, tu es prêt à t'éclater, à jongler avec le code !</p>
        <p>Pour bien commencer, il faut être bien installé :</p>
        <ul>
            <li>Prépare ta boisson préférée,</li>
            <li>Mets la musique que tu aimes bien,</li>
            <li>Installe-toi confortablement dans ton fauteuil.</li>
        </ul>
        <p>Voilà, tu es prêt, tu peux y aller. Commence ton aventure. <br> Tu verras, c'est cool d'apprendre autrement !</p>
        <a href="{{ route('games.test') }}" class="button">Tester</a>
    </main>

    <!-- Pied de page -->
    <footer>
        &copy; 2024 Trivi-All Dev Trek. Tous droits réservés.
    </footer>
</body>
</html>
