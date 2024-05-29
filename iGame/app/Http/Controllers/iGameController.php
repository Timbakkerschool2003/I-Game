<?php

// Declareer de namespace voor de controller
namespace App\Http\Controllers;

// Importeer de benodigde klassen
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// Definieer de IgameController klasse die de basis Controller uitbreidt
class IgameController extends Controller
{
    // Methode om de startpagina van het spel te tonen
    public function index()
    {
        // Initiële gegevens instellen
        $data = [
            'customer_orders' => 100, // Aantal klantbestellingen
            'backorder' => 0, // Aantal achterstanden
            'costs' => 0, // Kosten
            'incoming_delivery' => 100, // Inkomende leveringen
            'inventory' => 400, // Voorraad
            'outgoing_delivery' => 100, // Uitgaande leveringen
            'week' => 1, // Huidige week
        ];

        // Initialiseer een array voor de resultaten in de sessie
        Session::put('results', []);

        // Retourneer de 'igame' view met de initiële gegevens
        return view('igame', $data);
    }

    // Methode om de spelstatus bij te werken
    public function update(Request $request)
    {
        // Haal de gegevens uit het verzoek op, met standaardwaarden indien niet aanwezig
        $customer_orders = $request->input('customer_orders', 100);
        $backorder = $request->input('backorder', 0);
        $incoming_delivery = $request->input('incoming_delivery', 100);
        $inventory = $request->input('inventory', 400);
        $outgoing_delivery = $request->input('outgoing_delivery', 100);
        $extra_order = $request->input('extra_order', 0);
        $week = $request->input('week', 1);

        // Haal de resultaten uit de sessie op
        $results = Session::get('results', []);

        // Logica om de spelstatus bij te werken
        $total_inventory = $inventory + $incoming_delivery;
        $total_orders = $customer_orders + $backorder;

        $available_for_delivery = min($total_inventory, $total_orders); // Bereken de beschikbare voorraad voor levering
        $new_inventory = $total_inventory - $available_for_delivery; // Bereken de nieuwe voorraad
        $new_backorder = max(0, $total_orders - $available_for_delivery); // Bereken de nieuwe achterstanden
        $new_outgoing_delivery = $available_for_delivery; // Stel de uitgaande leveringen in
        $new_costs = ($new_inventory * 0.50) + ($new_backorder * 1.00); // Bereken de nieuwe kosten

        // Sla de resultaten voor de huidige week op
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

        // Sla de bijgewerkte resultaten terug op in de sessie
        Session::put('results', $results);

        // Bereid de gegevens voor de volgende week voor
        $data = [
            'customer_orders' => rand(80, 1000), // Willekeurige nieuwe klantbestellingen voor volgende week
            'backorder' => $new_backorder,
            'costs' => $new_costs,
            'incoming_delivery' => $extra_order,
            'inventory' => $new_inventory,
            'outgoing_delivery' => $new_outgoing_delivery,
            'week' => $week + 1,
            'results' => $results,
        ];

        // Retourneer de 'igame' view met de bijgewerkte gegevens
        return view('igame', $data);
    }

    // Methode om de resultatenpagina te tonen
    public function results()
    {
        // Haal de resultaten uit de sessie op
        $results = Session::get('results', []);

        // Retourneer de 'results' view met de resultaten
        return view('results', ['results' => $results]);
    }

    // Methode om het spel te resetten
    public function reset()
    {
        // Verwijder de resultaten uit de sessie
        Session::forget('results');

        // Redirect naar de startpagina van het spel
        return redirect()->route('igame.index');
    }
}
