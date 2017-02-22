<?php

namespace App\Http\Controllers;

use App\Address as Address;
use App\Seller as Seller;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSeller;

use Illuminate\Http\Response as Response;

class SellersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json( Seller::all() );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSeller  $request
     * @return Response
     */
    public function store( StoreSeller $request )
    {
        $attributes = $request->all();
        $seller = Seller::create( $attributes );
        return Response::json( $seller );
    }

    /**
     * Display the specified resource.
     *
     * @param  Seller $seller
     * @return Seller
     */
    public function show( Seller $seller )
    {
        return $seller;
    }

    /**
     * Update every attribute of the specified resource in storage.
     *
     * @param  StoreSeller  $request
     * @param  Seller $seller
     * @return Seller
     */
    public function update( StoreSeller $request, Seller $seller )
    {
        $attributes = $request->all();
        $seller->update( $attributes );
        return $seller;
    }

    /**
     * Update some or every attribute of the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Seller $seller
     * @return Seller
     */
    public function partialUpdate( Request $request, Seller $seller )
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

    /**
     * @param Request $request
     * @param Seller $seller
     * @return mixed
     */
    public function setAddress( Request $request, Seller $seller )
    {
      $attributes = $request->all();
      $attributes[ 'seller_id' ] = $seller->getKey();

      $address = Address::create( $attributes );

      return $address;
    }

    /**
     * @param Request $request
     * @param Seller $seller
     * @return mixed
     */
    public function updateAddress( Request $request, Seller $seller )
    {
      $seller_id = $seller->getKey();

      $attributes = $request->all();

      $address = Address::where( 'seller_id', $seller_id );
      $address = $address->update( $attributes );

      return $address;
    }
}
