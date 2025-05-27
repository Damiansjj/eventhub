<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'related_event_id',
        'is_read',
        'replied_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'replied_at' => 'datetime',
    ];

    /**
     * Get the event this message is related to.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'related_event_id');
    }

    /**
     * Mark the message as read.
     */
    public function markAsRead(): bool
    {
        return $this->update(['is_read' => true]);
    }

    /**
     * Mark the message as replied.
     */
    public function markAsReplied(): bool
    {
        return $this->update(['replied_at' => now()]);
    }
}