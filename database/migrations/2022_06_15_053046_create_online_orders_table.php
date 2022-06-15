<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineOrdersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('online_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shops');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->integer('division_id');
            $table->integer('district_id');
            $table->integer('area_id');
            $table->string('zip_code');
            $table->string('address');
            $table->string('status', 5)->default("1");
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('online_orders');
    }
}
