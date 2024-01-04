<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('homepage');
    }

    return view('welcome');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin-quiz', function () {
        return view('admin-quiz');
    })->name('admin-quiz');
    Route::post('/admin-quiz', [QuizController::class, 'store'])->name('admin-quiz');

    Route::get('/admin-result-quiz', function () {
        return view('admin-result-quiz');
    })->name('admin-result-quiz');
    Route::get('/admin-all-user', function () {
        return view('admin-all-user');
    })->name('admin-all-user');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/homepage', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin-quiz');
        }
        return view('homepage');
    })->name('homepage');

    Route::get('/quiz', [QuizController::class, 'showQuiz'])->name('show.quiz');

    Route::get('/review/{id}', [QuizController::class, 'showReview'])->name('review.show');
    Route::get('/result/{id}', [QuizController::class, 'showResult'])->name('result.show');
    Route::post('/save-result', [QuizController::class, 'saveResult'])->name('save.result');

    Route::get('/leaderboard', [QuizController::class, 'getLeaderboard'])->name('leaderboard');

});

require __DIR__.'/auth.php';
