<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\User;
use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Sla contactbericht op
        $contactMessage = ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Stuur email naar alle admins
        $admins = User::where('is_admin', true)->get();
        
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new ContactFormMail($contactMessage));
        }

        return redirect()->route('contact.index')
            ->with('success', 'Bedankt voor je bericht! We nemen zo snel mogelijk contact met je op.');
    }
}