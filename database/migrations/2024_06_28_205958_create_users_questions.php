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
        // Crée la table de liason 'users_questions'
        Schema::create('users_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->timestamps();

            // Contraintes de clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            
            // Contrainte d'unicité
            $table->unique(['user_id','question_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprime la table de liaison 'users_questions'
        Schema::dropIfExists('users_questions');
    }
};
