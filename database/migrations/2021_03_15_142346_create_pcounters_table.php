<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcounters', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->integer('user_id');
            $table->integer('bilty_no')->nullable();
            $table->string('ref')->nullable();
            $table->integer('cust_id');
            $table->integer('InvDiscount')->nullable();
            $table->integer('InvProfit')->nullable();
            $table->integer('received');
            $table->integer('remaining');
            $table->integer('finalVal');
            $table->integer('tax')->nullable();
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
        Schema::dropIfExists('pcounters');
    }
}
