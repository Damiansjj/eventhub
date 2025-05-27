<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FaqCategory extends Model
{
    protected $fillable = [
        'name',
        'slug', 
        'description',
        'sort_order',
        'is_active'
    ];

    public function faqItems(): HasMany
    {
        return $this->hasMany(FaqItem::class)->where('is_active', true)->orderBy('sort_order');
    }
}