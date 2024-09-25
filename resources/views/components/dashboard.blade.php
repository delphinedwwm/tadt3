@extends('layouts.app')

@section('content')
<div class="container my-4">
    <ul class="navbar-nav ms-auto d-flex flex-row gap-3">
        <!-- User Info -->
        <li class="nav-item d-flex align-items-center">
            <span class="nav-link text-secondary">
                <i class="bi bi-person-circle"></i> {{ Auth::user()->last_name }}
            </span>
        </li>
    </ul>
    <div>
        
    </div>
    <!-- Bloc de gestion des parties -->
    <div class="game-management-block mt-4">
        <h3 class="mb-3">Jouer</h3>
        <div class="d-flex justify-content-start gap-2">
            @if (!isset($game))
                <!-- Si aucune partie n'est associée à l'utilisateur, afficher un bouton pour démarrer une nouvelle partie -->
                <p>Aucun jeu associé à cet utilisateur.</p>
                <a href="{{ route('games.start') }}" class="btn btn-primary">Commencer une Partie</a>
            @elseif ($game->status == 'paused')
                <!-- Si une partie est en pause, afficher un bouton pour la reprendre -->
                <p>Le jeu est en pause.</p>
                <a href="{{ route('games.resume') }}" class="btn btn-success">Reprendre la Partie</a>
            @elseif ($game->status == 'in_progress')
                <!-- Si une partie est en cours, afficher un message que le jeu est actif -->
                <p>Le jeu est actif.</p>
            @else
                <!-- Si la partie est terminée ou dans un autre état, afficher un message approprié -->
                <p>Le jeu est terminé.</p>
                <a href="{{ route('games.start') }}" class="btn btn-primary">Commencer une nouvelle Partie</a>
            @endif
        </div>
    </div>
</div>
@endsection
