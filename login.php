<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion – Coding Day</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <main style="min-height:60vh;display:flex;align-items:center;justify-content:center;background:#f5f7fa;">
        <div class="login-card-2col">
            <div class="login-img-col">
                <img src="img/synapse-bg.png" alt="Décor login" class="login-img-bg">
                <div class="login-img-text">
                    Cellule Numérique (Dakar)
                    Université Virtuelle du Sénégal
                    <span class="login-img-tex-second">Innovation, </span> tradition et numérique<br>au service de la
                    jeunesse africaine.
                </div>
            </div>
            <div class="login-form-col">
                <a href="./index.php" class="back-link">&larr; Retour à l'accueil</a>
                <h2>Bienvenue !</h2>
                <p class="login-sub">Créez un <a href="register.php">compte gratuit</a> ou connectez-vous pour
                    continuer.</p>
                <form action="login.php" method="post" autocomplete="off">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                    <div class="login-actions">
                        <a href="#" class="forgot-link">Mot de passe oublié ?</a>
                    </div>
                    <button type="submit" class="login-main-btn">Se connecter</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>