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
        $catServ = App\Models\Category::create(['name' => 'Serviço']);
        $catProd = App\Models\Category::create(['name' => 'Produto']);

        factory(App\Models\Product::class)->create([
            'name'          => 'Corte de cabelo',
            'category_id'   => $catServ->name,
            'price'         => 30.00
        ]);

        factory(App\Models\Product::class)->create([
            'name'          => 'Barba',
            'category_id'   => $catServ->name,
            'price'         => 15.70
        ]);

        factory(App\Models\Product::class)->create([
            'name'          => 'Gel',
            'category_id'   => $catProd->name,
            'price'         => 15.70
        ]);



    }
}
