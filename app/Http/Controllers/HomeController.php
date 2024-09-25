<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use App\Models\Question;
use App\Models\User;
use App\Models\UserQuestion;
use App\Models\GameQuestion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    private $categoriesToday;
    private $questionsToday;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showHome(Request $request)
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user(); // ou $request->user() si vous êtes en dehors du middleware auth

        // Assurer que l'utilisateur est connecté
        if (!$user) {
            return redirect()->route('login'); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        }

        // Récupérer le jeu associé à l'utilisateur
        // Supposons que chaque utilisateur a un jeu associé via une relation
        $game = $user->game; // Adaptez cette ligne en fonction de votre relation modèle

        // Passer les données à la vue
        return view('home', ['game' => $game]);
    }


    public function index()
    {
        $isNewUser = Auth::user()->created_at->isToday(); // Vérifie si le compte est créé aujourd'hui
        // Appelle la méthode statisticsAllUsers pour récupérer les statistiques
        return $this->statisticsAllUsers();
    }
    public function showGamePage(Request $request)
    {
        $user = $request->user();
        $game = Game::where('user_id', $user->id)
            ->where(function($query) {
                $query->where('status', Game::STATUS_IN_PROGRESS)
                    ->orWhere('status', Game::STATUS_PAUSED);
            })->first();

        $question = null;
        if ($game) {
            $question = Question::inRandomOrder()->first();
            $question = Question::with('answers')->first();
        }

        $points = $game ? $game->points : 0;

        return view('home', compact('question', 'points', 'game'));
    }

    public function statisticsAllUsers()
    {
        // Obtenir la date et l'heure actuelles
        $now = Carbon::now();
        // dd(coucou);

        // Récupérer une question aléatoire avec ses réponses
        $question = Question::with('answers')->inRandomOrder()->first();

        // Récupérer les catégories avec le nombre de questions, triées par le nombre de questions en ordre décroissant
        $categoriesToday = Category::withCount(['questions' => function ($query) use ($now) {
            $query->whereDate('created_at', $now->toDateString());
        }])->orderBy('questions_count', 'desc')->get();

        $categoriesThisWeek = Category::withCount(['questions' => function ($query) use ($now) {
            $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]);
        }])->orderBy('questions_count', 'desc')->get();

        $categoriesThisMonth = Category::withCount(['questions' => function ($query) use ($now) {
            $query->whereMonth('created_at', $now->month);
        }])->orderBy('questions_count', 'desc')->get();

        $categoriesThisYear = Category::withCount(['questions' => function ($query) use ($now) {
            $query->whereYear('created_at', $now->year);
        }])->orderBy('questions_count', 'desc')->get();

        $categoriesAllTime = Category::withCount('questions')->orderBy('questions_count', 'desc')->get();
        
        // Nombre de questions posées à différentes périodes
        $questionsToday = UserQuestion::whereDate('created_at', $now->toDateString())->count();
        $questionsThisWeek = UserQuestion::whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()])->count();
        $questionsThisMonth = UserQuestion::whereMonth('created_at', $now->month)->count();
        $questionsThisYear = UserQuestion::whereYear('created_at', $now->year)->count();
        $questionsAllTime = UserQuestion::count();

        // Calcul du pourcentage de bonnes réponses pour aujourd'hui
        // $correctAnswersToday = UserQuestion::whereDate('users_questions.created_at', $now->toDateString())
        //     ->join('answers', 'users_questions.answer_id', '=', 'answers.id') 
        //     ->where('answers.is_correct', true)
        //     ->count();
        // $totalAnswersToday = UserQuestion::whereDate('users_questions.created_at', $now->toDateString())->count();
        // $percentageCorrectToday = $totalAnswersToday ? ($correctAnswersToday / $totalAnswersToday) * 100 : 0;


        // // Pourcentage de bonnes réponses pour cette semaine
        // $correctAnswersThisWeek = UserQuestion::whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()])
        //     ->join('answers', 'users_questions.answer_id', '=', 'answers.id') // Assurez-vous d'utiliser la bonne colonne pour lier les tables
        //     ->where('answers.is_correct', true)
        //     ->count();
        // $totalAnswersThisWeek = UserQuestion::whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()])->count();
        // $percentageCorrectThisWeek = $totalAnswersThisWeek ? ($correctAnswersThisWeek / $totalAnswersThisWeek) * 100 : 0;

        // // Pourcentage de bonnes réponses pour ce mois-ci
        // $correctAnswersThisMonth = UserQuestion::whereMonth('users_questions.created_at', $now->month)
        //     ->join('answers', 'users_questions.answer_id', '=', 'answers.id') // Assurez-vous d'utiliser la bonne colonne pour lier les tables
        //     ->where('answers.is_correct', true)
        //     ->count();
        // $totalAnswersThisMonth = UserQuestion::whereMonth('users_questions.created_at', $now->month)->count();
        // $percentageCorrectThisMonth = $totalAnswersThisMonth ? ($correctAnswersThisMonth / $totalAnswersThisMonth) * 100 : 0;


        // // Pourcentage de bonnes réponses pour cette année
        // $correctAnswersThisYear = UserQuestion::whereYear('created_at', $now->year)
        //     ->join('answers', 'users_questions.answer_id', '=', 'answers.id') // Assurez-vous d'utiliser la bonne colonne pour lier les tables
        //     ->where('answers.is_correct', true)
        //     ->count();
        // $totalAnswersThisYear = UserQuestion::whereYear('created_at', $now->year)->count();
        // $percentageCorrectThisYear = $totalAnswersThisYear ? ($correctAnswersThisYear / $totalAnswersThisYear) * 100 : 0;

        // // Pourcentage de bonnes réponses depuis le début
        // $correctAnswersAllTime = UserQuestion::join('answers', 'users_questions.answer_id', '=', 'answers.id') // Assurez-vous d'utiliser la bonne colonne pour lier les tables
        //     ->where('answers.is_correct', true)
        //     ->count();
        // $totalAnswersAllTime = UserQuestion::count();
        // $percentageCorrectAllTime = $totalAnswersAllTime ? ($correctAnswersAllTime / $totalAnswersAllTime) * 100 : 0;


        // // Nombre d'utilisateurs connectés aujourd'hui
        // $usersConnectedToday = User::whereDate('last_login_at', $now->toDateString())->count();
        // // Nombre d'utilisateurs connectés cette semaine
        // $usersConnectedThisWeek = User::whereBetween('last_login_at', [$now->startOfWeek(), $now->endOfWeek()])->count();
        // // Nombre d'utilisateurs connectés ce mois-ci
        // $usersConnectedThisMonth = User::whereMonth('last_login_at', $now->month)->count();
        // // Nombre d'utilisateurs connectés cette année
        // $usersConnectedThisYear = User::whereYear('last_login_at', $now->year)->count();
        // // Nombre d'utilisateurs connectés depuis le début
        // $usersConnectedAllTime = User::count();

        // Nombre de nouveaux utilisateurs enregistrés aujourd'hui
        $newUsersToday = User::whereDate('created_at', $now->toDateString())->count();
        // Nombre de nouveaux utilisateurs enregistrés cette semaine
        $newUsersThisWeek = User::whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()])->count();
        // Nombre de nouveaux utilisateurs enregistrés ce mois-ci
        $newUsersThisMonth = User::whereMonth('created_at', $now->month)->count();
        // Nombre de nouveaux utilisateurs enregistrés cette année
        $newUsersThisYear = User::whereYear('created_at', $now->year)->count();
        // Nombre de nouveaux utilisateurs enregistrés depuis le début
        $newUsersAllTime = User::count();

        // // Durées de connexion moyenne, minimale et maximale pour aujourd'hui
        // $avgLoginDurationToday = User::whereDate('last_login_at', $now->toDateString())->avg('login_duration');
        // $minLoginDurationToday = User::whereDate('last_login_at', $now->toDateString())->min('login_duration');
        // $maxLoginDurationToday = User::whereDate('last_login_at', $now->toDateString())->max('login_duration');

        // // Durées de connexion moyenne, minimale et maximale pour cette semaine
        // $avgLoginDurationThisWeek = User::whereBetween('last_login_at', [$now->startOfWeek(), $now->endOfWeek()])->avg('login_duration');
        // $minLoginDurationThisWeek = User::whereBetween('last_login_at', [$now->startOfWeek(), $now->endOfWeek()])->min('login_duration');
        // $maxLoginDurationThisWeek = User::whereBetween('last_login_at', [$now->startOfWeek(), $now->endOfWeek()])->max('login_duration');

        // // Durées de connexion moyenne, minimale et maximale pour ce mois-ci
        // $avgLoginDurationThisMonth = User::whereMonth('last_login_at', $now->month)->avg('login_duration');
        // $minLoginDurationThisMonth = User::whereMonth('last_login_at', $now->month)->min('login_duration');
        // $maxLoginDurationThisMonth = User::whereMonth('last_login_at', $now->month)->max('login_duration');

        // // Durées de connexion moyenne, minimale et maximale pour cette année
        // $avgLoginDurationThisYear = User::whereYear('last_login_at', $now->year)->avg('login_duration');
        // $minLoginDurationThisYear = User::whereYear('last_login_at', $now->year)->min('login_duration');
        // $maxLoginDurationThisYear = User::whereYear('last_login_at', $now->year)->max('login_duration');

        // // Durées de connexion moyenne, minimale et maximale depuis le début
        // $avgLoginDurationAllTime = User::avg('login_duration');
        // $minLoginDurationAllTime = User::min('login_duration');
        // $maxLoginDurationAllTime = User::max('login_duration');


        // Retourner la vue 'home' avec les données collectées
        return view('home', compact(
            'categoriesToday',       
            'categoriesThisWeek',
            'categoriesThisMonth',
            'categoriesThisYear',
            'categoriesAllTime',

            'questionsToday',
            'questionsThisWeek',
            'questionsThisMonth',
            'questionsThisYear',
            'questionsAllTime',

            'question',
            // 'percentageCorrectToday',
            // 'percentageCorrectThisWeek',
            // 'percentageCorrectThisMonth',
            // 'percentageCorrectThisYear',
            // 'percentageCorrectAllTime',

            // 'usersConnectedToday',
            // 'usersConnectedThisWeek',
            // 'usersConnectedThisMonth',
            // 'usersConnectedThisYear',
            // 'usersConnectedAllTime',

            // 'newUsersToday',        
            // 'newUsersThisWeek',
            // 'newUsersThisMonth',
            // 'newUsersThisYear',
            // 'newUsersAllTime',

            // 'avgLoginDurationToday',
            // 'minLoginDurationToday',
            // 'maxLoginDurationToday',

            // 'avgLoginDurationThisWeek',
            // 'minLoginDurationThisWeek',
            // 'maxLoginDurationThisWeek',

            // 'avgLoginDurationThisMonth',
            // 'minLoginDurationThisMonth',
            // 'maxLoginDurationThisMonth',

            // 'avgLoginDurationThisYear',
            // 'minLoginDurationThisYear',
            // 'maxLoginDurationThisYear',
            
            // 'avgLoginDurationAllTime',
            // 'minLoginDurationAllTime',
            // 'maxLoginDurationAllTime'
        ));
    }

}
