<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $faker = Faker::create();

      factory( 'App\Product', 6 )->create();

      $sellers_ids = DB::table( 'sellers' )->pluck( 'id' )->all();

      foreach ( $sellers_ids as $seller_id ) {

        for ( $i = 0; $i < 3; $i++ ) {

          $product = App\Product::find( $i * $seller_id );

          if ( $product ) {
            $product->seller_id = $seller_id;
            $product->save();
          }

        }

      }


    }
}
