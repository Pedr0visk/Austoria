<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Product;

class ProductTest extends TestCase
{
   use RefreshDatabase;
   /**
    * A basic test example.
    *
    * @return void
    */
   
   /** @test */
   public function method_update_works()
   {
      $product = Product::create(['name' => 'corte', 'price' => 30.00, 'category_id' => 'service']);

      $product->update(['name' => 'loção', 'price' => 20.00, 'category_id' => 'product']);

      $this->assertCount(1, Product::all());
      $this->assertEquals('loção', Product::first()->name);
   }
}
