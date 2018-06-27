<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariantInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variant_info', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_variant_id')->nullable();
//            $table->foreign('product_variant_id')->references('id')->on('product_variants');
            // Weights and stuff
            $table->decimal('length_value', 10, 5)->default(0.00)->unsigned();
            $table->string('length_unit')->default('MM');

            $table->decimal('height_value', 10, 5)->default(0.00)->unsigned();
            $table->string('height_unit')->default('MM');

            $table->decimal('width_value', 10, 5)->default(0.00)->unsigned();
            $table->string('width_unit')->default('MM');

            $table->decimal('weight_value', 10, 5)->default(0.00)->unsigned();
            $table->string('weight_unit')->default('GR');

            // Package
            $table->decimal('package_length_value', 10, 5)->default(0.00)->unsigned();
            $table->string('package_length_unit')->default('MM');

            $table->decimal('package_height_value', 10, 5)->default(0.00)->unsigned();
            $table->string('package_height_unit')->default('MM');

            $table->decimal('package_width_value', 10, 5)->default(0.00)->unsigned();
            $table->string('package_width_unit')->default('MM');

            $table->decimal('package_weight_value', 10, 5)->default(0.00)->unsigned();
            $table->string('package_weight_unit')->default('GR');
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
        Schema::dropIfExists('product_variant_info');
    }
}
