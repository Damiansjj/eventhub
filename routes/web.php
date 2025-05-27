<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\NewsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
      Route::resource('news', NewsController::class)->except(['index']);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 👤 Publiek profiel tonen (zonder login)
Route::get('/users/{user}', function (User $user) {
    return view('profile.show', ['user' => $user]);
})->name('profile.show');

require __DIR__.'/auth.php';
Route::resource('news', NewsController::class);
Route::get('/', [NewsController::class, 'index']);