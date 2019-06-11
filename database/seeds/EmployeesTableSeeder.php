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
                'job_title' => 'admin',
                'address' => 'Jl. Surabaya',
                'telephone' => '0895335182297'
            ]
        ]);

        DB::table('users')->insert([
            [
                'employee_id' => '1',
                'name' => 'Nashir Jamali',
                'level' => 'admin',
                'username' => 'nashirjamali',
                'password'  => Hash::make('admin123'),
            ]
        ]);
    }
}
