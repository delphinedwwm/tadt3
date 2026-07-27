@extends('layouts.app')

@section('content')

<div class="container">
    <!-- SECTION ADMIN - Stats Globales -->
    @if(Auth::user()->hasRole('admin'))
        <div class="admin-management-block mb-5">
            <h1 class="mb-4">📊 Statistiques Globales (Admin)</h1>
            <div class="row">
                <div class="col-md-6">
                    <h5>Nombre de questions posées</h5>
                    <ul class="list-unstyled">
                        <li>Aujourd'hui : {{ $questionsToday ?? 0 }}</li>
                        <li>Cette semaine : {{ $questionsThisWeek ?? 0 }}</li>
                        <li>Ce mois-ci : {{ $questionsThisMonth ?? 0 }}</li>
                        <li>Cette année : {{ $questionsThisYear ?? 0 }}</li>
                        <li>Depuis le début : {{ $questionsAllTime ?? 0 }}</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5>Pourcentage de bonnes réponses</h5>
                    <ul class="list-unstyled">
                        <li>Aujourd'hui : {{ $correctAnswersPercentageToday ?? 0 }}%</li>
                        <li>Cette semaine : {{ $correctAnswersPercentageThisWeek ?? 0 }}%</li>
                        <li>Ce mois-ci : {{ $correctAnswersPercentageThisMonth ?? 0 }}%</li>
                        <li>Cette année : {{ $correctAnswersPercentageThisYear ?? 0 }}%</li>
                        <li>Depuis le début : {{ $correctAnswersPercentageAllTime ?? 0 }}%</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5>Nombres d'utilisateurs connectés</h5>
                    <ul class="list-unstyled">
                        <li>Aujourd'hui :</li>
                        <li>Cette semaine :</li>
                        <li>Ce mois-ci :</li>
                        <li>Cette année :</li>
                        <li>Depuis le début :</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5>Nombres de nouveaux utilisateurs</h5>
                    <ul class="list-unstyled">
                        <li>Aujourd'hui : {{ $newUsersToday ?? 0 }}</li>
                        <li>Cette semaine : {{ $newUsersThisWeek ?? 0 }}</li>
                        <li>Ce mois-ci : {{ $newUsersThisMonth ?? 0 }}</li>
                        <li>Cette année : {{ $newUsersThisYear ?? 0 }}</li>
                        <li>Depuis le début : {{ $newUsersAllTime ?? 0 }}</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5>Temps de connexion moyen</h5>
                    <ul class="list-unstyled">
                        <li>Aujourd'hui : minutes</li>
                        <li>Cette semaine : minutes</li>
                        <li>Ce mois-ci : minutes</li>
                        <li>Cette année : minutes</li>
                        <li>Depuis le début : minutes</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5>Temps de connexion le plus court</h5>
                    <ul class="list-unstyled">
                        <li>Aujourd'hui : minutes</li>
                        <li>Cette semaine : minutes</li>
                        <li>Ce mois-ci : minutes</li>
                        <li>Cette année : minutes</li>
                        <li>Depuis le début : minutes</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5>Temps de connexion le plus long</h5>
                    <ul class="list-unstyled">
                        <li>Aujourd'hui : minutes</li>
                        <li>Cette semaine : minutes</li>
                        <li>Ce mois-ci : minutes</li>
                        <li>Cette année : minutes</li>
                        <li>Depuis le début : minutes</li>
                    </ul>
                </div>

                <!-- Classement des catégories -->
                <div class="col-md-12 mt-5">
                    <h4 class="mb-4">📊 Classement des catégories</h4>
                    
                    <div class="row">
                        <!-- Aujourd'hui -->
                        <div class="col-md-6 mb-4">
                            <h6>Aujourd'hui</h6>
                            <ul class="list-unstyled">
                                @forelse($categoriesToday as $category)
                                    <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                @empty
                                    <li><em>Aucune donnée</em></li>
                                @endforelse
                            </ul>
                        </div>

                        <!-- Cette semaine -->
                        <div class="col-md-6 mb-4">
                            <h6>Cette semaine</h6>
                            <ul class="list-unstyled">
                                @forelse($categoriesThisWeek as $category)
                                    <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                @empty
                                    <li><em>Aucune donnée</em></li>
                                @endforelse
                            </ul>
                        </div>

                        <!-- Ce mois-ci -->
                        <div class="col-md-6 mb-4">
                            <h6>Ce mois-ci</h6>
                            <ul class="list-unstyled">
                                @forelse($categoriesThisMonth as $category)
                                    <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                @empty
                                    <li><em>Aucune donnée</em></li>
                                @endforelse
                            </ul>
                        </div>

                        <!-- Cette année -->
                        <div class="col-md-6 mb-4">
                            <h6>Cette année</h6>
                            <ul class="list-unstyled">
                                @forelse($categoriesThisYear as $category)
                                    <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                @empty
                                    <li><em>Aucune donnée</em></li>
                                @endforelse
                            </ul>
                        </div>

                        <!-- Depuis le début -->
                        <div class="col-md-6 mb-4">
                            <h6>Depuis le début</h6>
                            <ul class="list-unstyled">
                                @forelse($categoriesAllTime as $category)
                                    <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                @empty
                                    <li><em>Aucune donnée</em></li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- SECTION UTILISATEUR (pour TOUS les utilisateurs, y compris les admins) -->
    <div class="user-management-block mb-5">
        <h3 class="mb-4">👤 Mes Statistiques Personnelles</h3>
        <div class="row">
            <!-- Classement des catégories -->
            <div class="col-md-12 mb-4">
                <h5>📚 Classement de mes catégories</h5>
                <div class="row">
                    <div class="col-md-6">
                        <h6><strong>Aujourd'hui</strong></h6>
                        <ul class="list-unstyled">
                            @forelse($categoriesToday as $category)
                                <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                            @empty
                                <li><em>Aucune donnée</em></li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <h6><strong>Cette semaine</strong></h6>
                        <ul class="list-unstyled">
                            @forelse($categoriesThisWeek as $category)
                                <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                            @empty
                                <li><em>Aucune donnée</em></li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <h6><strong>Ce mois-ci</strong></h6>
                        <ul class="list-unstyled">
                            @forelse($categoriesThisMonth as $category)
                                <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                            @empty
                                <li><em>Aucune donnée</em></li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <h6><strong>Cette année</strong></h6>
                        <ul class="list-unstyled">
                            @forelse($categoriesThisYear as $category)
                                <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                            @empty
                                <li><em>Aucune donnée</em></li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <h6><strong>Depuis le début</strong></h6>
                        <ul class="list-unstyled">
                            @forelse($categoriesAllTime as $category)
                                <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                            @empty
                                <li><em>Aucune donnée</em></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Nombre de questions posées -->
            <div class="col-md-6">
                <h5>Nombre de questions posées</h5>
                <ul class="list-unstyled">
                    <li>Aujourd'hui : {{ $questionsToday ?? 0 }}</li>
                    <li>Cette semaine : {{ $questionsThisWeek ?? 0 }}</li>
                    <li>Ce mois-ci : {{ $questionsThisMonth ?? 0 }}</li>
                    <li>Cette année : {{ $questionsThisYear ?? 0 }}</li>
                    <li>Depuis le début : {{ $questionsAllTime ?? 0 }}</li>
                </ul>
            </div>

            <!-- Pourcentage de bonnes réponses -->
            <div class="col-md-6">
                <h5>Pourcentage de bonnes réponses</h5>
                <ul class="list-unstyled">
                    <li>Aujourd'hui : {{ $correctAnswersPercentageToday ?? 0 }}%</li>
                    <li>Cette semaine : {{ $correctAnswersPercentageThisWeek ?? 0 }}%</li>
                    <li>Ce mois-ci : {{ $correctAnswersPercentageThisMonth ?? 0 }}%</li>
                    <li>Cette année : {{ $correctAnswersPercentageThisYear ?? 0 }}%</li>
                    <li>Depuis le début : {{ $correctAnswersPercentageAllTime ?? 0 }}%</li>
                </ul>
            </div>

            <!-- Connexions -->
            <div class="col-md-6">
                <h5>Nombres de fois que je me suis connecté</h5>
                <ul class="list-unstyled">
                    <li>Aujourd'hui :</li>
                    <li>Cette semaine :</li>
                    <li>Ce mois-ci :</li>
                    <li>Cette année :</li>
                    <li>Depuis le début :</li>
                </ul>
            </div>

            <div class="col-md-6">
                <h5>Temps de connexion moyen</h5>
                <ul class="list-unstyled">
                    <li>Aujourd'hui : minutes</li>
                    <li>Cette semaine : minutes</li>
                    <li>Ce mois-ci : minutes</li>
                    <li>Cette année : minutes</li>
                    <li>Depuis le début : minutes</li>
                </ul>
            </div>

            <div class="col-md-6">
                <h5>Temps de connexion le plus court</h5>
                <ul class="list-unstyled">
                    <li>Aujourd'hui : minutes</li>
                    <li>Cette semaine : minutes</li>
                    <li>Ce mois-ci : minutes</li>
                    <li>Cette année : minutes</li>
                    <li>Depuis le début : minutes</li>
                </ul>
            </div>

            <div class="col-md-6">
                <h5>Temps de connexion le plus long</h5>
                <ul class="list-unstyled">
                    <li>Aujourd'hui : minutes</li>
                    <li>Cette semaine : minutes</li>
                    <li>Ce mois-ci : minutes</li>
                    <li>Cette année : minutes</li>
                    <li>Depuis le début : minutes</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            <form method="GET" action="{{ route('games.start') }}">
            @csrf
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Démarrer la Partie</button>
                </div>
            </form>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <!-- Bloc de gestion des parties -->
    <div class="game-management-block mt-4">
        <h2 class="mb-3">🎮 Jouer</h2>
        <div class="d-flex justify-content-start gap-2">
            @if (!isset($game))
                <p>Aucune partie en cour.</p>
                <a href="{{ route('games.start') }}" class="btn btn-primary">Commencer une Partie</a>
            @elseif ($game->status == 'paused')
                <p>Le jeu est en pause.</p>
                <a href="{{ route('games.resume') }}" class="btn btn-success">Reprendre la Partie</a>
            @elseif ($game->status == 'in_progress')
                <p>Le jeu est actif.</p>
            @else
                <p>Le jeu est terminé.</p>
                <a href="{{ route('games.start') }}" class="btn btn-primary">Commencer une nouvelle Partie</a>
            @endif
        </div>
    </div>
</div>

@endsection