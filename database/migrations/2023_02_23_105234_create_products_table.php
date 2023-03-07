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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_slug');
            $table->integer('product_price');
            $table->integer('product_quantity');
            $table->string('product_image');
            $table->string('Category_name');
            $table->string('SubCategory_name');
            $table->integer('Category_id');
            $table->integer('SubCategory_id');
            $table->text('short_description');
            $table->text('long_description');
            $table->string('product_status');
            $table->timestamps();
            $table->softDeletes();
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
