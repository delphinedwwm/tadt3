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
        Schema::create('user_question', function (Blueprint $table) {
            $table->id(); // ✅ AJOUTE CETTE LIGNE
            
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->integer('asked_count')->default(0);
            $table->integer('stars')->default(0);
            $table->integer('answers_trues_count')->default(0);
            $table->timestamps();

            // Contraintes de clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

            // ✅ AJOUTE AUSSI L'UNICITÉ
            $table->unique(['user_id','question_id']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Supprime la table de liaison 'users_questions'
        Schema::dropIfExists('user_question');
    }
};
