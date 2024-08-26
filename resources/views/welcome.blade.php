<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Déclaration du type de document et de la langue du document -->
    <meta charset="utf-8"> <!-- Définit l'encodage des caractères en UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Assure que la mise en page est responsive -->
    <title>TriviAll Dev Trek</title> <!-- Titre de la page qui apparaît dans l'onglet du navigateur -->

    <!-- Préconnexion pour optimiser le chargement des polices -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- Chargement des polices depuis Bunny Fonts -->
    <link href="https://fonts.bunny.net/css?family=agency+fb:400,600&display=swap" rel="stylesheet" /> <!-- Police Agency FB -->
    <link href="https://fonts.bunny.net/css?family=aptos+mono:400,600&display=swap" rel="stylesheet" /> <!-- Police Aptos Mono -->
    <link href="https://fonts.bunny.net/css?family=poppins:400,600&display=swap" rel="stylesheet" /> <!-- Police Poppins -->

    <style>
        body {
            font-family: 'Aptos Mono', monospace;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #a1c4fd, #c2e9fb);
            color: #333;
            line-height: 1.4; /* Ajuste la hauteur de ligne pour plus de compacité */
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Hauteur minimale pour occuper toute la hauteur de la fenêtre */
        }

        header {
            background-color: #3b5998;
            color: #fff;
            padding: 10px 0; /* Réduit l'espacement */
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        nav a {
            color: #fff;
            margin: 0 10px; /* Réduit l'espacement entre les liens */
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #d1d8e0;
        }

        h1 {
            text-align: center;
            margin: 20px 0; /* Réduit la marge */
            font-size: 2em; /* Réduit la taille de la police */
            color: #2c3e50;
            font-family: 'Agency FB', cursive;
        }

        h1 p {
            font-size: 20px;
        }
        main {
            flex: 1; /* Permet à main de prendre l'espace disponible restant */
            width: 90%;
            max-width: 800px; /* Limite la largeur maximale */
            margin: 20px auto; /* Centre le contenu avec marges réduites */
            background-color: #fff;
            padding: 20px; /* Réduit l'espacement intérieur */
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        p {
            margin: 10px 0; /* Réduit l'espacement vertical */
            font-size: 1em; /* Réduit la taille de la police */
            color: #555;
        }

        a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s, text-shadow 0.3s;
            font-family: 'Poppins', sans-serif;
        }

        a:hover {
            color: #1d74f5;
            text-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            text-decoration: underline;
        }

        h2 {
            margin-top: 20px; /* Réduit la marge au-dessus des sous-titres */
            color: #2980b9;
            text-align: center;
            font-size: 1.5em; /* Réduit la taille de la police */
            padding-bottom: 5px; /* Réduit l'espacement intérieur */
            font-family: 'Agency FB', cursive;
        }
        h3 {
            font-size: 1 rem;
            font-family: 'Agency FB', cursive;
        }

        footer {
            background-color: #3b5998;
            color: #fff;
            text-align: center;
            padding: 10px 0; /* Réduit l'espacement intérieur */
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.2);
        }

        .button {
            display: inline-block;
            padding: 8px 16px; /* Réduit l'espacement intérieur */
            font-size: 1em; /* Réduit la taille de la police */
            font-weight: 600;
            color: #fff;
            background-color: #3498db;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            font-family: 'Poppins', sans-serif;
        }

        .button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .cta {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <!-- En-tête de la page -->
    <header>
        @if (Route::has('login'))
        <nav>
            @auth
            <!-- Lien vers le tableau de bord pour les utilisateurs authentifiés -->
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
            <!-- Lien vers la page de connexion pour les utilisateurs non authentifiés -->
            <a href="{{ route('login') }}">Log in</a>
            @if (Route::has('register'))
            <!-- Lien vers la page d'inscription pour les utilisateurs non authentifiés -->
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </nav>
        @endif
    </header>

    <!-- Titre principal de la page -->
     <h1>TriviAll Dev Trek
        <p> A Trek I-Tech, <br>Le code sans prise de tête !</p>
     </h1>
    <h2>Bienvenue dans l'Aventure du Dev !</h2>

    <!-- Contenu principal de la page -->
    <main class="cta">
        <p>Alors ça y est, tu es prêt à t'éclater, à jongler avec le code !</p>
        <p>Pour bien commencer, il faut être bien installé. Trois paramètres à prendre en compte :
            <br>-> Prépare ta boisson préférée,
            <br>-> Mets la musique que tu aimes bien,
            <br>-> Installe-toi confortablement dans ton fauteuil.
            <br>Voilà, tu es prêt, tu peux y aller !
        </p>
        <p>
             <!-- Lien vers la page d'inscription pour les utilisateurs non authentifiés -->
            <a href="{{ route('register') }}" class="button">Commence ton aventure</a>
        </p>
        <h3>Reprends là où tu en étais !</h3>
        <p>Ne t'arrête pas en si bon chemin !</p>
        <p>
            <!-- Bouton pour poursuivre l'objectif -->
            <a href="{{ route('login') }}" class="button">Poursuit ton objectif</a>
        </p>
        
    </main>

    <!-- Pied de page de la page -->
    <footer>
        &copy; 2024 TriviAll Dev Trek. Tous droits réservés.
    </footer>
</body>
</html>
