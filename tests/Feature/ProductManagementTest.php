<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_product_can_be_added()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/products', $this->data());

        $product = Product::first();

        $this->assertCount(1, Product::all());
        $response->assertRedirect('/products');

    }

    /** @test */
    public function a_name_is_required()
    {
        $response = $this->post('/products', array_merge($this->data(), ['name' => '']));

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_price_is_required()
    {
        $response = $this->post('/products', array_merge($this->data(), ['price' => '']));

        $response->assertSessionHasErrors('price');
    }

    /** @test disabled */
    // public function a_product_can_be_updated()
    // {
    //     $this->post('/products', $this->data());

    //     $product = Product::first();

    //     $response = $this->patch($product->path(), [
    //         'name' => 'Gel',
    //         'price' => 20.00,
    //         'category_id' => 'produto',
    //     ]);

    //     $this->assertEquals('Gel', Product::first()->fresh()->name);
    //     $this->assertCount(2, Category::all());

    //     $response->assertRedirect('/products');
    // }

    /** @test */
    public function a_product_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/products', $this->data());

        $product = Product::first();

        $response = $this->delete($product->path());

        $this->assertCount(0, Product::all());
        $response->assertRedirect('/products');

    }

    /** @test */
    public function a_new_category_is_automatically_added()
    {
        $response = $this->post('/products', $this->data());

        $product = Product::first();
        $category = Category::first();

        $this->assertCount(1, Category::all());
        $this->assertEquals($category->id, $product->category_id);
    }


    private function data()
    {
        return [
            'name' => 'Corte',
            'category_id' => 'Service',
            'barcode' => null,
            'price' => 30.00
        ];
    }
}
