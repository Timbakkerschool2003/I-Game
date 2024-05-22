<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Igame</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .stats {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .stat-item {
            flex: 1 1 30%;
            background-color: #17a2b8;
            margin: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .stat-item p {
            margin: 0;
            font-size: 16px;
        }

        .stat-item h2 {
            margin: 10px 0;
            font-size: 32px;
        }

        .stat-item .small {
            font-size: 12px;
            color: #f4f4f4;
        }

        .purchase {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #17a2b8;
            padding: 20px;
            margin: 10px 0;
            color: white;
        }

        .purchase label {
            flex: 1;
            font-size: 16px;
        }

        .purchase input {
            flex: 2;
            padding: 10px;
            font-size: 16px;
        }

        .purchase button {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .purchase button:hover {
            background-color: #45a049;
        }

        .footer {
            text-align: left;
            padding: 20px;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
            color: #555555;
        }
    </style>
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
            <div class="stat-item">
                <h2>{{ $customer_orders }}</h2>
                <p>Customer Orders</p>
                <p class="small">Last week's orders from your customers</p>
            </div>
            <div class="stat-item">
                <h2>{{ $backorder }}</h2>
                <p>Backorder</p>
                <p class="small">The units you put on backorder because you ran out of stock</p>
            </div>
            <div class="stat-item">
                <h2>{{ $costs }} €</h2>
                <p>Costs</p>
                <p class="small">Last week's costs</p>
            </div>
            <div class="stat-item">
                <h2>{{ $incoming_delivery }}</h2>
                <p>Incoming Delivery</p>
                <p class="small">The units that were delivered to you from the wholesaler</p>
            </div>
            <div class="stat-item">
                <h2>{{ $inventory }}</h2>
                <p>Inventory</p>
                <p class="small">Units of beer you have in stock</p>
            </div>
            <div class="stat-item">
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
