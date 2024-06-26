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
        Schema::create('statistics', function (Blueprint $table) {
            // $table->id(); 
            // Utilise user_id comme clé primaire et clé étrangère
            $table->unsignedBigInteger('user_id')->primary();
            $table->timestamps();

            // Contrainte de clé étrangère
            // $table->primary('user_id');
            $table->foreign('user_id')->references('user_id')->on('games')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
