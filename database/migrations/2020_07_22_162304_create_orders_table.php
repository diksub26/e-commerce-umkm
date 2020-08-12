<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->id();
            $table->uuid('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->uuid('umkm_id')->constrained('umkm')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('ongkir_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('ongkir_value', 50)->default('0');
            $table->char('district_id', 7)->constrained('indonesia_districts')->onUpdate('cascade')->onDelete('restrict');
            $table->char('village_id', 10)->constrained('indonesia_villages')->onUpdate('cascade')->onDelete('restrict');
            $table->text('address')->nullable();
            $table->char('postal_code', 10)->nullable();
            $table->char('payment_type', 1);
            $table->char('payment_code', 10);
            $table->string('payment_pic', 50);
            $table->char('discount', 4);
            $table->char('status', 1);
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
        Schema::dropIfExists('orders');
    }
}
