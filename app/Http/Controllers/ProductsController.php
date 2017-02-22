<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
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

        $requestTags = $attributes[ 'tags' ];
        unset( $attributes[ 'tags' ] );

        $tags = array();

        foreach ( $requestTags as $key => $val )
        {

          $tag =
            Tag::where( 'name', '=', $val )
              ? Tag::where( 'name', '=', $val )->get()->first()
              : null;

          if ( is_null( $tag ) )
          {
            $tag = Tag::create( array( 'name' => $val ) );
          }

          array_push( $tags, $tag );
        }

        $product = Product::create( $attributes );

        foreach ( $tags as $tag )
        {
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product
     * @return \App\Product
     */
    public function update( Request $request, Product $product )
    {
        $attributes = $request->all();
        $product->update( $attributes );
        return $product;
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
}
