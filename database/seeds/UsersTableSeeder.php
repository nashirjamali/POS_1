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
                'username' => 'admin',
                'role' => 'admin',
                'email'     => 'admin@pos.id',
                'password'  => Hash::make('admin123'),
            ],
            [
                'name' => 'kasir',
                'username' => 'kasir',
                'role' => 'kasir',
                'email'     => 'kasir@pos.id',
                'password'  => Hash::make('kasir123'),
            ]
        ]);
    }
}
