<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FaqItem extends Model
{
    protected $fillable = [
        'faq_category_id',
        'question',
        'answer', 
        'sort_order',
        'is_active'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }
}