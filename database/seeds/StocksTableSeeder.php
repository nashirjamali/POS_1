<?php

use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->insert([
            [
                'shop_id' => 1,
                'product_item_code' => 'SM001',
                'stock' => 10
            ],
            [
                'shop_id' => 1,
                'product_item_code' => 'XM001',
                'stock' => 20
            ],
            [
                'shop_id' => 1,
                'product_item_code' => 'INF001',
                'stock' => 5
            ],
        ]);
    }
}
