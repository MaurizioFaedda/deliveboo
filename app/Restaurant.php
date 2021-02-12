<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
  protected $fillable = ['restaurant_name', 'city', 'address', 'user_id'];

  // One to One between Restaurants and Users tables
  public function user() {
    return $this->hasMany('App\Restaurant');
  }

  // One to Many between Restaurants and Dishes tables
  public function dish() {
    return $this->hasMany('App\Dish');
  }
}
