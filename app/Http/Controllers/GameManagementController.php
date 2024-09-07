<?php
namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Question;
use App\Models\User;
use App\Models\UserQuestion;
use App\Models\GameQuestion;
use Illuminate\Http\Request;

class GameManagementController extends Controller
{
    // SECTION: Games Management

    /**
     * Display a listing of the games.
     * 
     * @return \Illuminate\View\View
     */
    public function startGame(Request $request)
    {
        // S'assurer que l'utilisateur est connecté
        $user = $request->user();

        // Trouver une partie en cours de l'utilisateur
        $currentGame = Game::where('user_id', $user->user_id)
                            ->where('status', 'in_progress')
                            ->first();

        // Si une partie en cours existe, la mettre à jour ou la terminer
        if ($currentGame) {
            $currentGame->status = 'completed'; // Vous pouvez aussi l'archiver ou le marquer comme terminé
            $currentGame->updated_at = now();
            $currentGame->save();
        }

        // Crée une nouvelle partie
        $game = Game::create([
            'user_id' => $user->user_id,
            'points' => 0,
            'status' => 'in_progress',
            'started_at' => now(),
        ]);

        return response()->json(['message' => 'New game started successfully.']);
    }

    public function stopGame(Request $request)
    {
        $user = $request->user();
    
        // Récupérer la partie en cours de l'utilisateur
        $game = Game::where('user_id', $user->id)->where('is_active', true)->first();
    
        if ($game) {
            // Arrêter la partie
            $game->is_active = false;
            $game->ended_at = now(); // Enregistre le temps de fin de la partie
            $game->save();
    
            return response()->json(['message' => 'Partie arrêtée avec succès.']);
        }
    
        return response()->json(['message' => 'Aucune partie en cours.'], 404);
    }
    
    public function resumeGame(Request $request)
    {
        $user = $request->user();

        // Rechercher la dernière partie arrêtée non terminée de l'utilisateur
        $game = Game::where('user_id', $user->id)
                    ->where('is_active', false)
                    ->whereNull('completed_at')
                    ->orderBy('ended_at', 'desc')
                    ->first();

        if ($game) {
            // Reprendre la partie
            $game->is_active = true;
            $game->save();

            return response()->json(['message' => 'Partie reprise avec succès.']);
        }

        return response()->json(['message' => 'Aucune partie en attente de reprise.'], 404);

        // Sinon, créer une nouvelle partie
        $game = Game::create([
            'user_id' => $user->user_id,
            'points' => 0,
            'status' => 'in_progress',
            'started_at' => now(),
        ]);

        return response()->json(['message' => 'New game started successfully.']);
    }

    public function showGamePage()
    {
        $user = auth()->user();
        
        // Recherche la partie active ou la dernière partie interrompue
        $game = Game::where('user_id', $user->id)->where('is_active', false)->first();

        return view('games.index', compact('game'));
    }

    public function someMethod() {
        $game = Game::where('user_id', auth()->id())->where('is_active', true)->first();
        
        return view('app', compact('game'));
    }
    

     // SECTION: GameQuestion Management

    /**
     * Display a listing of the games.
     * 
     * @return \Illuminate\View\View
     */
    public function recordGameQuestionInteraction($gameId, $questionId, $isCorrect)
    {
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
                    'stars' => 0, // Par exemple, vous pouvez ajouter une évaluation
                    'answers_trues_count' => $isCorrect ? 1 : 0,
                ]);
            }
            $totalCorrectAnswers = GameQuestion::where('question_id', $questionId)
                                            ->sum('answers_trues_count');
    }
        
     // SECTION: UserQuestion Management

    /**
     * Display a listing of the games.
     * 
     * @return \Illuminate\View\View
     */
    public function recordUserQuestionInteraction(Request $request)
    {
        $user = $request->user(); // Récupère l'utilisateur connecté
        $questionId = $request->input('question_id'); // ID de la question
        $isCorrect = $request->input('is_correct'); // Boolean indiquant si la réponse est correcte

        // Trouver ou créer l'enregistrement de l'interaction question-utilisateur
        $userQuestion = UserQuestion::where('user_id', $user->id)
                                    ->where('question_id', $questionId)
                                    ->first();

        if ($userQuestion) {
            // Mettre à jour les statistiques existantes
            $userQuestion->asked_count += 1;
            if ($isCorrect) {
                $userQuestion->answers_trues_count += 1;
            }
            $userQuestion->save();
        } else {
            // Créer un nouvel enregistrement pour cette question et utilisateur
            UserQuestion::create([
                'user_id' => $user->id,
                'question_id' => $questionId,
                'asked_count' => 1,
                'stars' => 0, // Initialiser si nécessaire
                'answers_trues_count' => $isCorrect ? 1 : 0,
            ]);
        }

        return response()->json(['message' => 'Interaction recorded successfully.']);
        $totalCorrectAnswers = UserQuestion::where('question_id', $questionId)
                                    ->where('user_id', $userId)
                                    ->sum('answers_trues_count');

        $averageCorrectAnswers = UserQuestion::where('question_id', $questionId)
                                    ->avg('answers_trues_count');
                          
    }
    
}
