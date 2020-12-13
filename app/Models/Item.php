<?php

namespace App\Models;

use ElasticScoutDriverPlus\CustomSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Item extends Model
{
    use CustomSearch, HasFactory, Searchable;

    public $incrementing = false;

    protected $connection = 'webumenia';

    public function searchableAs()
    {
        return config('scout.prefix') . 'items_cs';
    }
}
