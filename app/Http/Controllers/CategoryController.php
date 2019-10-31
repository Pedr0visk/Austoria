<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
   public function store()
   {
      Category::create(request()->only(['name']));
   }
}
