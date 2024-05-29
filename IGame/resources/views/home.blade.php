<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* style.css */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .tab-button {
            background: #f0f0f0;
            border: none;
            padding: 10px 20px;
            margin-bottom: 20px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .form input[type="text"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form button {
            width: 80%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form button:hover {
            background-color: #45a049;
        }
        
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Room Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <button class="tab-button">Kamer aanmaken</button>
        <form class="form">
            <input type="text" id="name" placeholder="Vul hier je naam in">
            <input type="text" id="room-code" placeholder="Vul hier de code van de kamer in">
            <button type="submit">Doorgaan</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
