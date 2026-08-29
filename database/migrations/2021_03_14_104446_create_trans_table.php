<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->integer('user_id');
            $table->integer('account_id');
            $table->integer('invoice_id')->nullable();
            $table->integer('amount');
            $table->integer('bill_no')->nullable();
            $table->string('type');
            $table->text('remarks')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('trans');
    }
}
