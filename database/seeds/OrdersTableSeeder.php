<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Restaurant;
use Carbon\Carbon;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = config('orders');

        foreach ($orders as $order) {
            $new_order_obj = new Order();
            $new_order_obj->restaurant_id = $order['restaurant_id'];
            $new_order_obj->email = $order['email'];
            $new_order_obj->delivery_time = Carbon::parse($order['delivery_time'])->format('Y-m-d H:m');

            $new_order_obj->total_price = $order['total_price'];
            $new_order_obj->mobile = $order['mobile'];
            $new_order_obj->first_name = $order['first_name'];
            $new_order_obj->lastname = $order['lastname'];
            $new_order_obj->address = $order['address'];
            $new_order_obj->notes = $order['notes'];
            $new_order_obj->save();
        }
    }
}
