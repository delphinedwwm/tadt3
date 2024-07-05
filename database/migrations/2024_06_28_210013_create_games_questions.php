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
        // Crée la table de liason 'games_questions'
        Schema::create('games_questions', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->integer('asked_count');
            $table->integer('nb_star(s)');
            $table->unsignedBigInteger('answers_trues_count')->default(0);
            $table->timestamps();

            // Contraintes de clé étrangère
            $table->foreign('user_id')->references('user_id')->on('games')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            
            

            $table->primary(['user_id','question_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprime la table de liaison 'games_questions'
        Schema::dropIfExists('games_questions');
    }
};