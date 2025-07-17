<?php
// Page de maintenance simple
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En maintenance</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
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
        box-shadow: 0 4px 24px rgba(16, 93, 161, 0.10);
        padding: 2.5rem 2rem;
        text-align: center;
        max-width: 400px;
        margin-top: 3rem;
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

    .maintenance-btn {
        display: inline-block;
        margin-top: 2rem;
        background: #105da1;
        color: #fff;
        border: none;
        border-radius: 2rem;
        padding: 0.7rem 2.2rem;
        font-size: 1.1rem;
        font-weight: 700;
        text-decoration: none;
        transition: background 0.2s, color 0.2s;
        cursor: pointer;
    }

    .maintenance-btn:hover {
        background: #639b42;
        color: #fff;
    }
    </style>
</head>

<body>
    <?php include './includes/header.php'; ?>
    <div class="maintenance-box">
        <h1>🚧 En cours de développement</h1>
        <p>Cette page est en cours de développement.<br>Revenez bientôt !</p>
        <a href="index.php" class="maintenance-btn">Retour à l'accueil</a>
    </div>
</body>

</html>