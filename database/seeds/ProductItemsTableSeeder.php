<?php

use Illuminate\Database\Seeder;

class ProductItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_items')->insert([
            [
                'code' => 'SM001',
                'name' => 'Samsung S10+',
                'category_id' => 1,
                'unit_id' => 1,
                'purchase_price' => 9500,
                'selling_price' => 10000
            ],
            [
                'code' => 'XM001',
                'name' => 'Xiaomi Note 5',
                'category_id' => 1,
                'unit_id' => 1,
                'purchase_price' => 9650,
                'selling_price' => 10750
            ],
            [
                'code' => 'INF001',
                'name' => 'Infinix Zero 4',
                'category_id' => 1,
                'unit_id' => 1,
                'purchase_price' => 9700,
                'selling_price' => 11000
            ]
        ]);
    }
}
