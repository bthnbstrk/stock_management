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
        Schema::create('tbl_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('created_user_id');
            $table->unsignedBigInteger('customer_id')->index();;
            $table->unsignedTinyInteger('status')->default(1); // 1 Accepted 2 Preparing 3 On Way 4 Delivered 5 Returned
            $table->date('delivery_date');
            $table->float('total_vat')->nullable();
            $table->float('total_price_without_vat')->nullable();
            $table->float('bill_price')->nullable();

            $table->foreign('created_user_id')->references('id')->on('tbl_users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('tbl_customers')->onUpdate('cascade')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_orders');
    }
};
