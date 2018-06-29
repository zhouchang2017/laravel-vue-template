<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManualliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuallies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('入库经办人');
            $table->unsignedInteger('warehouse_id')->comment('入库id');
            $table->text('description')->nullable()->comment('手工入库描述');
            $table->enum('status',['uncommitted','pending','finished','cancel']);
            $table->json('history')->default(null)->nullable()->comment('审核记录');
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
        Schema::dropIfExists('manuallies');
    }
}
