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
        $cat = App\Models\Category::create(['name' => 'service']);
        factory(App\Models\Product::class, 100)->create(['category_id' => $cat->name]);

        $cat = App\Models\Category::create(['name' => 'product']);
        factory(App\Models\Product::class, 100)->create(['category_id' => $cat->name]);
    }
}
