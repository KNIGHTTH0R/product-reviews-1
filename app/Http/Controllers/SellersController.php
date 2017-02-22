<?php

namespace App\Http\Controllers;

use App\Address as Address;
use App\Seller as Seller;

use Illuminate\Http\Request as Request;
use App\Http\Requests\StoreSeller as StoreSeller;

use Response as Response;

class SellersController extends Controller
{

    /**
     * @return Response
     */
    public function index()
    {
        return Response::json( Seller::all() );
    }

    /**
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
     * @param  Seller $seller
     * @return Seller
     */
    public function show( Seller $seller )
    {
        return $seller;
    }

    /**
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
