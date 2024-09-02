@extends('layouts.app')

@section('content')
    <h1>Êtes-vous sûr de vouloir supprimer l'utilisateur suivant : {{ $user->name }}?</h1>

    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>

    <!-- lien pour annuler -->
    <a href="{{ route('users.index') }}">Annuler</a>
@endsection
