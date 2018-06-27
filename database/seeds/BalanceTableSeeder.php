<?php

use Illuminate\Database\Seeder;

class BalanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('balances')->insert([
           ['name'=>'货到付款'] ,
           ['name'=>'款到发货'] ,
           ['name'=>'快递代收'] ,
           ['name'=>'定期结算'] ,
        ]);
    }
}
