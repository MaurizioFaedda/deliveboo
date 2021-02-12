<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
  protected $fillable = ['name', 'infos', 'visible', 'price', 'restaurant_id'];

  // One to Many between Restaurants and Dishes tables
  public function restaurant() {
    return $this->belongsTo('App\Restaurant');
  }
}
