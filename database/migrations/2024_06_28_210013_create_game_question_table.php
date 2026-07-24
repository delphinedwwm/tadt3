<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crée la table de liason 'game_question'
        Schema::create('game_question', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->integer('asked_count')->default(0);
            $table->integer('stars')->default(0);
            $table->integer('answers_trues_count')->default(0);
            $table->timestamps();
            // Empêche d'avoir deux fois la même question dans la même partie
            $table->unique(['game_id', 'question_id']);
        });
    
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprime la table de liaison 'game_question'
        Schema::dropIfExists('game_question');
    }
};