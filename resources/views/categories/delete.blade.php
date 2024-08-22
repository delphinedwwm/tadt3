@extends('layouts.app')

@section('content')
    <h1>Êtes-vous sûr de vouloir supprimer la catégorie suivante : {{ $category->name }}?</h1>

    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>

    <!-- lien pour annuler -->
    <a href="{{ route('categories.index') }}">Annuler</a>
@endsection