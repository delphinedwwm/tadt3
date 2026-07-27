<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Question</h1>
        @if ($question)
            <!-- Afficher la catégorie et le niveau de difficulté -->
            <h2>Catégorie : {{ $question->category->name }}</h2>
            <p>Niveau de difficulté : {{ $question->level }}</p>
            <br>
            <p>{{ $question->question }}</p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin: 0; padding-left: 1rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="answerForm" action="{{ route('games.submitTest') }}" method="POST">
                @csrf
                @foreach ($question->answers as $answer)
                    <!-- Rendre toute la réponse cliquable sans cacher le bouton radio -->
                    <label id="answer-{{ $answer->id }}" class="answer-option
                        @if (session('selected_answer_id') == $answer->id)
                            @if (session('is_correct') && session('selected_answer_id') == $answer->id)
                                correct
                            @else
                                incorrect
                            @endif
                        @endif"
                        style="display: block; padding: 10px; border: 1px solid #ddd; margin-bottom: 5px; border-radius: 5px; cursor: pointer;"
                    >
                        <!-- Le bouton radio visible et cliquable avec le texte -->
                        <input type="radio" name="answer" value="{{ $answer->id }}" {{ session('selected_answer_id') == $answer->id ? 'checked' : '' }} style="margin-right: 10px;">
                        <span>{{ $answer->description }}</span>
                    </label>
                @endforeach
                @if (session('is_correct') === null)
                    <button type="submit" class="btn btn-primary">Soumettre la réponse</button>
                @endif
            </form>

            @if (session('is_correct') !== null)
                @if (session('is_correct'))
                    <p class="text-success">Bonne réponse !</p>
                @else
                    <p class="text-danger">Mauvaise réponse. La bonne réponse était : {{ $question->answers->where('is_correct', true)->first()->description }}</p>
                @endif

                <form action="{{ route('games.nextQuestionTest') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-secondary mt-3">Question Suivante</button>
                </form>
            @endif
        @endif
    </div>
@endsection
