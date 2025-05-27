<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display news for homepage
     */
    public function index()
    {
        $news = News::published()
            ->latest()
            ->with('author')
            ->paginate(6);

        return view('news.index', compact('news'));
    }

    /**
     * Show individual news article
     */
    public function show(News $news)
    {
        // Check if published (unless user is admin or author)
        if (!$news->is_published && !$news->canEdit(Auth::user())) {
            abort(404);
        }

        // Increment views only if not admin and not author
        if (!Auth::check() || (!Auth::user()->isAdmin() && Auth::user()->id !== $news->author_id)) {
            $news->incrementViews();
        }

        // Get related news
        $relatedNews = News::published()
            ->where('id', '!=', $news->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }

    /**
     * Show admin news management
     */
    public function manage()
    {
        $this->authorize('admin');
        
        $news = News::with('author')
            ->latest('created_at')
            ->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show form for creating news
     */
    public function create()
    {
        $this->authorize('admin');
        return view('admin.news.create');
    }

    /**
     * Store new news article
     */
    public function store(Request $request)
    {
        $this->authorize('admin');

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $slug = News::generateSlug($request->title);

        $news = new News([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->is_published ? ($request->published_at ?: now()) : null,
            'author_id' => Auth::id(),
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('news-images', 'public');
            $news->featured_image = $path;
        }

        $news->save();

        return redirect()->route('admin.news.index')
            ->with('success', 'Nieuwsartikel succesvol aangemaakt!');
    }

    /**
     * Show form for editing news
     */
    public function edit(News $news)
    {
        $this->authorize('admin');
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update news article
     */
    public function update(Request $request, News $news)
    {
        $this->authorize('admin');

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Update slug if title changed
        if ($news->title !== $request->title) {
            $news->slug = News::generateSlug($request->title);
        }

        $news->fill([
            'title' => $request->title,
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->is_published ? ($request->published_at ?: $news->published_at ?: now()) : null,
        ]);

        // Handle new featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($news->featured_image) {
                Storage::delete($news->featured_image);
            }
            
            $path = $request->file('featured_image')->store('news-images', 'public');
            $news->featured_image = $path;
        }

        $news->save();

        return redirect()->route('admin.news.index')
            ->with('success', 'Nieuwsartikel succesvol bijgewerkt!');
    }

    /**
     * Delete news article
     */
    public function destroy(News $news)
    {
        $this->authorize('admin');

        // Delete featured image if exists
        if ($news->featured_image) {
            Storage::delete($news->featured_image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Nieuwsartikel succesvol verwijderd!');
    }

    /**
     * Toggle publish status
     */
    public function togglePublish(News $news)
    {
        $this->authorize('admin');

        $news->is_published = !$news->is_published;
        
        if ($news->is_published && !$news->published_at) {
            $news->published_at = now();
        }
        
        $news->save();

        $status = $news->is_published ? 'gepubliceerd' : 'als concept opgeslagen';
        
        return redirect()->back()
            ->with('success', "Artikel succesvol {$status}!");
    }

    /**
     * Authorization helper
     */
    private function authorize($ability)
    {
        if ($ability === 'admin' && (!Auth::check() || !Auth::user()->isAdmin())) {
            abort(403, 'Alleen admins kunnen nieuws beheren.');
        }
    }
}