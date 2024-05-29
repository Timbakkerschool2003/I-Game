<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Igame</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script>
        function checkGameOver(week) {
            if (week >= 24) {
                alert('De game is klaar!');
                window.location.href = "{{ route('igame.results') }}";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            checkGameOver({{ $week }});
        });

    </script>
</head>
<body>
    <div class="container">
        <div class="stats">
            <div class="stat-item blue">
                <h2>{{ $customer_orders }}</h2>
                <p>Customer Orders</p>
                <p class="small">Last week's orders from your customers</p>
            </div>
            <div class="stat-item {{ $backorder > 500 ? 'red' : 'blue' }}">
                <h2>{{ $backorder }}</h2>
                <p>Backorder</p>
                <p class="small">The units you put on backorder because you ran out of stock</p>
            </div>
            <div class="stat-item blue">
                <h2>{{ $costs }} €</h2>
                <p>Costs</p>
                <p class="small">Last week's costs</p>
            </div>
            <div class="stat-item blue">
                <h2>{{ $incoming_delivery }}</h2>
                <p>Incoming Delivery</p>
                <p class="small">The units that were delivered to you from the wholesaler</p>
            </div>
            <div class="stat-item blue">
                <h2>{{ $inventory }}</h2>
                <p>Inventory</p>
                <p class="small">Units of beer you have in stock</p>
            </div>
            <div class="stat-item blue">
                <h2>{{ $outgoing_delivery }}</h2>
                <p>Outgoing Delivery</p>
                <p class="small">The units you delivered to your customers</p>
            </div>
        </div>
        <div class="purchase" id="purchase-form">
            <form action="{{ route('igame.update') }}" method="POST">
                @csrf
                <label for="extra_order">Hoeveel koop ik in?</label>
                <input type="number" min="0" id="extra_order" name="extra_order" value="0">
                <input type="hidden" name="customer_orders" value="{{ $customer_orders }}">
                <input type="hidden" name="backorder" value="{{ $backorder }}">
                <input type="hidden" name="incoming_delivery" value="{{ $incoming_delivery }}">
                <input type="hidden" name="inventory" value="{{ $inventory }}">
                <input type="hidden" name="outgoing_delivery" value="{{ $outgoing_delivery }}">
                <input type="hidden" name="week" value="{{ $week }}">
                <button type="submit">Inkopen</button>
            </form>
        </div>
        <div class="footer">
            <p>Dit is Week {{ $week }}</p>
        </div>
    </div>
</body>
</html>
