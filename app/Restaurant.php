<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
  protected $fillable = ['restaurant_name', 'city', 'address', 'description', 'user_id', 'img_path_rest'];

  // One to Many between Restaurants and Users tables
  public function user() {
    return $this->hasMany('App\Restaurant');
  }

  // One to Many between Restaurants and Dishes tables
  public function dishes() {
    return $this->hasMany('App\Dish');
  }

  // Many to Many between Restaurants and Types tables
  public function types() {
    return $this->belongsToMany('App\Type');
  }

  // One to Many between Restaurants and Orders tables
  public function orders() {
    return $this->hasMany('App\Order');
  }
}
