<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('customer');
            $table->integer('unit');
            $table->float('qty',8,3,false);
            $table->double('unit_price',null,3,false);
            $table->double('total_price',null,3,false);
            $table->double('booked_amt',null,3,false);
            $table->date('booked_date')->nullable();
            $table->double('remaining_amt',null,3,false)->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
