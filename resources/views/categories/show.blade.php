@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="mb-3">
                <h2>Show Category</h2>
            </div>
            <div>
                <!-- Bouton pour retourner à la liste des catégories -->
                <a class="btn btn-primary" href="{{ route('categories.index') }}">Back</a>
            </div>
        </div>
    </div>

    <!-- Affichage des détails des catégories -->
    <div class="row mb-4">
        <!-- Affichage du logo de la catégorie -->
        <div class="col-md-12 mb-3">
            <div class="form-group">
                <strong>Logo :</strong>
                <img src="{{ asset($category->logo) }}" alt="{{ $category->name }}" class="img-fluid img-thumbnail" style="max-width: 150px;">
            </div>
        </div>
        <!-- Affichage du nom de la catégorie -->
        <div class="col-md-12 mb-3">
            <div class="form-group">
                <strong>Name :</strong>
                {{ $category->name }}
            </div>
        </div>
        <!-- Affichage du type des catégories -->
        <div class="col-md-12 mb-3">
            <div class="form-group">
                <strong>Type :</strong>
                {{ $category->type }}
            </div>
        </div>
    </div>

    <!-- Actions disponibles pour chaque catégorie -->
    <div>
        <form action="{{ route('categories.update',$category->id) }}" method="PUT">
        @csrf
        @method('PUT')
            <!-- Lien pour éditer la category, visible uniquement si l'utilisateur a la permission -->
            @can('category-edit')
            <a class="btn btn-primary btn-sm" href="{{ route('categories.edit',$category->id) }}"> Edit</a>
            @endcan

            @csrf
            @method('DELETE')
        <!-- Bouton pour supprimer la category et ses réponses, visible uniquement si l'utilisateur a la permission -->
        @can('category-delete')
                <a class="btn btn-danger btn-sm" href="{{ route('categories.delete', $category->id) }}">Delete</a>
        @endcan
        </form>
    </div>

    <!-- Pied de page avec un crédit -->
    <p class="text-center text-primary mt-4">
        <small>Delphine Moulin DWWM</small>
    </p>
</div>
@endsection
