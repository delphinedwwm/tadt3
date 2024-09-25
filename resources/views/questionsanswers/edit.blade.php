<!-- resources/views/questionsanswers/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modifier la question et les réponses</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="{{ route('questionsanswers.index') }}"><i class="fa fa-arrow-left"></i> Retour</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il y a eu quelques problèmes avec votre entrée.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('questionsanswers.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Affichage de l'énoncé de la question -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="question"><strong>Énoncé :</strong></label>
                    <input type="text" name="question" class="form-control" value="{{ old('question', $question->question) }}" placeholder="Entrez l'énoncé de la question" required>
                </div>
            </div>

            <!-- Sélection du nom de la catégorie -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="category_id"><strong>Catégorie :</strong></label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="" disabled>Sélectionnez une catégorie</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $question->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Champ de niveau (pour modifier le niveau si nécessaire) -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="level"><strong>Niveau :</strong></label>
                    <input type="number" name="level" class="form-control" value="{{ $question->level }}" placeholder="Niveau" min="1" max="3" required>
                </div>
            </div>

            <h2>Réponses</h2>
            @foreach ($answers as $index => $answer)
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Réponse {{ $index + 1 }}:</strong>
                        <input type="text" name="answers[{{ $index }}][description]" class="form-control" value="{{ old('answers.' . $index . '.description', $answer->description) }}" placeholder="Description de la réponse">
                    </div>
                    <div class="form-group">
                        <label for="answers_correct_{{ $index }}">
                            <input type="radio" name="correct_answer" id="answers_correct_{{ $index }}" value="{{ $index }}" {{ $answer->is_correct ? 'checked' : '' }}>
                            Correcte
                        </label>
                        <input type="hidden" name="answers[{{ $index }}][id]" value="{{ $answer->id }}">
                    </div>
                </div>
            @endforeach


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm mb-3 mt-2"><i class="fa-solid fa-floppy-disk"></i> Mettre à jour</button>
            </div>
        </div>
    </form>

    <p class="text-center text-primary"><small>Delphine MOULIN DWWM</small></
</div>
@endSection
