<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_code')->unique();
            $table->string('item_name');
            $table->string('description');
            $table->integer('price');
            $table->string('currency');
            $table->string('unit_of_measurement');
            $table->string('image_link');
            $table->boolean('availability');
            $table->string('manufacturer_tramp');
            $table->integer('unique_identifier')->unique();
            $table->integer('id_group');
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
        Schema::dropIfExists('products');
    }
}
