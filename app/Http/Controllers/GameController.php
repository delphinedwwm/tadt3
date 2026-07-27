<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameQuestion;
use App\Models\Question;
use App\Models\Category;
use App\Services\Game\GameService;
use App\Services\GameQuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GameController extends Controller
{
    // ============================================
    // ROUTES DE TEST (PUBLIC - SANS AUTH)
    // ============================================

    /**
     * Affiche une question aléatoire pour tester
     */
    public function testGame(Request $request)
    {
        $questionId = $request->session()->get('current_question_id');

        if ($questionId) {
            $question = Question::find($questionId);
        } else {
            $question = Question::inRandomOrder()->with('answers')->first();
            $request->session()->put('current_question_id', $question->id);
        }

        $shuffledAnswers = $question->answers->shuffle();
        return view('components.game.test-game', compact('question', 'shuffledAnswers'));
    }

    /**
     * Soumet une réponse au test
     */
    public function submitAnswerTest(Request $request)
    {
        $validated = $request->validate([
            'answer' => 'required'
        ], [
            'answer.required' => 'Veuillez sélectionner une réponse.'
        ]);

        $selectedAnswerId = $request->input('answer');
        $questionId = $request->session()->get('current_question_id');
        $question = Question::with('answers')->find($questionId);
        $correctAnswer = $question->answers()->where('is_correct', true)->first();

        $isCorrect = ($selectedAnswerId == $correctAnswer->id);

        return redirect()->route('games.test')
            ->with('is_correct', $isCorrect)
            ->with('correct_answer_id', $correctAnswer->id)
            ->with('selected_answer_id', $selectedAnswerId);
    }

    /**
     * Passe à la question suivante en test
     */
    public function nextQuestionTest(Request $request)
    {
        $request->session()->forget('current_question_id');
        return redirect()->route('games.test');
    }


    private GameService $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * Affiche les options de démarrage
     */
    public function startOptions()
    {
        $categories = Category::all();
        return view('games.start-options', compact('categories'));
    }

    /**
     * Démarre une partie (MODE 1 : Complète ou MODE 2 : Catégorie)
     */
    public function start(Request $request)
    {
        try {
            $validated = $request->validate([
                'mode' => 'required|in:complete,category',
                'category_id' => 'nullable|required_if:mode,category|exists:categories,id',
            ]);

            $userId = Auth::id();
            $mode = $validated['mode'];
            $categoryId = $validated['category_id'] ?? null;

            // Créer la partie avec la GameService
            $game = $this->gameService->startGame($userId, $mode, $categoryId);

            // Rediriger vers la première question
            return redirect()->route('games.showQuestion', $game->id);

        } catch (\Exception $e) {
            Log::error("Erreur au démarrage", ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erreur au démarrage de la partie');
        }
    }

    /**
     * Affiche une question aléatoire de la partie en cours
     */
    public function showQuestion($gameId)
    {
        try {
            $game = Game::findOrFail($gameId);
            $this->authorizeGame($game);

            // Récupérer une question aléatoire qui n'a pas encore been posée 5 fois
            $gameQuestion = GameQuestion::where('game_id', $gameId)
                                       ->where('asked_count', '<', 5)
                                       ->inRandomOrder()
                                       ->first();

            if (!$gameQuestion) {
                // La partie est terminée !
                return redirect()->route('games.summary', $gameId);
            }

            $question = $gameQuestion->question;
            $progress = $this->gameService->getGameProgress($gameId);

            return view('games.show-question', compact('game', 'question', 'gameQuestion', 'progress'));

        } catch (\Exception $e) {
            Log::error("Erreur affichage question", ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erreur');
        }
    }

    /**
     * Soumet une réponse
     */
    public function submitAnswer(Request $request, $gameId)
    {
        try {
            $game = Game::findOrFail($gameId);
            $this->authorizeGame($game);

            $validated = $request->validate([
                'question_id' => 'required|exists:questions,id',
                'answer_id' => 'required|exists:answers,id',
            ]);

            $questionId = $validated['question_id'];
            $answerId = $validated['answer_id'];

            // Récupérer la question et la réponse
            $question = Question::findOrFail($questionId);
            $answer = $question->answers()->findOrFail($answerId);

            // Vérifier si la réponse est correcte
            $isCorrect = $answer->is_correct;

            // Ajouter les points
            if ($isCorrect) {
                $points = $question->level; // 1, 2 ou 3 points
                $game->increment('total_score', $points);
            }

            // Mettre à jour GameQuestion
            $gameQuestion = GameQuestion::where('game_id', $gameId)
                                       ->where('question_id', $questionId)
                                       ->firstOrFail();

            $gameQuestion->increment('asked_count');

            if ($isCorrect) {
                $gameQuestion->increment('answers_trues_count');
            }

            // Vérifier si la partie est terminée
            if ($this->gameService->isGameFinished($gameId)) {
                $this->gameService->completeGame($gameId);
                return redirect()->route('games.summary', $gameId);
            }

            // Sinon, afficher la prochaine question
            return redirect()->route('games.showQuestion', $gameId)
                           ->with([
                               'last_answer_correct' => $isCorrect,
                               'points_earned' => $isCorrect ? $points : 0,
                           ]);

        } catch (\Exception $e) {
            Log::error("Erreur soumission réponse", ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erreur');
        }
    }

    /**
     * Met la partie en pause
     */
    public function pause($gameId)
    {
        try {
            $game = Game::findOrFail($gameId);
            $this->authorizeGame($game);

            $this->gameService->pauseGame($gameId);

            return redirect()->route('games.showPaused', $gameId)
                           ->with('success', 'Partie mise en pause');

        } catch (\Exception $e) {
            Log::error("Erreur mise en pause", ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erreur');
        }
    }

    /**
     * Affiche l'écran "Partie en pause"
     */
    public function showPaused($gameId)
    {
        $game = Game::findOrFail($gameId);
        $this->authorizeGame($game);
        $progress = $this->gameService->getGameProgress($gameId);

        return view('games.paused', compact('game', 'progress'));
    }

    /**
     * Reprend une partie en pause
     */
    public function resume($gameId)
    {
        try {
            $game = Game::findOrFail($gameId);
            $this->authorizeGame($game);

            $this->gameService->resumeGame($gameId);

            return redirect()->route('games.showQuestion', $gameId)
                           ->with('success', 'Partie reprise');

        } catch (\Exception $e) {
            Log::error("Erreur reprise", ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erreur');
        }
    }

    /**
     * Annule une partie
     */
    public function cancel($gameId)
    {
        try {
            $game = Game::findOrFail($gameId);
            $this->authorizeGame($game);

            $this->gameService->cancelGame($gameId);

            return redirect()->route('home')
                           ->with('success', 'Partie annulée');

        } catch (\Exception $e) {
            Log::error("Erreur annulation", ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erreur');
        }
    }

    /**
     * Affiche le résumé/statistiques de la partie
     */
    public function summary($gameId)
    {
        try {
            $game = Game::findOrFail($gameId);
            $this->authorizeGame($game);

            $progress = $this->gameService->getGameProgress($gameId);
            $gameQuestions = GameQuestion::where('game_id', $gameId)
                                        ->with('question.category')
                                        ->get();

            return view('games.summary', compact('game', 'progress', 'gameQuestions'));

        } catch (\Exception $e) {
            Log::error("Erreur résumé", ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Erreur');
        }
    }

    /**
     * Vérifie que c'est bien la partie de l'user
     */
    private function authorizeGame(Game $game)
    {
        if ($game->user_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }
    }
}