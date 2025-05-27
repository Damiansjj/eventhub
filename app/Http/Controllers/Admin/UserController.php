<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_admin' => ['boolean'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->boolean('is_admin', false),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Gebruiker succesvol aangemaakt!');
    }

    /**
     * Show the form for editing the user
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'is_admin' => ['boolean'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->is_admin = $request->boolean('is_admin');
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Gebruiker succesvol bijgewerkt!');
    }

    /**
     * Toggle admin status for a user
     */
    public function toggleAdmin($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->isAdmin()) {
            $user->removeAdmin();
            $message = "Admin rechten verwijderd voor {$user->name}";
        } else {
            $user->makeAdmin();
            $message = "{$user->name} is nu een admin";
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Delete the user
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Je kunt je eigen account niet verwijderen.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Gebruiker succesvol verwijderd!');
    }
} 