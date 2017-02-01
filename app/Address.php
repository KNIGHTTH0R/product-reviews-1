<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  public function seller()
  {
    return $this->belongsTo('App\Seller');
  }
}
