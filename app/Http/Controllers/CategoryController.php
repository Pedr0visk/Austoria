<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate();

        return view('categories.index')->withCategories($categories);
    }

    public function store()
    {
        Category::create(request()->only(['name']));

        return redirect()->route('categories.index')
            ->with('success', 'Categoria criada com sucesso');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categoria deletada com sucesso');
    }
}
