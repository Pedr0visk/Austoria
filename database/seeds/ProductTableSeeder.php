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

        factory(App\Models\Product::class)->create([
            'name'          => 'Corte de cabelo',
            'category_id'   => $cat->name,
            'price'         => 30.00
        ]);

        factory(App\Models\Product::class)->create([
            'name'          => 'Barba',
            'category_id'   => $cat->name,
            'price'         => 15.70
        ]);

        $cat = App\Models\Category::create(['name' => 'Produto']);
        factory(App\Models\Product::class, 5)->create(['category_id' => $cat->name]);

        factory(App\Models\Product::class, 5)->create(['category_id' => $cat->name]);
    }
}
