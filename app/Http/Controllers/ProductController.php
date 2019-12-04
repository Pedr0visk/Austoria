<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()->with('category');
        $categories = Category::all();

        if ($name = request()->name) {
            $products->where('name', 'like', '%' . $name . '%');
        }

        if ($category = request()->category) {
            $products->where('category_id', $category);
        }

        if ($min_price = request()->min_price) {
            $products->where('price', '>=', $min_price);
        }

        if ($max_price = request()->max_price) {
            $products->where('price', '<=', $max_price);
        }
        
        $products = $products->paginate();

        return view('products.index')
            ->withProducts($products)
            ->withCategories($categories);
    }

    public function store()
    {
        $product = Product::create($this->validateRequest());
        
        return redirect($product->path());
    }
    
    public function update(Product $product)
    {
        $product->update($this->validateRequest());
        
        return redirect($product->path());
    }
    
    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect('/products');
    }
    
    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'nullable'
        ]);
    }
}
