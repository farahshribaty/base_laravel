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
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->decimal('product_price', 8, 2);
            $table->integer('product_quantity');
            $table->string('product_status')->nullable();
            $table->string('product_main_image')->nullable();
            $table->integer('product_purchasing_count')->default(0);
            // $table->boolean('is_highlight')->default(false);
            // $table->boolean('is_active')->default(true);
            // $table->boolean('is_latest')->default(false);
            // $table->boolean('is_most_purchase')->default(false);
            // $table->dateTime('expired_date')->nullable();
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
