@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Titre de la page -->
        <div class="pull-left">
            <h2>Edit Category</h2>
        </div>
        <!-- Bouton pour retourner à la liste des catégories -->
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('categories.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

<!-- Affichage des erreurs de validation -->
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            <!-- Boucle pour afficher chaque erreur -->
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Formulaire pour éditer une catégorie existante -->
<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf <!-- Protection CSRF -->
    @method('PUT') <!-- Méthode PUT pour mise à jour respecter protocole http-->

    <div class="row">
        <!-- Champ pour le nom de la catégorie -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name</strong>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control" placeholder="Name">
                @error('name')
                <span>{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Champ pour la couleur de la catégorie LOGO --> 
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Color</strong> <!-- attetion ajouter logo et colors geérée en CSS -->
                <textarea class="form-control" style="height:150px" name="color" placeholder="Color">{{ $category->color }}</textarea>
                @error('color')
                <span>{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Champ pour le type de la catégorie -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Type</strong>
                <input type="text" name="type" value="{{ $category->type }}" class="form-control" placeholder="Type">
                @error('type')
                <span>{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Bouton pour soumettre le formulaire -->
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mb-2 mt-2"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
    </div>
</form>

<!-- Pied de page avec un crédit -->
<!-- Mention du projet -->
<p class="text-center text-primary"><small>Delphine Moulin DWWM</small></p>
@endsection
