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

        // Trouve la partie existante pour l'utilisateur ou crée une nouvelle partie 
        $game = Game::updateOrCreate(
            ['user_id' => $user->id], // Condition pour trouver la partie existante
            ['points' => 0] 
        );
    }
}
