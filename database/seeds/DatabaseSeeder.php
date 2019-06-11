<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SuppliersTableSeeder::class);
        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(ProductUnitsTableSeeder::class);
        $this->call(ProductItemsTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(StocksTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
    }
}
