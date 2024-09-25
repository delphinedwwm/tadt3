@extends('layouts.app')

@section('content')

<div class="container">
    <!-- Vérifiez si l'utilisateur connecté est admin -->
    @if(Auth::user()->hasRole('admin'))
        <!-- Bloc de gestion des statistiques -->
        <div class="admin-management-block mb-5">
            <h1 class="mb-4">Statistiques</h1>
            <div class="row">
                <div class="col-md-6">
                    <h5>Nombre de questions posées</h5>
                    <ul class="list-unstyled">
                        <li>Aujourd'hui :</li>
                        <li>Cette semaine :</li>
                        <li>Ce mois-ci :</li>
                        <li>Cette année :</li>
                        <li>Depuis le début :</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5>Pourcentage de bonnes réponses</h5>
                    <ul class="list-unstyled">
                        <li>Aujourd'hui :</li>
                        <li>Cette semaine :</li>
                        <li>Ce mois-ci :</li>
                        <li>Cette année :</li>
                        <li>Depuis le début :</li>
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
                <h5>Classement des catégories</h5>

                <!-- Aujourd'hui -->
                <div class="col-md-6">
                    <h5>Aujourd'hui</h5>
                    @if(isset($categoriesToday) && $categoriesToday->isNotEmpty())
                        <ul>
                            @foreach($categoriesToday as $category)
                                <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                            @endforeach
                        </ul>
                    @else
                        <p>Aucune donnée disponible pour aujourd'hui.</p>
                    @endif
                </div>
                <!-- Cette semaine -->
                <div class="col-md-6">
                    <h5>Cette semaine</h5>
                    <ul>
                        @foreach($categoriesThisWeek as $category)
                            <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Ce mois-ci -->
                <div class="col-md-6">
                    <h5>Ce mois-ci</h5>
                    <ul>
                        @foreach($categoriesThisMonth as $category)
                            <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Cette année -->
                <div class="col-md-6">
                    <h5>Cette année</h5>
                    <ul>
                        @foreach($categoriesThisYear as $category)
                            <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- Depuis le début -->
                <div class="col-md-6">
                    <h5>Depuis le début</h5>
                    <ul>
                    @foreach($categoriesAllTime as $category)
                        <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Bloc utilisateur -->
    @if(Auth::user()->hasRole('user'))
        <div class="user-management-block mb-5">
            <h3 class="mb-4">Statistiques Utilisateur</h3>
            <div class="row">
                <!-- Classement des catégories -->
                <div class="col-md-6">
                    <h5>Classement des catégories</h5>
                    <ul class="list-unstyled">
                        <li><strong>Aujourd'hui</strong></li>
                        @if(isset($categoriesToday) && $categoriesToday->isNotEmpty())
                            <ul>
                                @foreach($categoriesToday as $category)
                                    <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                @endforeach
                            </ul>
                        @else
                            <p>Aucune donnée disponible pour aujourd'hui.</p>
                        @endif

                        <li><strong>Cette semaine</strong></li>
                        <ul>
                            @foreach($categoriesThisWeek as $category)
                                <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                            @endforeach
                        </ul>

                        <li><strong>Ce mois-ci</strong></li>
                        <ul>
                            @foreach($categoriesThisMonth as $category)
                                <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                            @endforeach
                        </ul>

                        <li><strong>Cette année</strong></li>
                        <ul>
                            @foreach($categoriesThisYear as $category)
                                <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                            @endforeach
                        </ul>

                        <li><strong>Depuis le début</strong></li>
                        <ul>
                            @foreach($categoriesAllTime as $category)
                                <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                            @endforeach
                        </ul>
                    </ul>
                </div>

                <!-- Nombre de questions posées -->
                <div class="col-md-6">
                    <h5>Nombre de questions posées</h5>
                    <ul class="list-unstyled">
                        <li>Aujourd'hui :</li>
                        <li>Cette semaine :</li>
                        <li>Ce mois-ci :</li>
                        <li>Cette année :</li>
                        <li>Depuis le début :</li>
                    </ul>
                </div>

                <!-- Pourcentage de bonnes réponses -->
                <div class="col-md-6">
                    <h5>Pourcentage de bonnes réponses</h5>
                    <ul class="list-unstyled">
                        <li>Aujourd'hui :</li>
                        <li>Cette semaine :</li>
                        <li>Ce mois-ci :</li>
                        <li>Cette année :</li>
                        <li>Depuis le début :</li>
                    </ul>
                </div>

                <!-- Connexions -->
                <div class="col-md-6">
                    <h5>Nombres de fois que l'utilisateur s'est connecté</h5>
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
                    <h5>Temps de connexion la plus courte</h5>
                    <ul class="list-unstyled">
                        <li>Aujourd'hui : minutes</li>
                        <li>Cette semaine : minutes</li>
                        <li>Ce mois-ci : minutes</li>
                        <li>Cette année : minutes</li>
                        <li>Depuis le début : minutes</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h5>Temps de connexion la plus longue</h5>
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
    @endif


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
        <h2 class="mb-3">Jouer</h2>
        <div class="d-flex justify-content-start gap-2">
            @if (!isset($game))
                <!-- Si aucune partie n'est associée à l'utilisateur, affiche un bouton pour démarrer une nouvelle partie -->
                <p>Aucune partie en cour.</p>
                <a href="{{ route('games.start') }}" class="btn btn-primary">Commencer une Partie</a>
            @elseif ($game->status == 'paused')
                <!-- Si une partie est en pause, affiche un bouton pour la reprendre -->
                <p>Le jeu est en pause.</p>
                <a href="{{ route('games.resume') }}" class="btn btn-success">Reprendre la Partie</a>
            @elseif ($game->status == 'in_progress')
                <!-- Si une partie est en cours, affiche un message que le jeu est actif -->
                <p>Le jeu est actif.</p>
            @else
                <!-- Si la partie est terminée ou dans un autre état, affiche un message approprié -->
                <p>Le jeu est terminé.</p>
                <a href="{{ route('games.start') }}" class="btn btn-primary">Commencer une nouvelle Partie</a>
            @endif
        </div>
    </div>
</div>

@endsection

 
