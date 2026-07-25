<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\GameManagementController;

Route::get('/', function () {
    return view('welcome');
});

//  METS Auth::routes() ICI, AVANT les autres routes
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware([])->group(function () {
    Route::get('/dashboard', function () {
        return view('components/dashboard');
    })->name('dashboard');
});

// routes pour tester le jeu (SANS auth pour l'instant)
Route::get('/games/test', [GameManagementController::class, 'testGame'])->name('games.test');
Route::get('games/showTest', [GameManagementController::class, 'submitAnswerTest'])->name('games.showTest');
Route::post('games/submitTest', [GameManagementController::class, 'submitAnswerTest'])->name('games.submitTest');
Route::post('/game/nextQuestionTest', [GameManagementController::class, 'nextQuestionTest'])->name('games.nextQuestionTest');

// TOUTES les autres routes dans le groupe auth
Route::group(['middleware' => ['auth']], function() {

    // Routes for UserController
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/show/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    Route::delete('users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Routes for RoleController
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/show/{id}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('roles/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
    Route::delete('roles/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Routes for CategoryController
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/show/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
    Route::delete('categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Routes for QuestionAnswerController
    Route::get('questionanswer', [QuestionAnswerController::class, 'index'])->name('questionsanswers.index');
    Route::get('questionanswer/show/{id}', [QuestionAnswerController::class, 'show'])->name('questionsanswers.show');
    Route::get('questionanswer/create', [QuestionAnswerController::class, 'create'])->name('questionsanswers.create');
    Route::post('questionanswer/store', [QuestionAnswerController::class, 'store'])->name('questionsanswers.store');
    Route::get('questionanswer/edit/{id}', [QuestionAnswerController::class, 'edit'])->name('questionsanswers.edit');
    Route::put('questionanswer/update/{id}', [QuestionAnswerController::class, 'update'])->name('questionsanswers.update');
    Route::get('questionanswer/delete/{id}', [QuestionAnswerController::class, 'delete'])->name('questionsanswers.delete');
    Route::delete('questionanswer/destroy/{id}', [QuestionAnswerController::class, 'destroy'])->name('questionsanswers.destroy');

    // Routes for Game
    Route::post('games/start', [GameManagementController::class, 'startGame'])->name('games.start');
    Route::get('/games/start', [GameManagementController::class, 'showQuestion'])->name('games.show');
    Route::get('games/show', [GameManagementController::class, 'showQuestion'])->name('games.show');
    Route::post('games/submit', [GameManagementController::class, 'submitAnswer'])->name('games.submit');
    Route::post('/game/nextQuestion', [GameManagementController::class, 'nextQuestion'])->name('games.nextQuestion');
    Route::get('games/stop', [GameManagementController::class, 'stopGame'])->name('games.stop');
    Route::get('/game/pause', [GameManagementController::class, 'pauseGame'])->name('games.pause');
    Route::get('games/resume', [GameManagementController::class, 'resumeGame'])->name('games.resume');
    Route::post('user-questions/record', [GameManagementController::class, 'recordUserQuestionInteraction'])->name('recordUserQuestionInteraction');
    Route::get('/app', [GameManagementController::class, 'someMethod'])->name('app');

});