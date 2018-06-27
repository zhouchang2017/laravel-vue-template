<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('procurement_plan_id')->comment('采购计划id');
            $table->integer('total_price')->unsigned()->default(0)->comment('采购总价');
            $table->integer('total_pcs')->unsigned()->default(0)->comment('采购总数量');
            $table->integer('able_price')->unsigned()->default(0)->comment('应付款');
            $table->integer('already_price')->unsigned()->default(0)->comment('已付款');
            $table->enum('procurement_status', [ 'part_finished', 'pending', 'sending', 'finished', 'cancel' ])->comment('采购状态');
            $table->enum('payment_status', [ 'unpaid', 'paid', 'part_paid', 'cancel' ])->comment('付款状态');
            $table->timestamp('procurement_at')->nullable()->comment('采购日期');
            $table->timestamp('arrived_at')->nullable()->comment('到货日期');
            $table->timestamp('pre_arrived_at')->nullable()->comment('预计到货日期');
            $table->json('shipment')->nullable()->comment('物流信息');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procurements');
    }
}
