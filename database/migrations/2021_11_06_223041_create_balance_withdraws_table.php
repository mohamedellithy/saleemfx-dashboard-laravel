<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;
class CreateBalanceWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_withdraws', function (Blueprint $table) {
            $table->id();
            $table->integer('withdrawable_id');
            $table->string('withdrawable_type');
            $table->decimal('withdraw_value',10,2)->required();
            $table->string('wallet_account')->nullable();
            $table->string('wallet')->nullable();
            $table->integer('status')->default(1)->comment('0 -> pending , 1 -> accepted , 2 -> refused ');
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
        Schema::dropIfExists('balance_withdraws');
    }
}
