@extends('layouts.app')

@section('content')
    <div class="container mt-4"> <!-- Ajout d'une marge en haut et conteneur Bootstrap -->
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <!-- Titre de la page -->
                <div class="pull-left">
                    <h2>Add New Category</h2>
                </div>
                <!-- Bouton pour retourner à la liste des catégories -->
                <div class="pull-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('categories.index') }}">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <!-- Affichage des erreurs de validation -->
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
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
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
            @csrf <!-- Protection CSRF -->

            <div class="row">
                <!-- Champ pour le nom de la catégorie -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Champ pour le logo -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="logo">Logo:</label>
                        <input type="file" name="logo" id="logo" class="form-control-file">
                        @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Champ pour le type de la catégorie -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Type:</strong>
                        <input type="text" name="type" class="form-control" placeholder="Type">
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Bouton pour soumettre le formulaire -->
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-sm mb-3 mt-2">
                        <i class="fa-solid fa-floppy-disk"></i> Submit
                    </button>
                </div>
            </div>
        </form>

        <!-- Pied de page avec un crédit -->
        <p class="text-center text-primary mt-4">
            <small>Delphine Moulin DWWM</small>
        </p>
    </div>
@endsection
