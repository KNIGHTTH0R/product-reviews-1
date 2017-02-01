<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  public function reviews()
  {
    return $this->hasMany('App\Review');
  }

  public function seller()
  {
    return $this->hasOne('App\Seller');
  }

  public function tags()
  {
    return $this->belongsToMany('App\Tag');
  }
}
