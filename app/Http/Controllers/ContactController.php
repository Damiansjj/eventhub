<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Sla het bericht op in de database
        $message = ContactMessage::create($validated);

        // Stuur e-mail naar admin
        Mail::to(config('mail.admin_address', 'admin@ehb.be'))
            ->send(new ContactFormMail($validated));

        return back()->with('success', 'Bedankt voor uw bericht! We nemen zo spoedig mogelijk contact met u op.');
    }
}