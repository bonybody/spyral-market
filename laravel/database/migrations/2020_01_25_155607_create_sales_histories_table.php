<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_id')->unsigned();
            $table->bigInteger('buyer_id')->unsigned();
            $table->bigInteger('seller_id')->unsigned();
            $table->timestamps();

            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');
            $table->foreign('buyer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('seller_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_histories');
    }
}
