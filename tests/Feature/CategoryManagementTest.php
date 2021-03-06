<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class CategoryManagementTest extends TestCase 
{
    use RefreshDatabase;
    
    /** @test */
    public function a_cat_can_be_added()
    {
        $response = $this->post('/categories', ['name' => 'produto']);
        
        $this->assertCount(1, Category::all());
    }
}
