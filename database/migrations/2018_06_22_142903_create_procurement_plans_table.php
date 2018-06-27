<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurement_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->comment('采购编号');
            $table->unsignedInteger('warehouse_id')->comment('采购仓库');
            $table->unsignedInteger('user_id')->comment('采购单创建人');
            $table->text('description')->nullable()->comment('采购计划说明');
            $table->json('comment')->nullable()->comment('采购计划备注');
//            $table->unsignedInteger('checker_id')->comment('采购单审核人');
//            $table->timestamp('checked_at')->nullable()->comment('上一次审核时间');
            $table->json('history')->nullabel()->comment('审核记录');
            $table->enum('status',['uncommitted','pending','return','cancel','already'])->comment('采购计划状态');
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
        Schema::dropIfExists('procurement_plans');
    }
}
