<!DOCTYPE html>
<html lang="en">
<head>
    <!-- De meta tags bevatten informatie over de tekenset en de viewport-instellingen -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- De titel van de webpagina -->
    <title>Igame</title>
    
    <!-- Koppeling naar het externe CSS-bestand voor opmaak van de pagina -->
    <link href="../../css/app.css" rel="stylesheet">

    <!-- JavaScript voor het controleren van het einde van het spel en het bijwerken van de voortgangsbalk -->
    <script>
        // Functie die controleert of het spel voorbij is (wanneer week 24 is bereikt)
        function checkGameOver(week) {
            if (week >= 24) {
                alert('De game is klaar!'); // Toon een melding dat het spel voorbij is
                window.location.href = "{{ route('igame.results') }}"; // Navigeer naar de resultatenpagina
            }
        }

        // Voer deze code uit zodra de pagina volledig is geladen
        document.addEventListener('DOMContentLoaded', function() {
            checkGameOver({{ $week }}); // Controleer of het spel voorbij is
            updateProgressBar({{ $week }}); // Update de voortgangsbalk met de huidige week
        });

        // Functie die de voortgangsbalk bijwerkt op basis van de huidige week
        function updateProgressBar(week) {
            const progressBar = document.querySelector('.progress-bar'); // Selecteer de voortgangsbalk
            const progressPercentage = (week / 24) * 100; // Bereken het percentage van de voortgang
            progressBar.style.width = progressPercentage + '%'; // Stel de breedte van de voortgangsbalk in
        }
    </script>
</head>
<body>
    <!-- Container voor de hele inhoud van de pagina -->
    <div class="container">
        
        <!-- Statistieken sectie -->
        <div class="stats">
            <!-- Statistiek item voor klantbestellingen -->
            <div class="stat-item blue">
                <h2 class="animated-number">{{ $customer_orders }}</h2>
                <p>Customer Orders</p>
                <p class="small">Last week's orders from your customers</p>
            </div>

            <!-- Statistiek item voor achterstanden -->
            <div class="stat-item {{ $backorder > 500 ? 'red' : 'blue' }}">
                <h2 class="animated-number">{{ $backorder }}</h2>
                <p>Backorder</p>
                <p class="small">The units you put on backorder because you ran out of stock</p>
            </div>

            <!-- Statistiek item voor kosten -->
            <div class="stat-item blue">
                <h2 class="animated-number">{{ $costs }} €</h2>
                <p>Costs</p>
                <p class="small">Last week's costs</p>
            </div>

            <!-- Statistiek item voor inkomende leveringen -->
            <div class="stat-item blue">
                <h2 class="animated-number">{{ $incoming_delivery }}</h2>
                <p>Incoming Delivery</p>
                <p class="small">The units that were delivered to you from the wholesaler</p>
            </div>

            <!-- Statistiek item voor voorraad -->
            <div class="stat-item blue">
                <h2 class="animated-number">{{ $inventory }}</h2>
                <p>Inventory</p>
                <p class="small">Units of beer you have in stock</p>
            </div>

            <!-- Statistiek item voor uitgaande leveringen -->
            <div class="stat-item blue">
                <h2 class="animated-number">{{ $outgoing_delivery }}</h2>
                <p>Outgoing Delivery</p>
                <p class="small">The units you delivered to your customers</p>
            </div>
        </div>

        <!-- Voortgangsbalk sectie -->
        <div class="progress-container">
            <!-- De voortgangsbalk zelf -->
            <div class="progress-bar"></div>
            <!-- Het label dat de huidige week aangeeft -->
            <div class="progress-label">Week {{ $week }} van 24</div>
        </div>

        <!-- Formulier sectie voor het plaatsen van extra bestellingen -->
        <div class="purchase" id="purchase-form">
            <!-- Formulier dat een POST-verzoek verstuurt naar de 'igame.update' route -->
            <form action="{{ route('igame.update') }}" method="POST">
                <!-- CSRF-token voor beveiliging van het formulier -->
                @csrf
                <!-- Label en invoerveld voor het aantal extra bestellingen -->
                <label for="extra_order">Hoeveel koop ik in?</label>
                <input type="number" min="0" id="extra_order" name="extra_order" value="0">
                
                <!-- Verborgen invoervelden om de huidige waarden door te geven bij het indienen van het formulier -->
                <input type="hidden" name="customer_orders" value="{{ $customer_orders }}">
                <input type="hidden" name="backorder" value="{{ $backorder }}">
                <input type="hidden" name="incoming_delivery" value="{{ $incoming_delivery }}">
                <input type="hidden" name="inventory" value="{{ $inventory }}">
                <input type="hidden" name="outgoing_delivery" value="{{ $outgoing_delivery }}">
                <input type="hidden" name="week" value="{{ $week }}">
                
                <!-- Knop om het formulier in te dienen -->
                <button type="submit">Inkopen</button>
            </form>
        </div>
    </div>
</body>
</html>
