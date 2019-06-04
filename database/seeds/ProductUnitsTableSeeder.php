<?php

use Illuminate\Database\Seeder;

class ProductUnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_units')->insert([
            [
                'name' => 'Pcs',
            ],
            [
                'name' => 'Kartu',
            ]
        ]);
    }
}
