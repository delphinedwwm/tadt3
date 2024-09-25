@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-lg-12">
            <!-- Conteneur pour le titre et le bouton -->
            <div class="mb-3">
                <!-- Titre de la page -->
                <h2>Edit Category</h2>
            </div>
            <!-- Bouton pour retourner à la liste des catégories -->
            <a class="btn btn-primary btn-sm" href="{{ route('categories.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>

    <!-- Affichage des erreurs de validation -->
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
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
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Protection CSRF -->
        @method('PUT') <!-- Méthode PUT pour mise à jour respecter protocole HTTP -->

        <div class="row">
            <!-- Champ pour le nom de la catégorie -->
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <label for="name" class="form-label"><strong>Name</strong></label>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" id="name" placeholder="Name">
                    @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Champ pour le logo actuel de la catégorie --> 
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <label for="current-logo" class="form-label">Current Logo:</label>
                    <div id="current-logo">
                        @if($category->logo)
                            <img src="{{ asset($category->logo) }}" alt="{{ $category->name }}" class="img-fluid" style="max-width: 150px;">
                        @else
                            <p>No logo available.</p>
                        @endif
                    </div>
                    @error('logo')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Champ pour le nouveau logo de la catégorie --> 
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <label for="logo" class="form-label">Upload New Logo (Optional):</label>
                    <input type="file" name="logo" class="form-control" id="logo">
                    @error('logo')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Champ pour le type de la catégorie -->
            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <label for="type" class="form-label"><strong>Type</strong></label>
                    <input type="text" name="type" value="{{ $category->type }}" class="form-control" id="type" placeholder="Type">
                    @error('type')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Bouton pour soumettre le formulaire -->
            <div class="col-md-12 text-center mt-3">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </div>
        </div>
    </form>

    <!-- Pied de page avec un crédit -->
    <p class="text-center text-primary mt-4">
        <small>Delphine Moulin DWWM</small>
    </p>
</div>
@endsection
