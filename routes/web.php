<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\NewsController;

Route::get('/', [NewsController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('news', NewsController::class)->except(['index']);
});

// Publiek profiel zonder login
Route::get('/users/{user}', function (User $user) {
    return view('profile.show', ['user' => $user]);
})->name('profile.show');

require __DIR__.'/auth.php';

// FAQ route voor bezoekers
Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index'])->name('faq.index');

// Admin routes (later voor beheer)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('faq-categories', App\Http\Controllers\Admin\FaqController::class);
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() {
        $users = \App\Models\User::all();
        return view('admin.dashboard', compact('users'));
    })->name('dashboard');
});

// Contact routes
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');