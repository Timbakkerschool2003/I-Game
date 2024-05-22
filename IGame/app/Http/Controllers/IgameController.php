<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IgameController extends Controller
{
    public function index()
    {
        // Initiële data
        $data = [
            'customer_orders' => 100,
            'backorder' => 0,
            'costs' => 200,
            'incoming_delivery' => 100,
            'inventory' => 400,
            'outgoing_delivery' => 100,
            'week' => 1,
        ];

        return view('igame', $data);
    }

    public function update(Request $request)
    {
        $customer_orders = $request->input('customer_orders', 100);
        $backorder = $request->input('backorder', 0);
        $costs = $request->input('costs', 200);
        $incoming_delivery = $request->input('incoming_delivery', 100);
        $inventory = $request->input('inventory', 400);
        $outgoing_delivery = $request->input('outgoing_delivery', 100);
        $extra_order = $request->input('extra_order', 0);
        $week = $request->input('week', 1);

        if ($week >= 24) {
            return view('igame', [
                'customer_orders' => $customer_orders,
                'backorder' => $backorder,
                'costs' => $costs,
                'incoming_delivery' => $incoming_delivery,
                'inventory' => $inventory,
                'outgoing_delivery' => $outgoing_delivery,
                'week' => $week,
            ]);
        }

        // Update logica
        $new_incoming_delivery = $incoming_delivery + $extra_order;
        $new_inventory = $inventory + $new_incoming_delivery - $customer_orders;
        $new_backorder = max(0, $customer_orders - $new_inventory);

        if ($new_inventory < 0) {
            $new_inventory = 0;
        }

        $new_costs = ($new_inventory * 0.50) + ($new_backorder * 1.00);

        // Verhoog de week
        $week += 1;

        $data = [
            'customer_orders' => $customer_orders,
            'backorder' => $new_backorder,
            'costs' => $new_costs,
            'incoming_delivery' => $new_incoming_delivery,
            'inventory' => $new_inventory,
            'outgoing_delivery' => $outgoing_delivery,
            'week' => $week,
        ];

        return view('igame', $data);
    }
}
