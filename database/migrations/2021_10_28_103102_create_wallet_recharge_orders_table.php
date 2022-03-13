<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;
class CreateWalletRechargeOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('wallet_recharge_orders', function (Blueprint $table) {
            $wordpress = DB::connection('wordpress')->getDatabaseName();
            $table->id();
            $table->integer('payment_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on(new Expression($wordpress . '.wp_posts'))->onDelete('set null');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('value')->required();
            $table->string('transaction_no')->nullable();
            $table->longText('notice')->nullable();
            $table->integer('status')->default(0)->comments('0 -> pending , 1 -> accepted , 2 -> refused ');
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
        Schema::dropIfExists('wallet_recharge_orders');
    }
}
