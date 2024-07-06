<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized</title>
    <style>
        body {
            background-color: #121212;
            color: #FFFFFF;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .message {
            text-align: center;
        }
        .message strong {
            font-size: 24px;
            font-weight: bold;
            display: block;
            margin-bottom: 20px;
        }
        a {
            color: #1E90FF;
            text-decoration: none;
            font-size: 18px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="message">
        <p style="font-size: 150px; font-weight: bold;">403</p>
        @if (session('error'))
            <strong>{{ session('error') }}</strong>
        @endif
        <a href="{{ url('/') }}">Kembali ke beranda</a>
    </div>
</body>
</html>
