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
            $table->integer('Код_товара')->unique();
            $table->string('Название_позиции');
            $table->string('Описание');
            $table->integer('Цена');
            $table->string('Валюта');
            $table->string('Единица_измерения');
            $table->string('Ссылка_изображения');
            $table->boolean('Наличие');
            $table->string('Производитель');
            $table->integer('Уникальный_идентификатор')->unique();
            $table->integer('Идентификатор_группы');
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
