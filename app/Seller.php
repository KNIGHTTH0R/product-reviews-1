<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{

  protected $fillable = [ 'name', 'last_name', 'address_id' ];

  public function products()
  {
    return $this->hasMany('App\Product');
  }
}
