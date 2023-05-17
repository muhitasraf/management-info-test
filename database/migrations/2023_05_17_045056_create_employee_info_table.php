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
        Schema::create('employee_info', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('designation',50);
            $table->string('department',150);
            $table->string('code',150)->nullable();
            $table->string('father',150)->nullable();
            $table->string('mother',150)->nullable();
            $table->string('spouse',150)->nullable();
            $table->integer('no_of_child')->nullable();
            $table->string('present_address',150)->nullable();
            $table->string('permanent_address',150)->nullable();
            $table->string('personal_mobile',50)->nullable();
            $table->string('office_mobile',50)->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('employee_info');
    }
};
