<div class="statistics-tabs-container">
    <!-- Onglets/Tabs -->
    <div class="tabs-header mb-4">
        <div class="tabs-buttons d-flex gap-3">
            @if($isAdmin)
                <button class="tab-button active" data-tab="admin-stats">
                    <i class="bi bi-graph-up"></i> Stats Globales (Admin)
                </button>
                <button class="tab-button" data-tab="personal-stats">
                    <i class="bi bi-person-circle"></i> Mes Stats Personnelles
                </button>
            @else
                <button class="tab-button active" data-tab="personal-stats">
                    <i class="bi bi-person-circle"></i> Mes Stats Personnelles
                </button>
            @endif
        </div>
    </div>

    <!-- Contenu des onglets -->
    <div class="tabs-content">
        <!-- TAB 1: Stats Admin -->
        @if($isAdmin)
            <div id="admin-stats" class="tab-pane active">
                <div class="admin-management-block mb-5">
                    <h2 class="mb-4">📊 Statistiques Globales</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Nombre de questions posées</h5>
                            <ul class="list-unstyled">
                                <li>Aujourd'hui : {{ $stats['questionsToday'] ?? 0 }}</li>
                                <li>Cette semaine : {{ $stats['questionsThisWeek'] ?? 0 }}</li>
                                <li>Ce mois-ci : {{ $stats['questionsThisMonth'] ?? 0 }}</li>
                                <li>Cette année : {{ $stats['questionsThisYear'] ?? 0 }}</li>
                                <li>Depuis le début : {{ $stats['questionsAllTime'] ?? 0 }}</li>
                            </ul>
                        </div>

                        <div class="col-md-6">
                            <h5>Pourcentage de bonnes réponses</h5>
                            <ul class="list-unstyled">
                                <li>Aujourd'hui : {{ $stats['correctAnswersPercentageToday'] ?? 0 }}%</li>
                                <li>Cette semaine : {{ $stats['correctAnswersPercentageThisWeek'] ?? 0 }}%</li>
                                <li>Ce mois-ci : {{ $stats['correctAnswersPercentageThisMonth'] ?? 0 }}%</li>
                                <li>Cette année : {{ $stats['correctAnswersPercentageThisYear'] ?? 0 }}%</li>
                                <li>Depuis le début : {{ $stats['correctAnswersPercentageAllTime'] ?? 0 }}%</li>
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
                                <li>Aujourd'hui : {{ $stats['newUsersToday'] ?? 0 }}</li>
                                <li>Cette semaine : {{ $stats['newUsersThisWeek'] ?? 0 }}</li>
                                <li>Ce mois-ci : {{ $stats['newUsersThisMonth'] ?? 0 }}</li>
                                <li>Cette année : {{ $stats['newUsersThisYear'] ?? 0 }}</li>
                                <li>Depuis le début : {{ $stats['newUsersAllTime'] ?? 0 }}</li>
                            </ul>
                        </div>

                        <!-- Classement des catégories -->
                        <div class="col-md-12 mt-5">
                            <h4 class="mb-4">📊 Classement des catégories</h4>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h6>Aujourd'hui</h6>
                                    <ul class="list-unstyled">
                                        @forelse($stats['categoriesToday'] ?? [] as $category)
                                            <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                        @empty
                                            <li><em>Aucune donnée</em></li>
                                        @endforelse
                                    </ul>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <h6>Cette semaine</h6>
                                    <ul class="list-unstyled">
                                        @forelse($stats['categoriesThisWeek'] ?? [] as $category)
                                            <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                        @empty
                                            <li><em>Aucune donnée</em></li>
                                        @endforelse
                                    </ul>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <h6>Ce mois-ci</h6>
                                    <ul class="list-unstyled">
                                        @forelse($stats['categoriesThisMonth'] ?? [] as $category)
                                            <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                        @empty
                                            <li><em>Aucune donnée</em></li>
                                        @endforelse
                                    </ul>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <h6>Cette année</h6>
                                    <ul class="list-unstyled">
                                        @forelse($stats['categoriesThisYear'] ?? [] as $category)
                                            <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                        @empty
                                            <li><em>Aucune donnée</em></li>
                                        @endforelse
                                    </ul>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <h6>Depuis le début</h6>
                                    <ul class="list-unstyled">
                                        @forelse($stats['categoriesAllTime'] ?? [] as $category)
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

        <!-- TAB 2: Stats Personnelles -->
        <div id="personal-stats" class="tab-pane {{ $isAdmin ? '' : 'active' }}">
            <div class="user-management-block mb-5">
                <h2 class="mb-4">👤 Mes Statistiques Personnelles</h2>
                <div class="row">
                    <!-- Classement des catégories -->
                    <div class="col-md-12 mb-4">
                        <h5>📚 Classement de mes catégories</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <h6><strong>Aujourd'hui</strong></h6>
                                <ul class="list-unstyled">
                                    @forelse($stats['categoriesToday'] ?? [] as $category)
                                        <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                    @empty
                                        <li><em>Aucune donnée</em></li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <h6><strong>Cette semaine</strong></h6>
                                <ul class="list-unstyled">
                                    @forelse($stats['categoriesThisWeek'] ?? [] as $category)
                                        <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                    @empty
                                        <li><em>Aucune donnée</em></li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <h6><strong>Ce mois-ci</strong></h6>
                                <ul class="list-unstyled">
                                    @forelse($stats['categoriesThisMonth'] ?? [] as $category)
                                        <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                    @empty
                                        <li><em>Aucune donnée</em></li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <h6><strong>Cette année</strong></h6>
                                <ul class="list-unstyled">
                                    @forelse($stats['categoriesThisYear'] ?? [] as $category)
                                        <li>{{ $category->name }} - {{ $category->questions_count }} questions</li>
                                    @empty
                                        <li><em>Aucune donnée</em></li>
                                    @endforelse
                                </ul>
                            </div>

                            <div class="col-md-6">
                                <h6><strong>Depuis le début</strong></h6>
                                <ul class="list-unstyled">
                                    @forelse($stats['categoriesAllTime'] ?? [] as $category)
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
                            <li>Aujourd'hui : {{ $stats['questionsToday'] ?? 0 }}</li>
                            <li>Cette semaine : {{ $stats['questionsThisWeek'] ?? 0 }}</li>
                            <li>Ce mois-ci : {{ $stats['questionsThisMonth'] ?? 0 }}</li>
                            <li>Cette année : {{ $stats['questionsThisYear'] ?? 0 }}</li>
                            <li>Depuis le début : {{ $stats['questionsAllTime'] ?? 0 }}</li>
                        </ul>
                    </div>

                    <!-- Pourcentage de bonnes réponses -->
                    <div class="col-md-6">
                        <h5>Pourcentage de bonnes réponses</h5>
                        <ul class="list-unstyled">
                            <li>Aujourd'hui : {{ $stats['correctAnswersPercentageToday'] ?? 0 }}%</li>
                            <li>Cette semaine : {{ $stats['correctAnswersPercentageThisWeek'] ?? 0 }}%</li>
                            <li>Ce mois-ci : {{ $stats['correctAnswersPercentageThisMonth'] ?? 0 }}%</li>
                            <li>Cette année : {{ $stats['correctAnswersPercentageThisYear'] ?? 0 }}%</li>
                            <li>Depuis le début : {{ $stats['correctAnswersPercentageAllTime'] ?? 0 }}%</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .statistics-tabs-container {
        width: 100%;
    }

    .tabs-header {
        border-bottom: 2px solid #e0e0e0;
    }

    .tabs-buttons {
        display: flex;
        gap: 1rem;
    }

    .tab-button {
        background: none;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        cursor: pointer;
        color: #666;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .tab-button:hover {
        color: #2980b9;
    }

    .tab-button.active {
        color: #2980b9;
        border-bottom-color: #2980b9;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .tab-button i {
        margin-right: 8px;
    }
</style>

<script>
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            
            // Masquer tous les onglets
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('active');
            });
            
            // Désactiver tous les boutons
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Afficher l'onglet sélectionné
            document.getElementById(tabName).classList.add('active');
            this.classList.add('active');
        });
    });
</script>