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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('zone_number');
            $table->string('city', 500)->nullable();
            $table->string('street', 500)->nullable();
            $table->string('building_number', 500)->nullable();
            $table->string('address_additional_information', 500)->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('address_name')->nullable();
            $table->string('floor')->nullable();
            $table->string('apartment')->nullable();
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade');
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
        Schema::dropIfExists('user_addresses');
    }
};
