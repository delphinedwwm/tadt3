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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable(); // nullable pour permettre des catégories sans logo
            $table->text('name');
            $table->text('type');
            $table->timestamps();
            /** ne pas oublier l'ajout du logo ds une colonne voir space tourism pour la gestion de l'image   */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
