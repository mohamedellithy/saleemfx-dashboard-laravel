<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectrixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directrixes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required();
            $table->longText('description')->required();
            $table->integer('allow')->default(0)->comment('0 -> disallow to view and download , 1 -> allow to view and download');
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
        Schema::dropIfExists('directrixes');
    }
}
