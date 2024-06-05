<!DOCTYPE html>
<html lang="nl">
<head>
    <!-- Meta tags bevatten informatie over de tekenset en viewport-instellingen -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- De titel van de webpagina -->
    <title>Spelresultaten</title>
    
    <!-- Koppeling naar het externe CSS-bestand voor opmaak van de pagina -->
    <link href="../../css/app.css" rel="stylesheet">
</head>
<body>
    <!-- Container voor de gehele inhoud van de pagina -->
    <div class="container">
        
        <!-- Titel van de pagina -->
        <h2>Spel Over - Resultaten</h2>
        
        <!-- Tabel om de resultaten van het spel weer te geven -->
        <table class="results-table">
            <!-- Tabelkop met de kolomnamen -->
            <thead>
                <tr>
                    <th>Week</th>
                    <th>Extra Bestelling</th>
                    <th>Klantbestellingen</th>
                    <th>Achterstand</th>
                    <th>Kosten</th>
                    <th>Inkomende Levering</th>
                    <th>Voorraad</th>
                    <th>Uitgaande Levering</th>
                </tr>
            </thead>
            <!-- Tabellichaam met de gegevens -->
            <tbody>
                <!-- Loop door de resultaten om elke rij in de tabel te genereren -->
                @foreach ($results as $result)
                    <tr>
                        <!-- Toon het weeknummer -->
                        <td>{{ $result['week'] }}</td>
                        <!-- Toon de extra bestellingen -->
                        <td>{{ $result['extra_order'] }}</td>
                        <!-- Toon de klantbestellingen -->
                        <td>{{ $result['customer_orders'] }}</td>
                        <!-- Toon de achterstanden, en maak de cel rood als de waarde groter is dan 500 -->
                        <td class="{{ $result['backorder'] > 500 ? 'red' : '' }}">{{ $result['backorder'] }}</td>
                        <!-- Toon de kosten -->
                        <td>{{ $result['costs'] }} €</td>
                        <!-- Toon de inkomende leveringen -->
                        <td>{{ $result['incoming_delivery'] }}</td>
                        <!-- Toon de voorraad -->
                        <td>{{ $result['inventory'] }}</td>
                        <!-- Toon de uitgaande leveringen -->
                        <td>{{ $result['outgoing_delivery'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Formulier om het spel te resetten en terug te gaan naar de beginpagina -->
        <form action="{{ route('igame.reset') }}" method="POST">
            <!-- CSRF-token voor beveiliging van het formulier -->
            @csrf
            <!-- Knop om het formulier in te dienen -->
            <button type="submit" class="back-button">Begin game opnieuw</button>
        </form>
    </div>
</body>
</html>
