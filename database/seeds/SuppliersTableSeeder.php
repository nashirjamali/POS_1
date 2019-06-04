<?php

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'Nashir Jamali',
                'telephone' => '0895335192297',
                'address' => 'Jl. Raya Kedung Baruk',
                'description' => 'Nam pulvinar interdum turpis a mattis. Etiam augue leo, mollis a massa sagittis, egestas pretium risus. Aliquam auctor nibh mauris, at fringilla elit lobortis sodales. Praesent volutpat felis et placerat elementum.'
            ],
            [
                'name' => 'PT. Sumber Rakyat',
                'telephone' => '031777777',
                'address' => 'Jl. Undaan No. 8 Surabaya',
                'description' => 'Nam pulvinar interdum turpis a mattis. Etiam augue leo, mollis a massa sagittis, egestas pretium risus. Aliquam auctor nibh mauris, at fringilla elit lobortis sodales. Praesent volutpat felis et placerat elementum.'
            ]
        ]);
    }
}
