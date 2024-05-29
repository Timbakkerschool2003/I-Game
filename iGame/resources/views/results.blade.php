<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Results</title>
    <link href="../../css/app.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Game Over - Resultaten</h2>
        <table class="results-table">
            <thead>
                <tr>
                    <th>Week</th>
                    <th>Extra Order</th>
                    <th>Customer Orders</th>
                    <th>Backorder</th>
                    <th>Costs</th>
                    <th>Incoming Delivery</th>
                    <th>Inventory</th>
                    <th>Outgoing Delivery</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                    <tr>
                        <td>{{ $result['week'] }}</td>
                        <td>{{ $result['extra_order'] }}</td>
                        <td>{{ $result['customer_orders'] }}</td>
                        <td class="{{ $result['backorder'] > 500 ? 'red' : '' }}">{{ $result['backorder'] }}</td>
                        <td>{{ $result['costs'] }} €</td>
                        <td>{{ $result['incoming_delivery'] }}</td>
                        <td>{{ $result['inventory'] }}</td>
                        <td>{{ $result['outgoing_delivery'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('igame.reset') }}" method="POST">
            @csrf
            <button type="submit" class="back-button">Terug naar Beginpagina</button>
        </form>
    </div>
</body>
</html>
