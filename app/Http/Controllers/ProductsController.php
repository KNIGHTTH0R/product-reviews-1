<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $attributes = $request->all();
        $product = Product::create( $attributes );
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
}
