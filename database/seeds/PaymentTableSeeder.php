<?php

use Illuminate\Database\Seeder;

class PaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            ['name'=>'现金'] ,
            ['name'=>'银行转账'] ,
            ['name'=>'PayPal'] ,
            ['name'=>'支付宝'] ,
        ]);
    }
}
