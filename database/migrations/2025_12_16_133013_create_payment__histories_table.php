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
        Schema::create('payment__histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('phone', length:20);
            $table->text('address');
            $table->string('payslip_image', length:255)->nullable();
            $table->string('payment_method', length:255);
            $table->string('order_code', length:50);
            $table->integer('total_amount');
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
        Schema::dropIfExists('payment__histories');
    }
};
