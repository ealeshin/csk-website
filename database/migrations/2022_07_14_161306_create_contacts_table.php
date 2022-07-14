<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('office_name');
            $table->string('office_type')->nullable();
            $table->string('phone_main');
            $table->string('phone_add')->nullable();
            $table->string('email');
            $table->string('address');
            $table->string('work_hours')->nullable();
            $table->string('days_off')->nullable();
            $table->string('map', 512)->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
