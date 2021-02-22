<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable = ['order_id', 'card_owner', 'status', 'method', 'card_number', 'notes'];

  // One to One between Orders and Payments tables
  public function order() {
    return $this->belongsTo('App\Order');
  }
}
