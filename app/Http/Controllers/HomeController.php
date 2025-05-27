<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::published()
            ->latest()
            ->with('author')
            ->take(3)
            ->get();

        $events = Event::where('start_date', '>=', now())
            ->orderBy('start_date')
            ->take(3)
            ->get();

        return view('home', compact('news', 'events'));
    }
} 