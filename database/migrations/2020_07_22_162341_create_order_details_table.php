<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->id();
            $table->foreignId('order_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->uuid('product_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('price', 50)->default('0');
            $table->integer('qty')->default(0);
            $table->integer('total_weight')->default(null);
            $table->char('weight_unit', 1)->default(null);
            $table->softDeletes();
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
        Schema::dropIfExists('order_details');
    }
}
