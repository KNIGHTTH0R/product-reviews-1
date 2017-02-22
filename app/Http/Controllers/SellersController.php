<?php

namespace App\Http\Controllers;

use App\Address as Address;
use App\Seller as Seller;

use Illuminate\Http\Request as Request;
use App\Http\Requests\StoreSeller as StoreSeller;
use App\Http\Requests\StoreAddress as StoreAddress;

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
     * @param StoreSeller $request
     * @return Response
     */
    public function store( StoreSeller $request )
    {
        $attributes = $request->all();
        $seller = Seller::create( $attributes );

        return Response::json( $seller );
    }

    /**
     * @param Seller $seller
     * @return Seller
     */
    public function show( Seller $seller )
    {
        return $seller;
    }

    /**
     * @param StoreSeller $request
     * @param Seller $seller
     * @return Seller
     */
    public function update( StoreSeller $request, Seller $seller )
    {
        $attributes = $request->all();
        $seller->update( $attributes );

        return $seller;
    }

    /**
     * @param Request $request
     * @param Seller $seller
     * @return Seller
     */
    public function partiallyUpdate( Request $request, Seller $seller )
    {
        $attributes = $request->all();
        $seller->update( $attributes );

        return $seller;
    }

    /**
     * @param Seller $seller
     * @return Response
     */
    public function destroy( Seller $seller )
    {
        $seller->delete();

        return Response::json( [], 200 );
    }

    /**
     * @param Seller $seller
     * @return Response
     */
    public function getAddress( Seller $seller )
    {
      $address = $seller->address;

      return Response::json( $address );
    }

    /**
     * @param StoreAddress $request
     * @param Seller $seller
     * @return Response
     */
    public function setAddress( StoreAddress $request, Seller $seller )
    {
      $attributes = $request->all();
      $address = new Address( $attributes );

      $seller->address()->save( $address );

      return Response::json( $seller );
    }

    /**
     * @param StoreAddress $request
     * @param Seller $seller
     * @return Response
     */
    public function updateAddress( StoreAddress $request, Seller $seller )
    {
      $attributes = $request->all();
      $seller->address->update( $attributes );

      return Response::json( $seller );
    }
}
