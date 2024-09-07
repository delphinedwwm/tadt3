@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Catégorie : {{ $question->name }}</h2>
    <p>Niveau de difficulté : {{ $question->level }}</p>
    
    <div class="question">
        <h3>{{ $question->text }}</h3>
        
        <ul>
            @foreach($question->answers as $answer)
                <li>{{ $answer->answer_text }}</li>
            @endforeach
        </ul>
    </div>    
</div>
@endsection
