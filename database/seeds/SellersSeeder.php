<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SellersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory( 'App\Seller', 2 )->create();
    }
}
