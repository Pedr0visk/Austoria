<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
   public function store()
   {
      $item = Item::create($this->validateRequest());
      
      return redirect($item->path());
   }

   public function update(Item $item)
   {
      $item->update($this->validateRequest());

      return redirect($item->path());
   }

   public function destroy(Item $item)
   {
      $item->delete();

      return redirect('/items');
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
