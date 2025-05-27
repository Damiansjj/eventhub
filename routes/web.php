<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\NewsController;

// Homepage (News index)
Route::get('/', [NewsController::class, 'index']);

// FAQ route voor bezoekers
Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index'])->name('faq.index');

// Contact routes
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Public profile routes (accessible to everyone)
Route::get('/profiles', [App\Http\Controllers\ProfileController::class, 'index'])->name('profiles.index');
Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profiles.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Laravel Breeze default profile routes (settings/account management)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // News management (except index which is public)
    Route::resource('news', NewsController::class)->except(['index']);
});

Route::middleware('auth')->group(function () {
    // Public profile management (different from account settings)
    Route::get('/profile/public/edit', [App\Http\Controllers\ProfileController::class, 'editPublic'])->name('profiles.edit');
    Route::patch('/profile/public/update', [App\Http\Controllers\ProfileController::class, 'updatePublic'])->name('profiles.update');
    Route::delete('/profile/photo', [App\Http\Controllers\ProfileController::class, 'removePhoto'])->name('profiles.remove-photo');
});
// Admin routes (only accessible to admin users)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/', function() {
        $users = \App\Models\User::all();
        return view('admin.dashboard', compact('users'));
    })->name('dashboard');
    
    // FAQ management
    Route::resource('faq-categories', App\Http\Controllers\Admin\FaqController::class);
});

// Auth routes (Laravel Breeze)
require __DIR__.'/auth.php';