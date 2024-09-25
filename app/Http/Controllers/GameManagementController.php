<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Question;
use App\Models\User;
use App\Models\UserQuestion;
use App\Models\GameQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GameManagementController extends Controller
{
    // SECTION: Games Management

    public function __construct()
    {
        //    
    }

    /**
     * Start a new game for the authenticated user.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function testGame(Request $request)
    {
        // Récupère la question de la session si elle existe
        $questionId = $request->session()->get('current_question_id');
        
        if ($questionId) {
            $question = Question::find($questionId);
        } else {
            // Sélectionne une question aléatoire si aucune question en session
            $question = Question::inRandomOrder()->with('answers')->first();
            // Stocke l'ID de la question dans la session
            $request->session()->put('current_question_id', $question->id);
        }
        // Mélange des réponses
        $shuffledAnswers = $question->answers->shuffle();
    
        return view('components.test-game', compact('question'));
    }

    public function submitAnswerTest(Request $request)
    {        
        // Récupérer l'ID de la réponse sélectionnée par l'utilisateur
        $selectedAnswerId = $request->input('answer');
        
        // Récupérer la question en cours depuis la session
        $questionId = $request->session()->get('current_question_id');
        $question = Question::with('answers')->find($questionId);

        // Récupérer la réponse correcte associée à cette question
        $correctAnswer = $question->answers()->where('is_correct', true)->first();

        // Vérifier si la réponse sélectionnée est correcte
        $isCorrect = ($selectedAnswerId == $correctAnswer->id);

        // Rediriger vers la vue de la question avec les informations sur la réponse sélectionnée
        return redirect()->route('games.test')
            ->with('is_correct', $isCorrect)
            ->with('correct_answer_id', $correctAnswer->id)
            ->with('selected_answer_id', $selectedAnswerId);
    }




    public function showQuestionTest(Request $request)
    {
        // Récupère l'ID de la question de la session si elle existe
        $questionId = $request->session()->get('current_question_id');
        
        // Récupérer la question existante ou en choisir une nouvelle
        $question = $questionId ? Question::with('answers')->find($questionId) : Question::inRandomOrder()->with('answers')->first();
        
        // Vérifier si la question a été trouvée
        if (!$question) {
            // Rediriger ou afficher un message d'erreur si aucune question n'est trouvée
            return redirect()->route('games.index')->with('error', 'Aucune question trouvée.');
        }

        // Stocker l'ID de la question dans la session si nécessaire
        if (!$questionId) {
            $request->session()->put('current_question_id', $question->id);
        }

        // Mélanger les réponses
        $shuffledAnswers = $question->answers->shuffle();

        return view('components.test-game', compact('question', 'shuffledAnswers'));
    }



    public function nextQuestionTest(Request $request)
    {
        // Réinitialiser la question en session pour en obtenir une nouvelle
        $request->session()->forget('current_question_id');

        // Rediriger vers la route de la page de test (affichage de la nouvelle question)
        return redirect()->route('games.test');
    }


    public function startGame(Request $request)
    {
        $this->middleware('auth');

        $user = $request->user();

        if (!$user) {
            return redirect()->back()->with('error', 'Utilisateur non authentifié.');
        }

        // Vérifier si une partie existe déjà pour cet utilisateur
        $currentGame = Game::where('user_id', $user->id)->where('status', 'in_progress')->first();

        if ($currentGame) {
            if ($currentGame->status === 'in_progress') {
                return redirect()->back()->with('error', 'Une partie est déjà en cours pour cet utilisateur.');
            }

            // Créer une nouvelle partie uniquement si aucune partie active n'existe
            $game = Game::create([
                'user_id' => $user->id,
                'points' => 0,
                'status' => 'in_progress',
                'started_at' => now(),
            ]);

            return redirect()->route('games.show')
                            ->with('success', 'Nouvelle partie démarrée avec succès.');
        }
    }
    
    /**
     * Display a random question.
     * 
     * @return \Illuminate\View\View
     */
    

    private function calculatePoints($difficultyLevel)
    {
        $this->middleware('auth');

        switch ($difficultyLevel) {
            case 0:
                return 0;
            case 1:
                return 1;
            case 2:
                return 2;
            case 3:
                return 3;
            default:
                return 0;
        }
    }

    public function showQuestion(Request $request)
    {
        // Récupère la question de la session si elle existe
        $questionId = $request->session()->get('current_question_id');
        
        if ($questionId) {
            $question = Question::find($questionId);
        } else {
            // Sélectionne une question aléatoire si aucune question en session
            $question = Question::inRandomOrder()->with('answers')->first();
            // Stocke l'ID de la question dans la session
            $request->session()->put('current_question_id', $question->id);
        }
        // Mélange des réponses
        $shuffledAnswers = $question->answers->shuffle();
        $difficultyLevel = $question->difficulty_level;
        $pointsForQuestion = $this->calculatePoints($difficultyLevel);
        $points = $request->session()->get('points', 0);

        return view('components.start-game', compact('question', 'points', 'pointsForQuestion'));
    }
    /**
     * Handle the submission of an answer.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitAnswer(Request $request)
    {        
        // $this->middleware('auth');

        $selectedAnswerId = $request->input('answer');
        $questionId = $request->session()->get('current_question_id');

        // Récupére la question en cours et sa bonne réponse
        $question = Question::with('answers')->find($questionId);
        $correctAnswer = $question->answers()->where('is_correct', true)->first();

        // Vérifie si la réponse sélectionnée est correcte
        $isCorrect = ($selectedAnswerId == $correctAnswer->id);

        // Initialise les points s'ils n'existent pas dans la session
        if (!$request->session()->has('points')) {
            $request->session()->put('points', 0);
        }

        // Mise à jour les points si c'est correct
        if ($isCorrect) {
            $request->session()->increment('points');  // incrémentation des points 
        }

        // Réinitialise l'ID de la question actuelle après soumission
        $request->session()->forget('current_question_id');

        return redirect()->route('games.show', ['question' => $questionId])
            ->with('is_correct', $isCorrect)
            ->with('correct_answer_id', $correctAnswer->id)
            ->with('selected_answer_id', $selectedAnswerId)
            ->with('points', $request->session()->get('points'));
    }

    public function nextQuestion(Request $request)
    {
        // Réinitialiser la question en session pour en obtenir une nouvelle
        $request->session()->forget('current_question_id');

        // Rediriger vers la route de la page de test (affichage de la nouvelle question)
        return redirect()->route('games.start');
    }

    /**
     * Pause the active game.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pauseGame(Request $request)
    {
        $this->middleware('auth');

        $user = $request->user();

        // Récupérer la partie active de l'utilisateur
        $game = Game::where('user_id', $user->id)
                    ->where('status', 'in_progress')
                    ->first();

        if ($game) {
            // Mettre la partie en pause
            $game->status = 'paused';
            $game->paused_at = now();
            $game->save();

            return redirect()->route('home')->with('success', 'La partie a été mise en pause.');
        }

        return redirect()->route('home')->with('error', 'Aucune partie en cours à mettre en pause.');
    }

    /**
     * Stop the current game.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function stopGame(Request $request)
    {
        $this->middleware('auth');

        $user = $request->user();

        // Récupérer la partie en cours de l'utilisateur
        $game = Game::where('user_id', $user->id)
                    ->where('status', 'in_progress')
                    ->first();

        if ($game) {
            // Vérifier si toutes les questions ont été posées
            $totalQuestions = Question::count();
            $answeredQuestions = GameQuestion::where('game_id', $game->id)->count();

            if ($answeredQuestions >= $totalQuestions) {
                $game->status = 'completed'; // Mettre à jour le statut à 'completed'
                $game->ended_at = now();
                $game->save();

                return redirect()->route('games.stop')->with('success', 'Toutes les questions ont été posées. Partie terminée.');
            } else {
                return redirect()->back()->with('error', 'La partie n\'est pas terminée car toutes les questions n\'ont pas encore été posées.');
            }
        }

        return redirect()->back()->with('error', 'Aucune partie en cours.');
    }

    /**
     * Resume a paused game.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resumeGame(Request $request)
    {
        $this->middleware('auth');

        $user = $request->user();

        // Récupérer la partie en pause de l'utilisateur
        $game = Game::where('user_id', $user->id)
                    ->where('status', 'paused')
                    ->first();

        if ($game) {
            // Reprendre la partie
            $game->status = 'in_progress';
            $game->save();

            return redirect()->route('home')->with('success', 'La partie a été reprise.');
        }

        return redirect()->route('home')->with('error', 'Aucune partie à reprendre.');
    }

    /**
     * Display a listing of the games.
     * 
     * @return \Illuminate\View\View
     */
    public function someMethod()
    {
        $this->middleware('auth');

        $game = Game::where('user_id', auth()->id())
                    ->where('status', 'in_progress')
                    ->first();

        return view('app', compact('game'));
    }

    // SECTION: GameQuestion Management

    /**
     * Record an interaction with a game question.
     * 
     * @param int $gameId
     * @param int $questionId
     * @param bool $isCorrect
     * @return void
     */
    public function recordGameQuestionInteraction($gameId, $questionId, $isCorrect)
    {
        $this->middleware('auth');

        $gameQuestion = GameQuestion::where('game_id', $gameId)
                                    ->where('question_id', $questionId)
                                    ->first();

        if ($gameQuestion) {
            $gameQuestion->asked_count += 1;
            if ($isCorrect) {
                $gameQuestion->answers_trues_count += 1;
            }
            $gameQuestion->save();
        } else {
            GameQuestion::create([
                'game_id' => $gameId,
                'question_id' => $questionId,
                'asked_count' => 1,
                'stars' => 0,
                'answers_trues_count' => $isCorrect ? 1 : 0,
            ]);
        }
    }

    // SECTION: UserQuestion Management

    /**
     * Record an interaction with a user question.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recordUserQuestionInteraction(Request $request)
    {
        $this->middleware('auth');

        $user = $request->user(); // Récupère l'utilisateur connecté
        $questionId = $request->input('question_id'); // ID de la question
        $isCorrect = $request->input('is_correct'); // Boolean indiquant si la réponse est correcte
    
        $userQuestion = UserQuestion::firstOrNew([
            'user_id' => $user->id,
            'question_id' => $questionId
        ]);
    
        $userQuestion->asked_count += 1;
        if ($isCorrect) {
            $userQuestion->answers_trues_count += 1;
        }
        $userQuestion->save();
    
        // Calcul de la moyenne des réponses correctes
        $averageCorrectAnswers = UserQuestion::where('question_id', $questionId)
                                             ->avg('answers_trues_count');
    
        return response()->json([
            'message' => 'Interaction recorded successfully.',
            'average_correct_answers' => $averageCorrectAnswers
        ]);
    }
}
