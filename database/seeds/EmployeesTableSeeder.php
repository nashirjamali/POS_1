<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            [
                'name' => 'Nashir Jamali',
                'level' => 'admin',
                'username' => 'nashirjamali',
                'password' => 'admin123',
                'telephone' => '0895335182297',
                'address' => 'Jl. Surabaya'
            ]
        ]);
    }
}
