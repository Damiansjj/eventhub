<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'birthday',
        'about_me',
        'profile_photo',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birthday' => 'date',
        'is_admin' => 'boolean',
    ];

    /**
     * Check if the user is an admin
     */
    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    /**
     * Make user admin
     */
    public function makeAdmin(): void
    {
        $this->update(['is_admin' => true]);
    }

    /**
     * Remove admin rights
     */
    public function removeAdmin(): void
    {
        $this->update(['is_admin' => false]);
    }

    /**
     * Get the user's display name (username or name)
     */
    public function getDisplayNameAttribute()
    {
        return $this->username ?: $this->name;
    }

    /**
     * Get the user's profile photo URL
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo) {
            return Storage::url($this->profile_photo);
        }
        
        // Default avatar using Gravatar or placeholder
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->display_name) . '&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get the user's age
     */
    public function getAgeAttribute()
    {
        if (!$this->birthday) {
            return null;
        }
        
        return $this->birthday->age;
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Resolve route bindings to use username instead of ID
     */
    public function resolveRouteBinding($value, $field = null)
    {
        // First try to find by username
        $user = $this->where('username', $value)->first();
        
        // If not found by username, try to find by ID
        if (!$user) {
            $user = $this->where('id', $value)->first();
        }
        
        // If still not found, throw 404
        if (!$user) {
            abort(404);
        }
        
        return $user;
    }

    /**
     * Get the events created by the user
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Get the events the user is registered for
     */
    public function registeredEvents(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)
            ->withTimestamps()
            ->withPivot('registered_at');
    }
}