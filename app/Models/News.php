<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    // Zorg dat Laravel published_at als datetime behandelt
    protected $dates = ['published_at'];

}
