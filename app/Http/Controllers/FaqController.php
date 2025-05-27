<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::where('is_active', true)
            ->with('faqItems')
            ->orderBy('sort_order')
            ->get();

        return view('faq.index', compact('categories'));
    }
}