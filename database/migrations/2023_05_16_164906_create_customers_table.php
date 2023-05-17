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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('nid',50)->nullable();
            $table->string('bin',50)->nullable();
            $table->string('present_address',150)->nullable();
            $table->string('permanent_address',150)->nullable();
            $table->string('mobile',50)->nullable();
            $table->string('mobile_1',50)->nullable();
            $table->date('DOB')->nullable();
            $table->string('father',150)->nullable();
            $table->string('mother',150)->nullable();
            $table->string('spouse',150)->nullable();
            $table->string('no_of_child',150)->nullable();
            $table->string('occupation',150)->nullable();
            $table->boolean('is_alive')->default(1);
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
        Schema::dropIfExists('customers');
    }
};
