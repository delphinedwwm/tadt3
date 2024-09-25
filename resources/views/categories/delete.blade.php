@extends('layouts.app')

@section('content')
<div class="container mt-4"> 
    <h1>Suprimer</h1>
        <h2>Êtes-vous sûr de vouloir supprimer la catégorie suivante : {{ $category->name }}?</h2>

        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>

        <!-- lien pour annuler -->
        <a href="{{ route('categories.index') }}">Annuler</a>
</div>
@endsection