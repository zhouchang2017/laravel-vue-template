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
        // $this->call(UsersTableSeeder::class);
        $this->call(ProductTypeTableSeeder::class);
        $this->call(AttributeGroupTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(BalanceTableSeeder::class);
        $this->call(PaymentTableSeeder::class);
        $this->call(WarehouseTypeSeeder::class);
    }
}
