<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\PartiallyUpdateProduct;
use App\Product;
use App\Seller;
use App\Tag;
use Illuminate\Support\Facades\DB;
use Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::json(Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreProduct $request )
    {
        $attributes = $request->all();
        $product = Product::create( $attributes );

        $tags = $attributes[ 'tags' ];

        foreach ( $tags as $tag )
        {
          $tag =
            Tag::where( 'name', $tag )->get()->first()
            ? Tag::where( 'name', $tag )->get()->first()
            : Tag::create( array( 'name' => $tag ) );

          $product->tags()->save( $tag );
        }

        return Response::json( $product );
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return \App\Product
     */
    public function show( Product $product )
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreProduct  $request
     * @param  \App\Product
     * @return \App\Product
     */
    public function update( StoreProduct $request, Product $product )
    {
      $attributes = $request->all();
      $product->update( $attributes );

      $tags = $attributes[ 'tags' ];

      foreach ( $tags as $key => $val )
      {
        $tag =
          Tag::where( 'name', $val )->get()->first()
          ? Tag::where( 'name', $val )->get()->first()
          : Tag::create( array( 'name' => $val ) );

        $tags[ $key ] = $tag->id;
      }

      $product->tags()->sync( $tags );

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

      $tags = $request->get( 'tags' );

      if ( ! is_null( $tags ) )
      {
        foreach ( $tags as $key => $val )
        {
          $tag =
            Tag::where( 'name', $val )->get()->first()
            ? Tag::where( 'name', $val )->get()->first()
            : Tag::create( array( 'name' => $val ) );

          $tags[ $key ] = $tag->id;
        }

        $product->tags()->sync( $tags );
      }

      return Response::json( $product );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product
     * @return \Illuminate\Http\Response
     */
    public function destroy( Product $product )
    {
        $product->delete();
        return Response::json([], 200);
    }

    /**
     * @param Product $product
     * @return Response
     */
    public function getSeller( Product $product )
    {
      $seller_id = $product->seller_id;
      $seller = Seller::find( $seller_id );

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
}
