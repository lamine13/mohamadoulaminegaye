<?php
// Page de maintenance simple
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En maintenance</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f7fa;
            color: #105da1;
            font-family: 'Orbitron', Arial, sans-serif;
            margin: 0;
        }
        .maintenance-box {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(16,93,161,0.10);
            padding: 2.5rem 2rem;
            text-align: center;
            max-width: 400px;
        }
        .maintenance-box h1 {
            font-size: 2rem;
            color: #105da1;
            margin-bottom: 1.2rem;
        }
        .maintenance-box p {
            font-size: 1.1rem;
            color: #639b42;
        }
    </style>
</head>
<body>
    <div class="maintenance-box">
        <h1>🚧 En cours de développement</h1>
        <p>Cette page est en cours de développement.<br>Revenez bientôt !</p>
    </div>
</body>
</html> 