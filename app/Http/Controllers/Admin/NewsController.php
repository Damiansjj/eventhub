<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('author')
            ->latest()
            ->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $news = new News([
            'title' => $validated['title'],
            'slug' => News::generateSlug($validated['title']),
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'],
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->is_published ? ($validated['published_at'] ?? now()) : null,
            'author_id' => auth()->id(),
        ]);

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('news-images', 'public');
            $news->featured_image = $path;
        }

        $news->save();

        return redirect()->route('admin.news.index')
            ->with('success', 'Nieuwsartikel succesvol aangemaakt!');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($news->title !== $validated['title']) {
            $news->slug = News::generateSlug($validated['title']);
        }

        $news->fill([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'excerpt' => $validated['excerpt'],
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->is_published ? ($validated['published_at'] ?? $news->published_at ?? now()) : null,
        ]);

        if ($request->hasFile('featured_image')) {
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }
            
            $path = $request->file('featured_image')->store('news-images', 'public');
            $news->featured_image = $path;
        }

        $news->save();

        return redirect()->route('admin.news.index')
            ->with('success', 'Nieuwsartikel succesvol bijgewerkt!');
    }

    public function destroy(News $news)
    {
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Nieuwsartikel succesvol verwijderd!');
    }
} 