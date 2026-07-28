@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <!-- ONGLETS -->
    <ul class="nav nav-tabs" id="statsTab" role="tablist">
        <!-- Onglet Admin (visible si admin) -->
        @if(Auth::user()->hasRole('admin'))
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" 
                    data-bs-target="#admin-stats" type="button" role="tab">
                Statistiques Globales
            </button>
        </li>
        @endif

        <!-- Onglet Personnel (pour tous) -->
        <li class="nav-item" role="presentation">
            <button class="nav-link @if(!Auth::user()->hasRole('admin')) active @endif" 
                    id="personal-tab" data-bs-toggle="tab" 
                    data-bs-target="#personal-stats" type="button" role="tab">
                Mes Statistiques
            </button>
        </li>

        <!-- Onglet Jeu (pour tous) -->
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="game-tab" data-bs-toggle="tab" 
                    data-bs-target="#game-section" type="button" role="tab">
                Jouer
            </button>
        </li>
    </ul>

    <!-- CONTENU DES ONGLETS -->
    <div class="tab-content" id="statsTabContent">

        <!-- ===== ONGLET 1 : STATS GLOBALES (ADMIN ONLY) ===== -->
        @if(Auth::user()->hasRole('admin'))
        <div class="tab-pane fade show active" id="admin-stats" role="tabpanel">
            <div class="admin-management-block mb-5 mt-4">
                <h1 class="mb-4">Statistiques Globales</h1>
                <div class="row">

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

                    <!-- Nombres d'utilisateurs connectés -->
                    <div class="col-md-6">
                        <h5>Nombres d'utilisateurs connectés</h5>
                        <ul class="list-unstyled">
                            <li>Aujourd'hui : </li>
                            <li>Cette semaine : </li>
                            <li>Ce mois-ci : </li>
                            <li>Cette année : </li>
                            <li>Depuis le début : </li>
                        </ul>
                    </div>

                    <!-- Nouveaux utilisateurs -->
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

                    <!-- Temps de connexion le plus court -->
                    <div class="col-md-6">
                        <h5>Temps de connexion le plus court</h5>
                        <ul class="list-unstyled">
                            <li>Aujourd'hui : </li>
                            <li>Cette semaine : </li>
                            <li>Ce mois-ci : </li>
                            <li>Cette année : </li>
                            <li>Depuis le début : </li>
                        </ul>
                    </div>

                    <!-- Temps de connexion moyen -->
                    <div class="col-md-6">
                        <h5>Temps de connexion moyen</h5>
                        <ul class="list-unstyled">
                            <li>Aujourd'hui : </li>
                            <li>Cette semaine : </li>
                            <li>Ce mois-ci : </li>
                            <li>Cette année : </li>
                            <li>Depuis le début : </li>
                        </ul>
                    </div>

                    <!-- Temps de connexion le plus long -->
                    <div class="col-md-6">
                        <h5>Temps de connexion le plus long</h5>
                        <ul class="list-unstyled">
                            <li>Aujourd'hui : </li>
                            <li>Cette semaine : </li>
                            <li>Ce mois-ci : </li>
                            <li>Cette année : </li>
                            <li>Depuis le début : </li>
                        </ul>
                    </div>

                    <!-- Classement des catégories GLOBALES -->
                    <div class="col-md-12 mt-5">
                        <h4 class="mb-4">Classement des catégories</h4>
                        <div class="row">
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
        </div>
        @endif

        <!-- ===== ONGLET 2 : MES STATS PERSONNELLES ===== -->
        <div class="tab-pane fade @if(!Auth::user()->hasRole('admin')) show active @endif" id="personal-stats" role="tabpanel">
            <div class="user-management-block mb-5 mt-4">
                <h1 class="mb-4">Mes Statistiques Personnelles</h1>
                <div class="row">

                    <!-- Nombre de questions que J'ai posées -->
                    <div class="col-md-6">
                        <h5>Nombre de questions que j'ai posées</h5>
                        <ul class="list-unstyled">
                            <li>Aujourd'hui : {{ $personalQuestionsToday ?? 0 }}</li>
                            <li>Cette semaine : {{ $personalQuestionsThisWeek ?? 0 }}</li>
                            <li>Ce mois-ci : {{ $personalQuestionsThisMonth ?? 0 }}</li>
                            <li>Cette année : {{ $personalQuestionsThisYear ?? 0 }}</li>
                            <li>Depuis le début : {{ $personalQuestionsAllTime ?? 0 }}</li>
                        </ul>
                    </div>

                    <!-- Pourcentage de bonnes réponses -->
                    <div class="col-md-6">
                        <h5>Mon pourcentage de bonnes réponses</h5>
                        <ul class="list-unstyled">
                            <li>Aujourd'hui : {{ $personalCorrectAnswersPercentageToday ?? 0 }}%</li>
                            <li>Cette semaine : {{ $personalCorrectAnswersPercentageThisWeek ?? 0 }}%</li>
                            <li>Ce mois-ci : {{ $personalCorrectAnswersPercentageThisMonth ?? 0 }}%</li>
                            <li>Cette année : {{ $personalCorrectAnswersPercentageThisYear ?? 0 }}%</li>
                            <li>Depuis le début : {{ $personalCorrectAnswersPercentageAllTime ?? 0 }}%</li>
                        </ul>
                    </div>

                    <!-- Classement de mes catégories -->
                    <div class="col-md-12 mt-5">
                        <h5>Mes catégories</h5>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h6><strong>Aujourd'hui</strong></h6>
                                <ul class="list-unstyled">
                                    @forelse($personalCategoriesToday as $category)
                                        <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                    @empty
                                        <li><em>Aucune donnée</em></li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="col-md-6 mb-4">
                                <h6><strong>Cette semaine</strong></h6>
                                <ul class="list-unstyled">
                                    @forelse($personalCategoriesThisWeek as $category)
                                        <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                    @empty
                                        <li><em>Aucune donnée</em></li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="col-md-6 mb-4">
                                <h6><strong>Ce mois-ci</strong></h6>
                                <ul class="list-unstyled">
                                    @forelse($personalCategoriesThisMonth as $category)
                                        <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                    @empty
                                        <li><em>Aucune donnée</em></li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="col-md-6 mb-4">
                                <h6><strong>Cette année</strong></h6>
                                <ul class="list-unstyled">
                                    @forelse($personalCategoriesThisYear as $category)
                                        <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                    @empty
                                        <li><em>Aucune donnée</em></li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="col-md-6 mb-4">
                                <h6><strong>Depuis le début</strong></h6>
                                <ul class="list-unstyled">
                                    @forelse($personalCategoriesAllTime as $category)
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
        </div>

        <!-- ===== ONGLET 3 : JOUER ===== -->
        <div class="tab-pane fade" id="game-section" role="tabpanel">
            <div class="game-management-block mt-4 mb-5">
                <h2 class="mb-3">Jouer</h2>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="d-flex justify-content-start gap-2">
                    @if (!isset($game) || $game === null)
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

    </div>
</div>

@endsection