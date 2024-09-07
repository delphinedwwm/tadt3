<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Game;
use Illuminate\Support\Facades\Log;

class CreateGameOnUserRegister
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        // Récupère l'utilisateur nouvellement enregistré
        $user = $event->user;

        // Vérifie si l'utilisateur a un ID non nul
        if (is_null($user->id)) {
            Log::error('User ID is null. Cannot create game.', ['user' => $user]);
            return; // Arrête l'exécution si l'ID de l'utilisateur est null
        }

        // Trouve la partie existante pour l'utilisateur ou crée une nouvelle partie avec un score de 0
        $game = Game::updateOrCreate(
            ['user_id' => $user->id], // Condition pour trouver la partie existante
            ['points' => 0] 
        );

        // Optionnel : Log pour vérifier que la partie est créée
        Log::info("Game created for user ID: {$user->id}");
    }
}
