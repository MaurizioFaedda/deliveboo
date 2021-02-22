<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = ['restaurant_id', 'email', 'delivery_time', 'total_price', 'mobile', 'first_name', 'lastname', 'address', 'notes'];

  // One to Many between Restaurants and Orders tables
  public function restaurant() {
    return $this->belongsTo('App\Restaurant');
  }
}
