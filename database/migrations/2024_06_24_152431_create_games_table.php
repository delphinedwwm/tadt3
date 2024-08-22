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
        Schema::create('games', function (Blueprint $table) {
            // $table->id();
            // Utilise user_id comme clé primaire et clé étrangère
            $table->unsignedBigInteger('user_id')->primary();
            $table->integer('points');
            $table->string('status')->default('in_progress'); // État de la partie : in_progress, paused, completed
            $table->timestamps();
            
            // Contrainte de clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
