<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define( \App\Tag::class, function ( Faker\Generator $faker ) {
  return [ 'name' => $faker->word ];
});

$factory->define( \App\Address::class, function ( Faker\Generator $faker ) {
  return [
    'zip_code' => $faker->postcode,
    'address' => $faker->address,
    'state' => $faker->state,
    'country' => $faker->country,
    'city' => $faker->city,
  ];
});

$factory->define( \App\Review::class, function ( Faker\Generator $faker ) {
  $products = App\Product::pluck( 'id' )->all();
  return [
    'product_id' => $faker->randomElement( $products ),
    'reviewer_name' => $faker->name( $gender = null ),
    'title' => $faker->sentence( $nbWords = 4, $variableNbWords = true ),
    'content' => $faker->text(),
  ];
});

$factory->define( \App\Seller::class, function ( Faker\Generator $faker ) {
  $addresses = App\Address::pluck( 'id' )->all();
  return [
    'address_id' => $faker->randomElement( $addresses ),
    'name' => $faker->word,
    'last_name' => $faker->word,
  ];
});

$factory->define( \App\Product::class, function ( Faker\Generator $faker ) {
  $sellers = App\Seller::pluck( 'id' )->all();

  return [
    'seller_id' => $faker->randomElement( $sellers ),
    'name' => $faker->word,
    'price' => $faker->randomFloat(2, 1, 1000),
    'description' => $faker->text()
  ];
});
