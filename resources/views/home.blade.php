@extends('layouts.app')

@section('content')
<div class="container">

    @if($isAdmin)
        <!-- Composant ADMIN -->
        <x-dashboards.admin-dashboard :stats="$stats" />
    @else
        <!-- Composant USER -->
        <x-dashboards.user-dashboard :stats="$stats" />
    @endif

    <!-- Section jeu (visible pour tous) -->
    @if($game)
        <div class="game-section mt-5">
            <h2>Ma partie en cours</h2>
            <!-- Ton code du jeu -->
        </div>
    @endif

</div>
@endsection