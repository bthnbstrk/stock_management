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
        Schema::create('tbl_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('created_user_id')->index();;
            $table->string('name',150);
            $table->string('surname',150);
            $table->string('delivery_address',3000);
            $table->string('email_address',250)->unique();
            $table->string('phone_number',50)->unique();

            $table->foreign('created_user_id')->references('id')->on('tbl_users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_customers');
    }
};
