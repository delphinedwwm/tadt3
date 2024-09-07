{{-- resources/views/games/start.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Démarrer une nouvelle partie</h1>

        <form method="POST" action="{{ route('games.start') }}">
            @csrf
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Démarrer la Partie</button>
            </div>
        </form>
    </div>
@endsection
