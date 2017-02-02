<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      factory( 'App\Tag', 5 )->create();

      $products_ids = DB::table( 'products' )->pluck( 'id' )->all();
      $tags_ids = DB::table( 'tags' )->pluck( 'id' )->all();

      for ( $i = 0; $i < 2; $i++ ) {

        foreach ( $products_ids as $productId ) {
          DB::table( 'product_tag' )->insert(
            [
              'product_id' => $productId,
              'tag_id' => $tags_ids[ array_rand( $tags_ids ) ] // TODO
            ]
          );
        }

      }

    }
}
