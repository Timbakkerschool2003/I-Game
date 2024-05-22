<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IgameController extends Controller
{
    public function index()
    {
        // Initial data
        $data = [
            'customer_orders' => 100,
            'backorder' => 0,
            'costs' => 0,
            'incoming_delivery' => 100,
            'inventory' => 400,
            'outgoing_delivery' => 100,
            'week' => 1,
        ];

        // Initialize results array in session
        Session::put('results', []);

        return view('igame', $data);
    }

    public function update(Request $request)
    {
        $customer_orders = $request->input('customer_orders', 100);
        $backorder = $request->input('backorder', 0);
        $incoming_delivery = $request->input('incoming_delivery', 100);
        $inventory = $request->input('inventory', 400);
        $outgoing_delivery = $request->input('outgoing_delivery', 100);
        $extra_order = $request->input('extra_order', 0);
        $week = $request->input('week', 1);

        // Retrieve results from session
        $results = Session::get('results', []);

        // Update logic
        $total_inventory = $inventory + $incoming_delivery;
        $total_orders = $customer_orders + $backorder;

        $available_for_delivery = min($total_inventory, $total_orders);
        $new_inventory = $total_inventory - $available_for_delivery;
        $new_backorder = max(0, $total_orders - $available_for_delivery);
        $new_outgoing_delivery = $available_for_delivery;
        $new_costs = ($new_inventory * 0.50) + ($new_backorder * 1.00);

        // Store results for the week
        $results[] = [
            'week' => $week,
            'extra_order' => $extra_order,
            'customer_orders' => $customer_orders,
            'backorder' => $backorder,
            'costs' => $new_costs,
            'incoming_delivery' => $incoming_delivery,
            'inventory' => $new_inventory,
            'outgoing_delivery' => $new_outgoing_delivery,
        ];

        // Store results back in session
        Session::put('results', $results);

        // Prepare data for next week
        $data = [
            'customer_orders' => rand(80, 120), // Random new customer orders for next week
            'backorder' => $new_backorder,
            'costs' => $new_costs,
            'incoming_delivery' => $extra_order,
            'inventory' => $new_inventory,
            'outgoing_delivery' => $new_outgoing_delivery,
            'week' => $week + 1,
            'results' => $results,
        ];

        return view('igame', $data);
    }

    public function results()
    {
        // Retrieve results from session
        $results = Session::get('results', []);

        return view('results', ['results' => $results]);
    }

    public function reset()
    {
        // Clear the session data
        Session::forget('results');

        return redirect()->route('igame.index');
    }
}
