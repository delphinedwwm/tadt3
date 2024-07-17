<!-- resources/views/questionanswercontroller/edit.blade.php -->
@extends('layouts.app')

@section('content')
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

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="question">Énoncé :</label>
                <input type="text" name="question" class="form-control" placeholder="Énoncé" value="{{ old('question') }}" >
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Niveau:</strong>
                <input type="number" name="level" class="form-control" value="{{ $question->level }}" placeholder="Niveau">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Catégorie:</strong>
                <input type="number" name="category_id" class="form-control" value="{{ $question->category_id }}" placeholder="ID Catégorie">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID Utilisateur:</strong>
                <input type="number" name="user_id" class="form-control" value="{{ $question->user_id }}" placeholder="ID Utilisateur">
            </div>
        </div>

        <h2>Réponses</h2>
        @foreach ($answers as $index => $answer)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Réponse {{ $index + 1 }}:</strong>
                    <input type="text" name="answers[{{ $index }}][description]" class="form-control" value="{{ $answer->description }}" placeholder="Description de la réponse">
                </div>
                <div class="form-group">
                    <label for="answers[{{ $index }}][is_correct]">
                        <input type="checkbox" name="answers[{{ $index }}][is_correct]" id="answers[{{ $index }}][is_correct]" value="1" {{ $answer->is_correct ? 'checked' : '' }}>
                        Correcte
                    </label>
                    <input type="hidden" name="answers[{{ $index }}][id]" value="{{ $answer->id }}">
                </div>
            </div>
        @endforeach

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mb-3 mt-2"><i class="fa-solid fa-floppy-disk"></i> Modifier</button>
        </div>
    </div>
</form>

<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
