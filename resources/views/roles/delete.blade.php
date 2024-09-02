@extends('layouts.app')

@section('content')
    <h1>Êtes-vous sûr de vouloir supprimer le rôle suivant : {{ $role->name }}?</h1>

    <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>

    <!-- lien pour annuler -->
    <a href="{{ route('roles.index') }}">Annuler</a>
@endsection