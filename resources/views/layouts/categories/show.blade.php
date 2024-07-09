@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Titre de la page -->
        <div class="pull-left">
            <h2> Show Category</h2>
        </div>
        <!-- Bouton pour retourner à la liste des catégories -->
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
        </div>
    </div>
</div>

<!-- Affichage des détails des catégories -->
<div class="row">
    <!-- Affichage du nom des catégories -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $category->name }}
        </div>
    </div>
    <!-- Affichage de la couleur de la  catégories -->  
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Color</strong> <!-- attetion ajouter logo et colors geérée en CSS -->
            {{ $category->color }}
        </div>
    </div>
    <!-- Affichage du type des catégories -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Type</strong>
            {{ $category->type }}
        </div>
    </div>
</div>

<!-- Pied de page avec un crédit -->
<!-- Mention du projet -->
<p class="text-center text-primary"><small>Delphine Moulin DWWM</small></p>
@endsection
