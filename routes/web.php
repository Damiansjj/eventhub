<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\EventController as AdminEventController;

// Admin routes (only accessible to admin users)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/', function() {
        $stats = [
            'users' => \App\Models\User::count(),
            'news' => \App\Models\News::count(),
            'events' => \App\Models\Event::count(),
            'messages' => \App\Models\ContactMessage::count(),
        ];
        
        $latestUsers = \App\Models\User::latest()->take(5)->get();
        $latestNews = \App\Models\News::latest()->take(5)->get();
        $latestEvents = \App\Models\Event::latest()->take(5)->get();
        $unreadMessages = \App\Models\ContactMessage::where('is_read', false)->count();
        
        return view('admin.dashboard', compact('stats', 'latestUsers', 'latestNews', 'latestEvents', 'unreadMessages'));
    })->name('dashboard');
    
    // User management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::patch('users/{id}/toggle-admin', [\App\Http\Controllers\Admin\UserController::class, 'toggleAdmin'])->name('users.toggle-admin');
    
    // News management
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
    
    // FAQ management
    Route::resource('faq-categories', App\Http\Controllers\Admin\FaqController::class);
    
    // FAQ item management
    Route::get('faq-categories/{faqCategory}/items/create', [App\Http\Controllers\Admin\FaqController::class, 'createItem'])->name('faq-categories.create-item');
    Route::post('faq-categories/{faqCategory}/items', [App\Http\Controllers\Admin\FaqController::class, 'storeItem'])->name('faq-categories.store-item');
    Route::get('faq-items/{faqItem}/edit', [App\Http\Controllers\Admin\FaqController::class, 'editItem'])->name('faq-items.edit');
    Route::put('faq-items/{faqItem}', [App\Http\Controllers\Admin\FaqController::class, 'updateItem'])->name('faq-items.update');
    Route::delete('faq-items/{faqItem}', [App\Http\Controllers\Admin\FaqController::class, 'destroyItem'])->name('faq-items.destroy');

    // Event management
    Route::resource('events', AdminEventController::class);
});

// Auth routes (Laravel Breeze)
require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Laravel Breeze default profile routes (settings/account management)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Public profile management (different from account settings)
    Route::get('/profile/public/edit', [App\Http\Controllers\ProfileController::class, 'editPublic'])->name('profiles.edit');
    Route::patch('/profile/public/update', [App\Http\Controllers\ProfileController::class, 'updatePublic'])->name('profiles.update');
    Route::delete('/profile/photo', [App\Http\Controllers\ProfileController::class, 'removePhoto'])->name('profiles.remove-photo');
});

// Root route
Route::get('/', function () {
    return redirect()->route('news.index');
});

// Public routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index'])->name('faq.index');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
Route::get('/profiles', [App\Http\Controllers\ProfileController::class, 'index'])->name('profiles.index');
Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profiles.show');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// News comments
Route::post('/news/{news}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');