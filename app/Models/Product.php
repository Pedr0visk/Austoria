<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/products/' . $this->id;
    }

    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::firstOrCreate([
            'name' => $category
        ])->id;
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
