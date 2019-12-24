<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = App\Models\Category::create(['name' => 'Serviço']);
        factory(App\Models\Product::class, 5)->create(['category_id' => $cat->name]);

        $cat = App\Models\Category::create(['name' => 'Produto']);
        factory(App\Models\Product::class, 5)->create(['category_id' => $cat->name]);
    }
}
