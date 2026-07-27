<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mettre la Partie en Pause</h1>

        @if ($game)
            <form method="POST" action="{{ route('games.pause') }}">
                @csrf
                <div class="form-group">
                    <button type="submit" class="btn btn-warning">Mettre en Pause</button>
                </div>
            </form>
        @else
            <div class="alert alert-info">
                Aucune partie en cours à mettre en pause.
            </div>
        @endif
    </div>
@endsection
