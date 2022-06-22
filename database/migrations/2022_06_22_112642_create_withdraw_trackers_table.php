<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawTrackersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('withdraw_trackers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shops');
            $table->string('amount');
            $table->string('account_type');
            $table->string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('withdraw_trackers');
    }
}
