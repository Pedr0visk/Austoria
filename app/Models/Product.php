<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function path()
    {
        return '/products/' . $this->id;
    }

    public static function categories() {
        return Category::all();
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
