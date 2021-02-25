<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Payment;

class PaymentsTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $payments = config('payments');

        foreach ($payments as $payment) {
            $new_payment_obj = new Payment();
            $new_payment_obj->order_id = $payment['order_id'];
            $new_payment_obj->card_owner = $payment['card_owner'];
            $new_payment_obj->status = $payment['status'];
            $new_payment_obj->method = $payment['method'];
            $new_payment_obj->card_number = $payment['card_number'];
            $new_payment_obj->notes = $payment['notes'];
            $new_payment_obj->save();
        }
    }
}
