

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Supprimer</h1>
    <h2>Êtes-vous sûr de vouloir supprimer la question ainsi que les réponses associées suivantes : {{ $question->question }}?</h2>

    <form action="{{ route('questionsanswers.destroy', $question->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>

    <!-- lien pour annuler -->
    <a href="{{ route('questionsanswers.index') }}">Annuler</a>
</div>
@endsection
