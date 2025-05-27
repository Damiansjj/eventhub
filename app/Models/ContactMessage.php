<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_read',
        'replied_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'replied_at' => 'datetime',
    ];

    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    public function markAsReplied()
    {
        $this->update(['replied_at' => now()]);
    }
}