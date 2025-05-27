<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the events.
     */
    public function index()
    {
        $query = Event::query();

        // Als de gebruiker een admin is, toon alle evenementen
        if (Auth::check() && Auth::user()->isAdmin()) {
            $events = $query->orderBy('start_date')->paginate(12);
        } else {
            // Voor normale gebruikers, alleen gepubliceerde evenementen tonen
            $events = $query->where('is_published', true)
                ->orderBy('start_date')
                ->paginate(12);
        }

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|max:2048',
            'max_participants' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'category' => 'required|max:255',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        $validated['is_published'] = true;
        $event = auth()->user()->events()->create($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Evenement succesvol aangemaakt!');
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        // Alleen admins kunnen ongepubliceerde evenementen zien
        if (!$event->is_published && (!Auth::check() || !Auth::user()->isAdmin())) {
            abort(404);
        }

        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'location' => 'required|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'image' => 'nullable|image|max:2048',
            'max_participants' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'category' => 'required|max:255',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path;
        }

        $event->update($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Evenement succesvol bijgewerkt!');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Evenement succesvol verwijderd!');
    }
} 