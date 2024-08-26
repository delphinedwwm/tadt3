@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Titre de la page -->
        <div class="pull-left">
            <h2>Add New Category</h2>
        </div>
        <!-- Bouton pour retourner à la liste des categories -->
        <div class="pull-right">
            <a class="btn btn-primary btn-sm" href="{{ route('categories.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
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

<!-- Formulaire pour ajouter une nouvelle catégorie -->
<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf <!-- Protection CSRF -->

    <div class="row">
        <!-- Champ pour le nom de la catégorie -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
                @error('name')
                <span>{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <!-- Champ pour le logo -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label label  for="logo" > Logo : </label > 
                <input  type="file"  name="logo"  id="logo" > 
                <!-- <strong>Logo :</strong>
                <input type="file" id="logo" name="logo" accept="image/png, image/jpeg"> -->
                @error('logo')
                <span>{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <!-- Champ pour les type de la catégorie -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Type:</strong>
                <input type="text" name="type" class="form-control" placeholder="Type">
                @error('type')
                <span>{{ $message }}</span>
                @enderror
            </div>
        </div>
        <!-- Bouton pour soumettre le formulaire -->
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mb-3 mt-2"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
    </div>
</form>

<!-- Pied de page avec un crédit -->
<!-- Mention du projet -->
<p class="text-center text-primary"><small>Delphine Moulin DWWM</small></p>
@endsection

