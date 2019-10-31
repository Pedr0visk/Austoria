<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Item;

class ItemManagementTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   public function a_item_can_be_added()
   {
      $response = $this->post('/items', $this->data()); 

      $item = Item::first();

      $this->assertCount(1, Item::all());
      $response->assertRedirect($item->fresh()->path());

   }

   /** @test */
   public function a_name_is_required()
   {
      $response = $this->post('/items', array_merge($this->data(), ['name' => '']));

      $response->assertSessionHasErrors('name');
   }

   /** @test */
   public function a_price_is_required()
   {
      $response = $this->post('/items', array_merge($this->data(), ['price' => '']));

      $response->assertSessionHasErrors('price');
   }

   /** @test */
   public function a_item_can_be_updated()
   {
      $this->post('/items', $this->data());

      $item = Item::first(); 

      $response = $this->patch($item->path(), [
         'name' => 'Gel',
         'price' => 20.00,
         'category_id' => 'item',
      ]);
      
      $this->assertEquals('Gel', Item::first()->name);
      $this->assertEquals('item', Item::first()->category_id);

      $response->assertRedirect($item->fresh()->path());
   }

   /** @test */
   public function a_item_can_be_deleted()
   {
      $this->withoutExceptionHandling();

      $response = $this->post('/items', $this->data()); 

      $item = Item::first();

      $response = $this->delete($item->path());

      $this->assertCount(0, Item::all());
      $response->assertRedirect('/items');

   }

   private function data() 
   {
      return [
         'name' => 'Corte',
         'category_id' => 'servico',
         'barcode' => null,
         'price' => 30.00
      ];
   }
}
