<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Results</title>
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

        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .results-table th, .results-table td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .results-table th {
            background-color: #17a2b8;
            color: white;
        }

        .results-table td.red {
            background-color: #d9534f;
            color: white;
        }

        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #17a2b8;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #138496;
        }
    </style>
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
