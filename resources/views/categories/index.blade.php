@extends('layouts.app')

@section('content')
    <div class="container mt-4"> <!-- Ajout de la classe container et une marge supérieure -->
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <!-- Titre de la page -->
                <div class="pull-left">
                    <h2>Categories</h2>
                </div>
                <!-- Bouton pour créer une nouvelle catégorie, visible uniquement si l'utilisateur a la permission -->
                <div class="pull-right">
                    @can('category-create')
                    <a class="btn btn-success btn-sm mb-2" href="{{ route('categories.create') }}">
                        <i class="fa fa-plus"></i> Create New Category
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Affichage d'un message de succès si une session 'success' est active -->
        @if (session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tableau pour afficher la liste des catégories -->
        <div class="table-responsive mt-3"> <!-- Ajout d'une table responsive et marge supérieure -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Type</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Boucle pour afficher chaque catégorie -->
                    @foreach ($categories as $category)
                    <tr>
                        <!-- Incrémente le compteur de catégories et affiche le numéro -->
                        <td>{{ $category->id }}</td>
                        <!-- Affiche le logo de la catégorie -->
                        <td>
                            <img src="{{ asset($category->logo) }}" alt="{{ $category->name }}" class="img-fluid img-thumbnail" style="max-width: 32px;">
                        </td>
                        <!-- Affiche le nom de la catégorie -->
                        <td>{{ $category->name }}</td>
                        <!-- Affiche le type de la catégorie -->
                        <td>{{ $category->type }}</td>
                        <!-- Actions disponibles pour chaque catégorie -->
                        <td>
                            <form action="{{ route('categories.delete', $category->id) }}" method="POST">
                                @csrf
                                <!-- Lien pour afficher les détails de la catégorie -->
                                <a class="btn btn-info btn-sm" href="{{ route('categories.show', $category->id) }}">
                                    <i class="fa-solid fa-list"></i> Show
                                </a>
                                <!-- Lien pour éditer la catégorie -->
                                <a class="btn btn-primary btn-sm" href="{{ route('categories.edit', $category->id) }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                @csrf
                                @method('DELETE')
                                <!-- Bouton pour supprimer la categorie, visible uniquement si l'utilisateur a la permission -->
                                @can('category-delete')
                                <a class="btn btn-danger btn-sm" href="{{ route('categories.delete', $category->id) }}">Delete</a>
                                @endcan
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination des catégories -->
        <div class="d-flex justify-content-center mt-4">
            {!! $categories->links('pagination::bootstrap-5') !!}
        </div>

        <!-- Pied de page avec un crédit -->
        <p class="text-center text-primary mt-4">
            <small>Delphine Moulin DWWM</small>
        </p>
    </div>
@endsection
