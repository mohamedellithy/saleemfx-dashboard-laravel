<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inviter_id');
            $table->foreign('inviter_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('code_affiliate')->required();
            $table->integer('employee')->default(0)->comment('0 -> not-employee , 1 -> employee');
            $table->integer('status')->default(1)->comment('1 -> working , 0 -> stopped');
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
        Schema::dropIfExists('affiliates');
    }
}
