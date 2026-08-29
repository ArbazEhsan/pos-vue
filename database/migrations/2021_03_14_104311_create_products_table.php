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
            $table->string('name');
            $table->integer('user_id');
            $table->string('barcode');
            $table->integer('cat_id')->nullable();
            $table->integer('purchase');
            $table->integer('whole_sale')->nullable();
            $table->integer('retail')->nullable();
            $table->integer('status');
            $table->decimal('qty', 6, 1)->nullable();
            $table->integer('min_qty')->nullable();
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
