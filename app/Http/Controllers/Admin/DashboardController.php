<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\News;
use App\Models\Event;
use App\Models\ContactMessage;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'news' => News::count(),
            'events' => Event::count(),
            'messages' => ContactMessage::count(),
            'faqs' => FaqCategory::withCount('faqItems')->get(),
        ];

        $latestUsers = User::latest()->take(5)->get();
        $latestMessages = ContactMessage::latest()->take(5)->get();
        $latestNews = News::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestUsers', 'latestMessages', 'latestNews'));
    }
} 