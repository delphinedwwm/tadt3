<?php

namespace App\Services\Game;

use App\Models\Game;
use App\Models\GameQuestion;
use App\Models\Question;
use Illuminate\Support\Facades\Log;

class GameService
{
    private UserQuestionService $userQuestionService;

    public function __construct(UserQuestionService $userQuestionService)
    {
        $this->userQuestionService = $userQuestionService;
    }

    /**
     * Démarre une nouvelle partie
     * 
     * @param int $userId
     * @param string $mode "complete" (60 questions) ou "category" (10 questions)
     * @param int|null $categoryId (requis si mode = "category")
     * @return Game
     */
    public function startGame(int $userId, string $mode = 'complete', ?int $categoryId = null): Game
    {
        try {
            // 1. Créer la partie
            $game = Game::create([
                'user_id' => $userId,
                'total_score' => 0,
                'current_streak' => 0,
                'status' => 'in_progress',
                'started_at' => now(),
            ]);

            Log::info("Partie créée pour l'user $userId avec le mode $mode", ['game_id' => $game->id]);

            // 2. Récupérer les questions selon le mode
            if ($mode === 'complete') {
                // MODE 1 : Toutes les questions (60)
                $questions = Question::all();
                Log::info("Mode complet : {$questions->count()} questions récupérées");
            } elseif ($mode === 'category' && $categoryId) {
                // MODE 2 : Questions d'une catégorie (10)
                $questions = Question::where('category_id', $categoryId)->get();
                Log::info("Mode catégorie $categoryId : {$questions->count()} questions récupérées");
            } else {
                throw new \Exception("Mode invalide ou categoryId manquant");
            }

            // 3. Créer les entrées GameQuestion PRÉ-REMPLIES
            foreach ($questions as $question) {
                GameQuestion::create([
                    'game_id' => $game->id,
                    'question_id' => $question->id,
                    'asked_count' => 0,
                    'stars' => 0,
                    'answers_trues_count' => 0,
                ]);
            }

            Log::info("GameQuestions créées", [
                'game_id' => $game->id,
                'count' => $questions->count()
            ]);

            return $game;

        } catch (\Exception $e) {
            Log::error("Erreur au démarrage de la partie", [
                'user_id' => $userId,
                'mode' => $mode,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Reprend une partie en pause
     * 
     * @param int $gameId
     * @return Game
     */
    public function resumeGame(int $gameId): Game
    {
        $game = Game::findOrFail($gameId);

        if ($game->status !== 'paused') {
            throw new \Exception("La partie n'est pas en pause");
        }

        $game->update([
            'status' => 'in_progress',
            'paused_at' => null,
        ]);

        Log::info("Partie reprise", ['game_id' => $gameId]);

        return $game;
    }

    /**
     * Met une partie en pause
     * 
     * @param int $gameId
     * @return Game
     */
    public function pauseGame(int $gameId): Game
    {
        $game = Game::findOrFail($gameId);

        if ($game->status !== 'in_progress') {
            throw new \Exception("La partie n'est pas en cours");
        }

        $game->update([
            'status' => 'paused',
            'paused_at' => now(),
        ]);

        Log::info("Partie mise en pause", ['game_id' => $gameId]);

        return $game;
    }

    /**
     * Annule une partie
     * 
     * @param int $gameId
     * @return void
     */
    public function cancelGame(int $gameId): void
    {
        $game = Game::findOrFail($gameId);

        // Supprimer les GameQuestions associées
        GameQuestion::where('game_id', $gameId)->delete();

        // Supprimer la partie
        $game->delete();

        Log::info("Partie annulée", ['game_id' => $gameId]);
    }

    /**
     * Vérifie si la partie est terminée
     * (toutes les questions posées 5 fois)
     * 
     * @param int $gameId
     * @return bool
     */
    public function isGameFinished(int $gameId): bool
    {
        $unfinishedQuestions = GameQuestion::where('game_id', $gameId)
                                           ->where('asked_count', '<', 5)
                                           ->count();

        return $unfinishedQuestions === 0;
    }

    /**
     * Récupère la progression de la partie
     * 
     * @param int $gameId
     * @return array
     */
    public function getGameProgress(int $gameId): array
    {
        $game = Game::findOrFail($gameId);

        $answeredQuestions = GameQuestion::where('game_id', $gameId)
                                        ->where('asked_count', '>', 0)
                                        ->count();

        $totalQuestions = GameQuestion::where('game_id', $gameId)->count();

        $finishedQuestions = GameQuestion::where('game_id', $gameId)
                                        ->where('asked_count', '>=', 5)
                                        ->count();

        $totalAnswers = GameQuestion::where('game_id', $gameId)
                                   ->sum('asked_count');

        $correctAnswers = GameQuestion::where('game_id', $gameId)
                                     ->sum('answers_trues_count');

        return [
            'game_id' => $gameId,
            'answered_questions' => $answeredQuestions,
            'total_questions' => $totalQuestions,
            'finished_questions' => $finishedQuestions,
            'total_answers' => $totalAnswers,
            'correct_answers' => $correctAnswers,
            'percentage' => $totalAnswers > 0 
                ? round(($correctAnswers / $totalAnswers) * 100, 2)
                : 0,
            'points' => $game->total_score,
            'status' => $game->status,
        ];
    }

    /**
     * Termine une partie et sauvegarde les stats dans UserQuestion
     * 
     * @param int $gameId
     * @return Game
     */
    public function completeGame(int $gameId): Game
    {
        $game = Game::findOrFail($gameId);

        // Récupérer toutes les GameQuestions
        $gameQuestions = GameQuestion::where('game_id', $gameId)->get();

        // Sauvegarder dans UserQuestion
        foreach ($gameQuestions as $gameQuestion) {
            $this->userQuestionService->recordInteraction(
                $game->user_id,
                $gameQuestion->question_id,
                $gameQuestion->answers_trues_count > 0
            );
        }

        $game->update([
            'status' => 'completed',
            'ended_at' => now(),
        ]);

        Log::info("Partie terminée et stats sauvegardées", ['game_id' => $gameId]);

        return $game;
    }

    /**
     * Récupère une question aléatoire non finie pour la partie
     * (Une question est finie quand asked_count >= 5)
     * 
     * @param int $gameId
     * @return Question|null
     */
    public function getNextQuestion(int $gameId): ?Question
    {
        $gameQuestion = GameQuestion::where('game_id', $gameId)
                                   ->where('asked_count', '<', 5)
                                   ->inRandomOrder()
                                   ->first();

        if (!$gameQuestion) {
            return null;
        }

        return $gameQuestion->question()->with('answers')->first();
    }
}