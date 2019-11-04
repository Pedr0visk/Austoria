<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
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
