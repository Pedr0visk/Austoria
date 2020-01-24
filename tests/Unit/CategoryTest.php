<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class Categorytest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_category_was_added()
    {
        Category::create([
            'name' => 'Servico'
        ]);

        $this->assertCount(1, Category::all());
    }
}
