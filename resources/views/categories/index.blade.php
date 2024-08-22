@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Titre de la page -->
        <div class="pull-left">
            <h2>Categories</h2>
        </div>
        <!-- Bouton pour créer une nouvelle categorie, visible uniquement si l'utilisateur a la permission -->
        <div class="pull-right">
            @can('category-create')
            <a class="btn btn-success btn-sm mb-2" href="{{ route('categories.create') }}"><i class="fa fa-plus"></i> Create New category</a>
            @endcan
        </div>
    </div>
</div>

<!-- Affichage d'un message de succès si une session 'success' est active -->
@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }}
    </div>
@endsession

<!-- Tableau pour afficher la liste des categories -->
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Color</th> <!-- colors générée en CSS et rajouter le logo -->
        <th>Type</th>
        <th width="280px">Action</th>
    </tr>
    <!-- Boucle pour afficher chaque category -->
    @foreach ($categories as $category)
    <tr>
        <!-- Incrémente le compteur de category et affiche le numéro -->
        <td>{{ $category->id }}</td>
        <!-- Affiche le nom de la category -->
        <td>{{ $category->name }}</td>
        <!-- Affiche les couleurs de la category -->
        <td>{{ $category->color }}</td> <!-- attetion ajouter logo et colors geérée en CSS -->
        <!-- Affiche le type de la category -->
        <td>{{ $category->type }}</td>

        <!-- Actions disponibles pour chaque category -->
        <td>
            <form action="{{ route('categories.delete',$category->id) }}" method="POST">
                <!-- Lien pour afficher les détails du category -->
                <a class="btn btn-info btn-sm" href="{{ route('categories.show',$category->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                <!-- Lien pour éditer la categorie, visible uniquement si l'utilisateur a la permission -->
                @can('category-edit')
                <a class="btn btn-primary btn-sm" href="{{ route('categories.edit',$category->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                @endcan

                @csrf
                @method('GET')
                <!-- Bouton pour supprimer la categorie, visible uniquement si l'utilisateur a la permission -->
                @can('category-delete')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach
</table>

<!-- Pagination des categories -->
{!! $categories->links() !!}

<!-- Pied de page avec un crédit -->
<!-- Mention du projet -->
<p class="text-center text-primary"><small>Delphine Moulin DWWM</small></p>
@endsection
