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
        Schema::create('employee_salary', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id');
            $table->double('gross', null, 2, false);
            $table->double('basic', null, 2, false);
            $table->double('house_rent', null, 2, false)->nullable();
            $table->double('medical', null, 2, false)->nullable();
            $table->double('conveyance', null, 2, false)->nullable();
            $table->double('allowance', null, 2, false)->nullable();
            $table->double('TA', null, 2, false)->nullable();
            $table->double('mobile', null, 2, false)->nullable();
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
        Schema::dropIfExists('employee_salary');
    }
};
