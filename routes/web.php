<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionAnswerController;
   
Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('questionsanswers', QuestionAnswerController::class);
});

// Route::group(['middleware' => ['auth']], function() {
//     // Routes for UserController
//     Route::get('users', [UserController::class, 'index'])->name('users.index');
//     Route::get('users/show/{id}', [UserController::class, 'show'])->name('users.show');
    
//     Route::get('users/create', [UserController::class, 'create'])->name('users.create');
//     Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    
//     Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
//     Route::post('users/update/{id}', [UserController::class, 'update'])->name('users.update');
    
//     Route::get('users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
//     Route::delete('users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
//     // Routes for RoleController
//     Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
//     Route::get('roles/show/{id}', [RoleController::class, 'show'])->name('roles.show');
    
//     Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
//     Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
    
//     Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
//     Route::post('roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    
//     Route::get('roles/delete/{id}', [RoleController::class, 'delete'])->name('roles.delete');
//     Route::delete('roles/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    
//     // Routes for CategoryController
//     Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
//     Route::get('categories/show/{id}', [CategoryController::class, 'show'])->name('categories.show');
    
//     Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
//     Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    
//     Route::get('categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
//     Route::post('categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    
//     Route::get('categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
//     Route::delete('categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

//     // Routes for QuestionAnswerController
//     Route::get('questionanswer', [QuestionAnswerController::class, 'index'])->name('questionsanswers.index');
//     Route::get('questionanswer/show/{id}', [QuestionAnswerController::class, 'show'])->name('questionsanswers.show');
    
//     Route::get('questionanswer/create', [QuestionAnswerController::class, 'create'])->name('questionsanswers.create');
//     Route::post('questionanswer/store', [QuestionAnswerController::class, 'store'])->name('questionanswer.store');
    
//     Route::get('questionanswer/edit/{id}', [QuestionAnswerController::class, 'edit'])->name('questionsanswers.edit');
//     Route::post('questionanswer/update/{id}', [QuestionAnswerController::class, 'update'])->name('questionanswer.update');
    
//     Route::get('questionanswer/delete/{id}', [QuestionAnswerController::class, 'delete'])->name('questionanswer.delete');
//     Route::delete('questionanswer/destroy/{id}', [QuestionAnswerController::class, 'destroy'])->name('questionsanswers.destroy');
// });
