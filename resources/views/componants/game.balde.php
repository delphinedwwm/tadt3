@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Catégorie : {{ $question->category->category_name }}</h2>
    <p>Niveau de difficulté : {{ $question->difficulty_level }}</p>
    
    <div class="question">
        <h3>{{ $question->question_text }}</h3>
        
        <ul>
            @foreach($question->answers as $answer)
                <li>{{ $answer->answer_text }}</li>
            @endforeach
        </ul>
    </div>
    
    <!-- Ajouter des boutons ou des actions pour répondre à la question -->
</div>
@endsection
