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