<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;
class CreateServicesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_orders', function (Blueprint $table) {
            $wordpress = DB::connection('wordpress')->getDatabaseName();
            $table->id();
            $table->bigInteger('account_id')->nullable()->unsigned();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on(new Expression($wordpress . '.wp_posts'))->onDelete('SET NULL');
            $table->decimal('value',10,2)->required();
            $table->timestamp('expire_at')->nullable();
            $table->integer('status')->default(0)->comment('0 -> pending , 1 -> accepted , 2 -> refused ');
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
        Schema::dropIfExists('services_orders');
    }
}
