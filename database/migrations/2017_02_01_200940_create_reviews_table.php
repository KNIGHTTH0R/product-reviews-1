<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('reviews', function ( Blueprint $table ) {
        $table->increments('id');
        $table->string('reviewer_name');
        $table->string('title');
        $table->text('content');
        $table->timestamps();
      });

      Schema::table('reviews', function( Blueprint $table ) {
        $table->integer('product_id')->unsigned();
        $table->foreign('product_id')
          ->references('id')
          ->on('products')
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
        Schema::dropIfExists('reviews');
    }
}
