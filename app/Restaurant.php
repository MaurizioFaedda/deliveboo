<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
  protected $fillable = ['restaurant_name', 'city', 'address'];
}

public function user() {
  return $this->hasOne('App\Restaurant');
}
