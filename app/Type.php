<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
  protected $fillable = ['type'];

  // Many to Many between Restaurants and Types tables
  public function restaurants() {
    return $this->belongsToMany('App\Restaurant');
  }
}
