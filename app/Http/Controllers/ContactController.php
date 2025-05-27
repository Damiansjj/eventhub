<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Event;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        // Get upcoming events for the dropdown
        $events = Event::where('start_date', '>=', now())
            ->orderBy('start_date')
            ->get();

        return view('contact.index', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'related_event_id' => 'nullable|exists:events,id'
        ]);

        // If user is logged in, use their name and email
        if (Auth::check()) {
            $validated['name'] = Auth::user()->name;
            $validated['email'] = Auth::user()->email;
        }

        // Create the contact message
        $message = ContactMessage::create($validated);

        // Send email to admin
        Mail::to(config('mail.admin_address', 'admin@ehb.be'))
            ->send(new ContactFormMail($message));

        return back()->with('success', __('Bedankt voor je bericht! We nemen zo snel mogelijk contact met je op.'));
    }
}