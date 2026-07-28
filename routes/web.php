<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\GameController; 
use App\Http\Controllers\StatisticController;

// ============================================
// ROUTES PUBLIQUES (sans authentification)
// ============================================

Route::get('/', function () {
    return view('welcome');
});

// Routes de test du jeu (accessibles SANS login)
Route::prefix('games')->group(function() {
    Route::get('/test', [GameController::class, 'testGame'])->name('games.test');
    Route::post('/submitTest', [GameController::class, 'submitAnswerTest'])->name('games.submitTest');
    Route::post('/nextQuestionTest', [GameController::class, 'nextQuestionTest'])->name('games.nextQuestionTest');
});

// ============================================
// ROUTES D'AUTHENTIFICATION
// ============================================

Auth::routes();

// ============================================
// ROUTES PROTÉGÉES (authentification requise)
// ============================================

Route::middleware(['auth'])->group(function() {

    // ---- HOME / DASHBOARD ----
    Route::get('/home', [StatisticController::class, 'index'])->name('home');  
    Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics.index');
    
    // ---- USERS ----
    Route::prefix('users')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('show/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('create', [UserController::class, 'create'])->name('users.create');
        Route::post('store', [UserController::class, 'store'])->name('users.store');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('users.delete');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // ---- ROLES ----
    Route::prefix('roles')->group(function() {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::get('show/{id}', [RoleController::class, 'show'])->name('roles.show');
        Route::get('create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('store', [RoleController::class, 'store'])->name('roles.store');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('update/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::get('delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
        Route::delete('destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });

    // ---- CATEGORIES ----
    Route::prefix('categories')->group(function() {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('show/{id}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // ---- QUESTIONS & ANSWERS ----
    Route::prefix('questionanswer')->group(function() {
        Route::get('/', [QuestionAnswerController::class, 'index'])->name('questionsanswers.index');
        Route::get('show/{id}', [QuestionAnswerController::class, 'show'])->name('questionsanswers.show');
        Route::get('create', [QuestionAnswerController::class, 'create'])->name('questionsanswers.create');
        Route::post('store', [QuestionAnswerController::class, 'store'])->name('questionsanswers.store');
        Route::get('edit/{id}', [QuestionAnswerController::class, 'edit'])->name('questionsanswers.edit');
        Route::put('update/{id}', [QuestionAnswerController::class, 'update'])->name('questionsanswers.update');
        Route::get('delete/{id}', [QuestionAnswerController::class, 'delete'])->name('questionsanswers.delete');
        Route::delete('destroy/{id}', [QuestionAnswerController::class, 'destroy'])->name('questionsanswers.destroy');
    });

    // GAMES - PARTIES AVEC AUTH - UTILISE GameController
    Route::prefix('games')->group(function() {
        Route::get('/start-options', [GameController::class, 'startOptions'])->name('games.startOptions');
        Route::post('/start', [GameController::class, 'start'])->name('games.start');
        Route::get('/{gameId}/question', [GameController::class, 'showQuestion'])->name('games.showQuestion');
        Route::post('/{gameId}/submit', [GameController::class, 'submitAnswer'])->name('games.submitAnswer');
        Route::get('/{gameId}/pause', [GameController::class, 'pauseGame'])->name('games.pause');
        Route::post('/{gameId}/resume', [GameController::class, 'resumeGame'])->name('games.resume');
        Route::post('/{gameId}/cancel', [GameController::class, 'cancelGame'])->name('games.cancel');
        Route::get('/{gameId}/summary', [GameController::class, 'summary'])->name('games.summary');
    });
});