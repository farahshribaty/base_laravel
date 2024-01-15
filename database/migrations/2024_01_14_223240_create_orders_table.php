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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->string('payment_method');
            $table->string('payment_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->decimal('order_total', 8, 2);
            $table->json('totals')->nullable();
            $table->json('items')->nullable();
            $table->string('order_status')->nullable();
            $table->dateTime('created_at')->nullable()->change();
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
        Schema::dropIfExists('orders');
    }
};
