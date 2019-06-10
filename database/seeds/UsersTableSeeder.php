<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'level' => 'admin',
                'username' => 'admin',
                'password'  => Hash::make('admin123'),
            ],
            [
                'name' => 'kasir',
                'level' => 'kasir',
                'username' => 'kasir',
                'password'  => Hash::make('kasir123'),
            ]
        ]);
    }
}
