<?php

namespace App\Http\Controllers;

use App\Product as Product;
use App\Seller as Seller;
use App\Tag as Tag;
use App\Review as Review;

use App\Http\Requests\StoreProduct as StoreProduct;
use App\Http\Requests\PartiallyUpdateProduct as PartiallyUpdateProduct;
use App\Http\Requests\StoreReview as StoreReview;

use Response as Response;

class ProductsController extends Controller
{

    /**
     * @return Response
     */
    public function index()
    {
        return Response::json( Product::all() );
    }

    /**
     * @param StoreProduct $request
     * @return Response
     */
    public function store( StoreProduct $request )
    {
        $attributes = $request->all();
        $product = Product::create( $attributes );

        $tags = [];

        foreach ( $request->get( 'tags' ) as $tagName )
          $tags[] = Tag::firstOrCreate( ['name' => $tagName] );

        $tagsIds = collect( $tags )->pluck( 'id' );
        $product->tags()->sync( $tagsIds );

        return Response::json( $product );
    }

    /**
     * @param  Product  $product
     * @return Product
     */
    public function show( Product $product )
    {
        return $product;
    }

    /**
     * @param StoreProduct $request
     * @param Product
     * @return Product
     */
    public function update( StoreProduct $request, Product $product )
    {
      $attributes = $request->all();
      $product->update( $attributes );

      $tags = [];

      foreach ( $request->get( 'tags' ) as $tagName )
        $tags[] = Tag::firstOrCreate( ['name' => $tagName] );

      $tagsIds = collect( $tags )->pluck( 'id' );
      $product->tags()->sync( $tagsIds );

      return Response::json( $product );
    }

    /**
     * @param PartiallyUpdateProduct $request
     * @param Product $product
     * @return Response
     */
    public function partiallyUpdate( PartiallyUpdateProduct $request, Product $product )
    {
      $attributes = $request->all();
      $product->update( $attributes );

      if ( $request->has('tags') )
      {
        $tags = [];

        foreach ( $request->get('tags') as $tagName )
          $tags[] = Tag::firstOrCreate( ['name' => $tagName] );

        $tagsIds = collect( $tags )->pluck( 'id' );
        $product->tags()->sync( $tagsIds );
      }

      return Response::json( $product );
    }

    /**
     * @param Product
     * @return Response
     */
    public function destroy( Product $product )
    {
        $product->delete();

        return Response::json( [], 200 );
    }

    /**
     * @param Product $product
     * @return Response
     */
    public function getSeller( Product $product )
    {
      $seller = $product->seller;

      return Response::json( $seller );
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function getTags( Product $product )
    {
      $tags = $product->tags()->get();

      return Response::json( $tags );
    }

    /**
     * @param Product $product
     * @return Response
     */
    public function getReviews( Product $product )
    {
      $reviews = $product->reviews()->get();

      return Response::json( $reviews );
    }

    /**
     * @param StoreReview $request
     * @param Product $product
     * @return Response
     */
    public function storeReview( StoreReview $request, Product $product )
    {
      $attributes = $request->all();
      $review = new Review( $attributes );

      $product->reviews()->save( $review );

      return Response::json( $review );
    }

    /**
     * @param Product $product
     * @param Review $review
     * @return Response
     */
    public function destroyReview( Product $product, Review $review )
    {
      $review->delete();

      return Response::json( [], 200 );
    }
}
