<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->uuid('id')->primary();
            $table->uuid('umkm_id')->constrained('umkm')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('category_id')->unsigned()->nullable()->default(null);
            $table->string('name', 100)->nullable()->default(null);  
            $table->string('price', 100)->nullable()->default(null);  
            $table->text('description')->nullable()->default(null); 
            $table->string('size', 50)->nullable()->default('-');
            $table->string('weight', 50)->nullable()->default(null);  
            $table->char('unit_weight', 4)->default('gr');
            $table->string('pic_1', 40)->nullable()->default(null);
            $table->string('pic_2', 40)->nullable()->default(null);
            $table->string('pic_3', 40)->nullable()->default(null);
            $table->boolean('is_discount')->nullable()->default(false);
            $table->char('discount', 4)->default(null);
            $table->uuid('updated_by')->nullable()->default(null);
            $table->uuid('created_by')->nullable()->default(null);
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
        Schema::dropIfExists('products');
    }
}
