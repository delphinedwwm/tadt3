{{-- resources/views/games/stop.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Arrêter la Partie</h1>

        <form method="POST" action="{{ route('games.stop') }}">
            @csrf
            <div class="form-group">
                <button type="submit" class="btn btn-warning">Arrêter la Partie</button>
            </div>
        </form>
    </div>
@endsection
