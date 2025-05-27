<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
      'name',
        'email',
        'password',
        'is_admin',
        'username',
        'birthday',
        'profile_photo',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'birthday' => 'date',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->is_admin;
    }

    /**
     * Make user admin
     */
    public function makeAdmin()
    {
        $this->update(['is_admin' => true]);
    }

   /**
     * Remove admin rights
     */
    public function removeAdmin()
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
        return $this->where('username', $value)->firstOrFail();
    }
}