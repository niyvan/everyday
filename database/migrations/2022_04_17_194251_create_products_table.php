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

//(`id`, `product_name`, `category_id`, `wholesale_price`, `retail_price`, `description`, `quantity`, `minimum_qt')
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name')->unique();
            $table->double('wholesale_price');
            $table->double('retail_price');
            $table->string('description')->nullable();
            $table->double('quantity')->default('0');
            $table->double('minimum_qty')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
};
