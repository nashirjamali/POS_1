<?php

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            [
                'name' => 'Toko',
                'telephone' => '0311010101',
                'address' => 'Jl. Semampir Tengah',
                'description' => 'Toko utama penjualan barang'
            ],
            [
                'name' => 'Gudang',
                'telephone' => '0313289923',
                'address' => 'Jl. Kaliwaron',
                'description' => 'Gudang menyimpan persediaan barang'
            ],
        ]);
    }
}
