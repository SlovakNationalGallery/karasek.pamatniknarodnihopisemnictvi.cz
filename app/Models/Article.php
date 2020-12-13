<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasTimestamps;

    protected $fillable = [
        'title',
        'slug',
        'perex',
        'content',
        'category',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class);
    }
}
