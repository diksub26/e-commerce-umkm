<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmkmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('name', 100)->unique();
            $table->string('no_telp', 20)->unique();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->char('province_id', 2)->constrained('indonesia_provinces')->onUpdate('cascade')->onDelete('restrict');
            $table->char('city_id', 4)->constrained('indonesia_cities')->onUpdate('cascade')->onDelete('restrict');
            $table->char('district_id', 7)->constrained('indonesia_districts')->onUpdate('cascade')->onDelete('restrict');
            $table->char('village_id', 10)->constrained('indonesia_villages')->onUpdate('cascade')->onDelete('restrict');
            $table->string('rekening_number', 50)->nullable();
            $table->string('umkm_pic', 60)->nullable();
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
        Schema::dropIfExists('umkm');
    }
}
