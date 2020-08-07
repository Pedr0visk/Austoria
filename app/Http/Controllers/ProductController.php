<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()->with('category')->orderBy('name');

        $categories = Category::all();

        $products = $products->paginate();

        return view('products.index')
            ->withProducts($products)
            ->withCategories($categories);
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $products = Product::query()->with('category');

        if ($name = request()->name) {
            $products->where('name', 'ILIKE', '%' . strtolower($name) . '%');
        }

        if ($category = request()->category) {
            $products->where('category_id', $category);
        }

        $products = $products->paginate();

        return view('products.search')
            ->withCategories($categories)
            ->withProducts($products);
    }

    public function store()
    {
        $product = Product::create($this->validateRequest());

        return redirect('/products');
    }

    public function edit(Product $product)
    {
        return view('products.edit')
            ->withProduct($product);
    }

    public function update(Product $product)
    {
        $product->update($this->validateRequest());

        return redirect('/products')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/products')->with('success', 'Produto deletado com sucesso');
    }

    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'nullable',
        ]);
    }
}
