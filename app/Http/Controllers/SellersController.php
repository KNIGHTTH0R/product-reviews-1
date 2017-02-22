<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use Response;

class SellersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::json( Seller::all() );
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
        $seller = Seller::create( $attributes );
        return Response::json( $seller );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seller
     * @return \App\Seller
     */
    public function show( Seller $seller )
    {
        return $seller;
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
     * @param  \App\Seller $seller
     * @return \App\Seller
     */
    public function update( Request $request, Seller $seller )
    {
        $attributes = $request->all();
        $seller->update( $attributes );
        return $seller;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy( Seller $seller )
    {
        $seller->delete();
        return Response::json( [], 200 );
    }
}
