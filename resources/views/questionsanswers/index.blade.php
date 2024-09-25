@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <!-- Titre de la page -->
            <div class="pull-left">
                <h2>Liste des Questions et Réponses</h2>
            </div>
            <!-- Bouton pour créer une nouvelle question, visible uniquement si l'utilisateur a la permission -->
            <div class="pull-right">
                @can('questionanswer-create')
                <a class="btn btn-success btn-sm mb-2" href="{{ route('questionsanswers.create') }}"><i class="fa fa-plus"></i> Ajouter une nouvelle question</a>
                @endcan
            </div>
        </div>
    </div>

    <!-- Affichage d'un message de succès si une session 'success' est active -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <!-- Tableau pour afficher la liste des questions et réponses -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Énoncé</th>
                <th>Niveau</th>
                <th>Nom Catégorie</th>
                <th>Réponses</th>
                <th width="280px">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Boucle pour afficher chaque question -->
            @foreach ($questions as $question)
            <tr>
                <!-- Affiche l'id de la question -->
                <td>{{ $question->id }}</td>
                <!-- Affiche l'énoncé de la question -->
                <td>{{ $question->question }}</td>
                <!-- Affiche le niveau de la question -->
                <td>{{ $question->level }}</td>
                <!-- Affiche le nom de la catégorie de la question -->
                <td>{{ $question->category->name }}</td>
                <!-- Affiche les réponses associées à la question -->
                <td>
                    <ul>
                        @foreach ($question->answers as $answer)
                        <li>{{ $answer->description }} ({{ $answer->is_correct ? 'True' : 'False' }})</li>
                        @endforeach
                    </ul>
                </td>
                <!-- Actions disponibles pour chaque question -->
                <td>
                    <form action="{{ route('questionsanswers.destroy',$question->id) }}" method="POST">
                        <!-- Lien pour afficher les détails du category -->
                        <a class="btn btn-info btn-sm" href="{{ route('questionsanswers.show',$question->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                        <!-- Lien pour éditer la categorie, visible uniquement si l'utilisateur a la permission -->
                        @can('questionanswer-edit')
                        <a class="btn btn-primary btn-sm" href="{{ route('questionsanswers.edit',$question->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                        @endcan

                        @csrf
                        @method('DELETE')
                        <!-- Bouton pour supprimer la question et ses réponses, visible uniquement si l'utilisateur a la permission -->
                        @can('questionanswer-delete')
                        <a class="btn btn-danger btn-sm" href="{{ route('questionsanswers.delete', $question->id) }}">Delete</a>
                        @endcan

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination des questions -->
    {!! $questions->links('pagination::bootstrap-5') !!}

    <!-- Pied de page avec un crédit -->
    <p class="text-center text-primary"><small>Delphine Moulin DWWM</small></p>
</div>
@endsection