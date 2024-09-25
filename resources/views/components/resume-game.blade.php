@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reprendre la Partie</h1>

        @if ($game)
            <form method="POST" action="{{ route('games.resume') }}">
                @csrf
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Reprendre la Partie</button>
                </div>
            </form>
        @else
            <div class="alert alert-info">
                Aucune partie en attente de reprise.
            </div>
        @endif
    </div>
@endsection