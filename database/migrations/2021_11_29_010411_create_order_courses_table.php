<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;
class CreateOrderCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_courses', function (Blueprint $table) {
            $wordpress = DB::connection('wordpress')->getDatabaseName();
            $table->id();
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')->on(new Expression($wordpress . '.wp_posts'))->onDelete('SET NULL');
            $table->string('firstname')->required();
            $table->string('lastname')->required();
            $table->string('email')->required();
            $table->string('phone')->required();
            $table->string('telegram_number')->nullable();
            $table->string('payed_status')->default(0);
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
        Schema::dropIfExists('order_courses');
    }
}
