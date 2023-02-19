<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('created_user_id');
            $table->string('name',200);
            $table->string('barcode',20)->unique();
            $table->string('brand',200);
            $table->unsignedBigInteger('category_id');
            $table->double('vat');
            $table->double('price');
            $table->double('unit_price');

            $table->foreign('created_user_id')->references('id')->on('tbl_users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('tbl_product_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_products');
    }
};
