<?php
namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{

    // Affiche une question aléatoire
    public function show(Request $request)
    {
        // Récupérer une question aléatoire avec ses réponses
        $question = Question::inRandomOrder()->with('answers')->first();

        // Récupérer le score actuel de l'utilisateur depuis la session
        $score = $request->session()->get('score', 0);

        // Passer les données à la vue
        return view('game', compact('question', 'score'));
    }

    // Traite la soumission de la réponse
    public function submitAnswer(Request $request)
    {
        // Vérifier si la réponse sélectionnée est correcte
        $isCorrect = $request->input('is_correct') == 1;

        // Si la réponse est correcte, augmenter le score dans la session
        if ($isCorrect) {
            $request->session()->increment('score');
        }

        // Rediriger vers une nouvelle question
        return redirect()->route('game.show');
    }
}

//  //c'est un composant donc ne reactualise que le composant et pas la page en entière.
//         // Affiche une question aléatoire
//         public function showQuestionAuther(Request $request)
//         {
//             // Récupérer une question aléatoire avec ses réponses
//             $question = Question::inRandomOrder()->with('answers')->first();
    
//             // Récupérer le score actuel de l'utilisateur depuis la session
//             $score = $request->session()->get('points', 0);
    
//             // Passer les données à la vue
//             return view('game_management.game', compact('question', 'points'));
//         }

//         // Traite la soumission de la réponse
//         public function submitAnswer(Request $request)
//         {
//             // Vérifier si la réponse sélectionnée est correcte
//             $isCorrect = $request->input('is_correct') == 1;
    
//             // Si la réponse est correcte, augmenter le score dans la session
//             if ($isCorrect) {
//                 $request->session()->increment('points');
//             }
    
//             // Rediriger vers une nouvelle question
//             return redirect()->route('games.show');
//         }
        
//         // Afficher un jeu spécifique
//         public function show($id)
//         {
//             // Récupère le jeu avec l'utilisateur associé et les questions liées via 'gameQuestions'
//             $game = Game::with('user', 'gameQuestions.question')->findOrFail($id);
//             // Retourne la vue 'games.show' avec les données du jeu
//             return view('games.show', compact('game'));
//         }
//         public function indexGames()
//         {
//             // Récupère tous les jeux dans la base de données
//             $games = Game::with('user', 'gameQuestions')->get();
//             // Retourne la vue 'index' avec la liste des jeux
//             return view('game_management.games.index', compact('games'));
//         }

//         public function startGame(Request $request)
// {
//     // Assurez-vous que l'utilisateur est connecté
//     $user = $request->user();

//     // Trouvez une partie en cours de l'utilisateur
//     $currentGame = Game::where('user_id', $user->user_id)
//                         ->where('status', 'in_progress')
//                         ->first();

//     // Si une partie en cours existe, la mettre à jour ou la terminer
//     if ($currentGame) {
//         $currentGame->status = 'completed'; // Vous pouvez aussi l'archiver ou le marquer comme terminé
//         $currentGame->updated_at = now();
//         $currentGame->save();
//     }

//     // Crée une nouvelle partie
//     $game = Game::create([
//         'user_id' => $user->user_id,
//         'points' => 0,
//         'status' => 'in_progress',
//         'started_at' => now(),
//     ]);

//     return response()->json(['message' => 'New game started successfully.']);
// }