<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;

class CheckoutService
{
    public function process($cart, $user)
    {
        $orders = [];

        $grouped = $cart->items->groupBy(function ($item) {
            return $item->product->vendor_id;
        });

        foreach ($grouped as $vendorId => $items) {

            $total = 0;

            $order = Order::create([
                'user_id' => $user->id,
                'vendor_id' => $vendorId,
                'status' => 'completed',
                'total_amount' => 0
            ]);

            foreach ($items as $item) {

                $price = $item->product->price;
                $qty = $item->quantity;

                $total += $price * $qty;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $qty,
                    'price' => $price
                ]);

                // reduce stock
                $item->product->decrement('stock', $qty);
            }

            $order->update(['total_amount' => $total]);

            Payment::create([
                'order_id' => $order->id,
                'amount' => $total,
                'status' => 'paid'
            ]);

            $orders[] = $order;
        }

        return $orders;
    }
}