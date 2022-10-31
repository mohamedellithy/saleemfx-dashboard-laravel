<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpireCashbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expire_cashbacks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('value', 10, 2)->required();
            $table->timestamps();
        });

        Schema::table('expire_cashbacks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expire_cashbacks');
    }
}
