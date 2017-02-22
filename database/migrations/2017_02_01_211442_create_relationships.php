<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('products', function ( Blueprint $table ) {
        $table->integer('seller_id')->unsigned();
      });

      Schema::table('reviews', function( Blueprint $table ) {
        $table->integer('product_id')->unsigned();
        $table->foreign('product_id')
          ->references('id')
          ->on('products')
          ->onDelete('cascade');
      });

//      Schema::table('sellers', function ( Blueprint $table ) {
//        $table->integer('address_id')->unsigned()->nulleable();
//        $table->foreign('address_id')
//          ->references('id')
//          ->on('addresses')
//          ->onDelete('cascade');
//      });

      Schema::table('addresses', function( Blueprint $table ) {
        $table->integer( 'seller_id' )->unsigned()->nulleable();
        $table->foreign( 'seller_id' )
          ->references( 'id' )
          ->on( 'sellers' )
          ->onDelete( 'cascade' );
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
