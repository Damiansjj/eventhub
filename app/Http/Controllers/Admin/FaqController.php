<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use App\Models\FaqItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = FaqCategory::with('faqItems')
            ->orderBy('sort_order')
            ->get();

        return view('admin.faq.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = true;

        FaqCategory::create($validated);

        return redirect()->route('admin.faq-categories.index')
            ->with('success', 'FAQ categorie succesvol aangemaakt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaqCategory $faqCategory)
    {
        return view('admin.faq.edit', ['category' => $faqCategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FaqCategory $faqCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        $faqCategory->update($validated);

        return redirect()->route('admin.faq-categories.index')
            ->with('success', 'FAQ categorie succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        return redirect()->route('admin.faq-categories.index')
            ->with('success', 'FAQ categorie succesvol verwijderd!');
    }

    /**
     * Show form for creating a new FAQ item in a category
     */
    public function createItem(FaqCategory $faqCategory)
    {
        return view('admin.faq.create-item', compact('faqCategory'));
    }

    /**
     * Store a new FAQ item in a category
     */
    public function storeItem(Request $request, FaqCategory $faqCategory)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'required|integer|min:0',
        ]);

        $validated['is_active'] = true;
        $validated['faq_category_id'] = $faqCategory->id;

        FaqItem::create($validated);

        return redirect()->route('admin.faq-categories.index')
            ->with('success', 'FAQ vraag succesvol toegevoegd!');
    }

    /**
     * Show form for editing an FAQ item
     */
    public function editItem(FaqItem $faqItem)
    {
        return view('admin.faq.edit-item', compact('faqItem'));
    }

    /**
     * Update an FAQ item
     */
    public function updateItem(Request $request, FaqItem $faqItem)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $faqItem->update($validated);

        return redirect()->route('admin.faq-categories.index')
            ->with('success', 'FAQ vraag succesvol bijgewerkt!');
    }

    /**
     * Delete an FAQ item
     */
    public function destroyItem(FaqItem $faqItem)
    {
        $faqItem->delete();

        return redirect()->route('admin.faq-categories.index')
            ->with('success', 'FAQ vraag succesvol verwijderd!');
    }
}
