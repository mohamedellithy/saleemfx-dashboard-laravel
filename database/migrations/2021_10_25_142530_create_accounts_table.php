<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('forex_company_id');
            $table->foreign('forex_company_id')->references('id')->on('forex_companies')->onDelete('cascade');
            $table->string('account_number')->required();
            $table->decimal('account_balance',10,2)->required();
            $table->integer('status')->default(0)->comments('0 -> pending , 1 -> accepted , 2 -> refused , 3 -> ended');
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
        Schema::dropIfExists('accounts');
    }
}
