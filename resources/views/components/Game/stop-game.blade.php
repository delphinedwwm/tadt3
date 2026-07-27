<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Arrêter la Partie</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('games.stop') }}">
            @csrf
            <div class="form-group">
                <button type="submit" class="btn btn-warning">Arrêter la Partie</button>
            </div>
        </form>
    </div>
@endsection