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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')->nullable();
            $table->integer('customer')->nullable();
            $table->integer('unit')->nullable();
            $table->float('qty',8,3,false)->nullable();
            $table->double('unit_price',null,3,false)->nullable();
            $table->double('total_price',null,3,false)->nullable();
            $table->double('booked_amt',null,3,false)->nullable();
            $table->double('down_payment',null,3,false)->nullable();
            $table->double('remaining_amt',null,3,false)->nullable();
            $table->date('registration_date')->nullable();
            $table->integer('installment')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('no_of_install')->nullable();
            $table->integer('pre_month_install')->nullable();
            $table->date('pay_install_date')->nullable();
            $table->string('mutation_type',150)->nullable();
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
        Schema::dropIfExists('registrations');
    }
};
