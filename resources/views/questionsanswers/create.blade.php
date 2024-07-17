<!-- resources/views/questionanswercontroller/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Ajouter une nouvelle question</h2>
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

<form action="{{ route('questionsanswers.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="question">Énoncé :</label>
                <input type="text" name="question" class="form-control" placeholder="Question" value="{{ old('question') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="level">Niveau:</label>
                <div>
            <label>
                <input type="radio" name="level" value="1" {{ old('level') == 1 ? 'checked' : '' }}>
                Niveau 1
            </label>
        </div>
        <div>
            <label>
                <input type="radio" name="level" value="2" {{ old('level') == 2 ? 'checked' : '' }}>
                Niveau 2
            </label>
        </div>
        <div>
            <label>
                <input type="radio" name="level" value="3" {{ old('level') == 3 ? 'checked' : '' }}>
                Niveau 3
            </label>
        </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="category_id">Catégorie:</label>
                <select id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option name="category_id" class="form-control" placeholder="ID categorie" value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label>ID Utilisateur:</label>
                <input type="integer" name="user_id" class="form-control" placeholder="ID Utilisateur" value="{{ auth()->id() }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">   
            <h2>Réponses</h2>
        </div>
    </div>
    @for ($i = 0; $i < 4; $i++)
    <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
            <label for="answers[{{ $i }}][description]">Réponse {{ $i + 1 }}:</label>
            <input type="text" name="answers[{{ $i }}][description]" class="form-control" placeholder="Description de la réponse" value="{{ old("answers.$i.description") }}">
        </div>
        <div class="form-group">
            <label for="answers[{{ $i }}][is_correct]">Est-ce la réponse correcte ?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="answers[{{ $i }}][is_correct]" id="answers{{ $i }}Correct" value="1" {{ old("answers.$i.is_correct") == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="answers{{ $i }}Correct">Oui</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="answers[{{ $i }}][is_correct]" id="answers{{ $i }}Incorrect" value="0" {{ old("answers.$i.is_correct") == '0' ? 'checked' : '' }}>
                <label class="form-check-label" for="answers{{ $i }}Incorrect">Non</label>
            </div>
        </div>
    </div>
    @endfor
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary btn-sm mb-3 mt-2"><i class="fa-solid fa-floppy-disk"></i> Ajouter</button>
    </div>
</form>

<p class="text-center text-primary"><small>Delphine  Moulin DWWM</small></p>
@endsection
