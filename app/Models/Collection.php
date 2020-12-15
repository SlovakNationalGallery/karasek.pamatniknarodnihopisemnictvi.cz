<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Collection extends Model
{
    use CrudTrait, HasFactory, HasSlug, HasTimestamps;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'content',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function save(array $options = [])
    {
        if ($this->category === null) {
            $this->category = $this->title;
        }

        return parent::save($options);
    }
}
