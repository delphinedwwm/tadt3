@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Supprimer</h1>
    <h2>Êtes-vous sûr de vouloir supprimer l'utilisateur suivant : {{ $user->name }}?</h2>

    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>

    <!-- lien pour annuler -->
    <a href="{{ route('users.index') }}">Annuler</a>
</div>
@endsection
