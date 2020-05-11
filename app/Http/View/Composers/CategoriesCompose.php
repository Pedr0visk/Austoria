<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Product;

class CategoriesCompose
{
    public function compose(View $view)
    {
        $view->with('categories', Product::categories());
    }
}
