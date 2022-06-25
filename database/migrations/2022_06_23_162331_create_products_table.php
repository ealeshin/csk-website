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
            $table->string('code')->nullable();
            $table->string('barcode')->nullable();
            $table->string('brand')->nullable();
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->text('parameters')->nullable();
            $table->unsignedDecimal('price', 10, 2);
            $table->boolean('in_stock')->default(true);
            $table->boolean('active')->default(true);
            $table->unsignedSmallInteger('category_id')->nullable();
            $table->text('images')->nullable();
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
