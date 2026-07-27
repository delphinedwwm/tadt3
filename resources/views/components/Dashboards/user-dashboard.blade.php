@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Bloc de gestion des statistiques utilisateur -->
    <div class="admin-management-block mb-5">
        <h1 class="mb-4">Mes Statistiques Globales</h1>
        <div class="row">
            <!-- Stats globales de toutes les parties -->
            <div class="col-md-6">
                <h5>Nombre de questions posées (Toutes parties)</h5>
                <ul class="list-unstyled">
                    <li>Aujourd'hui : {{ $questionsToday ?? 0 }}</li>
                    <li>Cette semaine : {{ $questionsThisWeek ?? 0 }}</li>
                    <li>Ce mois-ci : {{ $questionsThisMonth ?? 0 }}</li>
                    <li>Cette année : {{ $questionsThisYear ?? 0 }}</li>
                    <li>Depuis le début : {{ $questionsAllTime ?? 0 }}</li>
                </ul>
            </div>

            <div class="col-md-6">
                <h5>Pourcentage de bonnes réponses (Toutes parties)</h5>
                <ul class="list-unstyled">
                    <li>Aujourd'hui : {{ $correctAnswersPercentageToday ?? 0 }}%</li>
                    <li>Cette semaine : {{ $correctAnswersPercentageThisWeek ?? 0 }}%</li>
                    <li>Ce mois-ci : {{ $correctAnswersPercentageThisMonth ?? 0 }}%</li>
                    <li>Cette année : {{ $correctAnswersPercentageThisYear ?? 0 }}%</li>
                    <li>Depuis le début : {{ $correctAnswersPercentageAllTime ?? 0 }}%</li>
                </ul>
            </div>

            <div class="col-md-6">
                <h5>Catégories les plus pratiquées (Toutes parties)</h5>
                <ul class="list-unstyled">
                    @forelse($categoriesToday as $category)
                        <li><strong>Aujourd'hui :</strong> {{ $category->name }} - {{ $category->questions_count }} questions</li>
                    @empty
                        <li>Aucune donnée</li>
                    @endforelse
                </ul>
            </div>

            <div class="col-md-6">
                <h5>Catégories cette semaine</h5>
                <ul class="list-unstyled">
                    @forelse($categoriesThisWeek as $category)
                        <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                    @empty
                        <li>Aucune donnée</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Bloc des parties individuelles -->
    <div class="admin-management-block mb-5">
        <h1 class="mb-4">Détail de mes Parties</h1>
        
        @forelse($games as $game)
            <div class="row mb-4 p-3 border rounded" style="background-color: #f9f9f9;">
                <div class="col-md-12">
                    <h5>Partie #{{ $game->id }} - {{ $game->created_at->format('d/m/Y H:i') }}</h5>
                </div>

                <div class="col-md-6">
                    <p><strong>Score total :</strong> {{ $game->total_score }} points</p>
                    <p><strong>Série actuelle :</strong> {{ $game->current_streak }} bonnes réponses</p>
                    <p><strong>Statut :</strong> 
                        <span class="badge 
                            @if($game->status == 'completed') bg-success
                            @elseif($game->status == 'paused') bg-warning
                            @else bg-info
                            @endif">
                            {{ ucfirst($game->status) }}
                        </span>
                    </p>
                </div>

                <div class="col-md-6">
                    <p><strong>Début :</strong> {{ $game->started_at->format('d/m/Y H:i') }}</p>
                    @if($game->ended_at)
                        <p><strong>Fin :</strong> {{ $game->ended_at->format('d/m/Y H:i') }}</p>
                    @endif
                </div>

                <!-- Détails des questions de cette partie -->
                <div class="col-md-12 mt-3">
                    <h6>Questions de cette partie :</h6>
                    <ul class="list-unstyled">
                        @forelse($game->gameQuestions as $gameQuestion)
                            <li>
                                <strong>{{ $gameQuestion->question->question }}</strong>
                                <br>
                                Posée {{ $gameQuestion->asked_count }}x | 
                                Bonnes réponses : {{ $gameQuestion->answers_trues_count }} | 
                                Étoiles : {{ $gameQuestion->stars }}
                            </li>
                        @empty
                            <li>Aucune question pour cette partie</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        @empty
            <p>Aucune partie trouvée.</p>
        @endforelse
    </div>
</div>
@endsection