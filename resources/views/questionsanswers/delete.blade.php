

@extends('layouts.app')

@section('content')
    <h1>Êtes-vous sûr de vouloir supprimer la question ainsi que les réponses associées suivantes : {{ $question->question }}?</h1>

    <form action="{{ route('questionsanswers.destroy', $question->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>

    <!-- lien pour annuler -->
    <a href="{{ route('questionsanswers.index') }}">Annuler</a>
@endsection
