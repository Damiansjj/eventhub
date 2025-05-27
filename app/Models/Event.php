<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'start_date',
        'end_date',
        'image',
        'max_participants',
        'price',
        'category',
        'is_published',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'price' => 'decimal:2',
        'is_published' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the users registered for this event
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot('registered_at');
    }

    /**
     * Check if the event is full
     */
    public function isFull(): bool
    {
        if (!$this->max_participants) {
            return false;
        }

        return $this->participants()->count() >= $this->max_participants;
    }

    /**
     * Check if a user is registered for this event
     */
    public function isUserRegistered(User $user): bool
    {
        return $this->participants()->where('user_id', $user->id)->exists();
    }
} 