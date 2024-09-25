<!-- resources/views/questionanswercontroller/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Détails de la Question</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="{{ route('questionsanswers.index') }}"><i class="fa fa-arrow-left"></i> Retour</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Énoncé:</strong>
                {{ $question->question }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Niveau:</strong>
                {{ $question->level }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name Catégorie:</strong>
                {{ $question->category_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Utilisateur:</strong>
                {{ $question->user_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Réponses:</strong>
                <ul>
                    @foreach ($question->answers as $answer)
                        <li>{{ $answer->description }} ({{ $answer->is_correct ? 'True' : 'False' }})</li>
                    @endforeach
                </ul>
            </div>
            <!-- Actions disponibles pour chaque question -->
            <div>
                <form action="{{ route('questionsanswers.update',$question->id) }}" method="PUT">
                @csrf
                @method('PUT')
                    <!-- Lien pour éditer la questionanswer, visible uniquement si l'utilisateur a la permission -->
                    @can('questionanswer-edit')
                    <a class="btn btn-primary btn-sm" href="{{ route('questionsanswers.edit',$question->id) }}"> Edit</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                <!-- Bouton pour supprimer la question et ses réponses, visible uniquement si l'utilisateur a la permission -->
                @can('questionanswer-delete')
                        <a class="btn btn-danger btn-sm" href="{{ route('questionsanswers.delete', $question->id) }}">Delete</a>
                    @endcan
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
