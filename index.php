<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cellule Numérique UN-CHK</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include './includes/header.php'; ?>

    <!-- HERO -->
    <section class="hero-section">
        <div class="hero-bg">
            <div class="hero-content">
                <!-- <span class="hero-step">01/</span> -->
                <h1 class="hero-title">Bienvenue sur la plateforme de la Cellule Numérique UN-CHK</h1>
                <p class="hero-subtitle">
                    Innovation, formation, événements et communauté numérique à l’Université Cheikh Hamidou Kane
                    (UN-CHK).
                </p>
                <div class="hero-actions">
                    <a href="register.php" class="hero-btn primary">Rejoindre la communauté</a>
                    <a href="accueil.php" class="hero-btn secondary">Espace membre</a>
                </div>
            </div>
        </div>
    </section>

    <!-- IMPACT -->
    <section class="impact-section">
        <div class="impact-container">
            <div class="impact-block">
                <span class="impact-number">+500</span>
                <span class="impact-label">Membres actifs</span>
            </div>
            <div class="impact-block">
                <span class="impact-number">+20</span>
                <span class="impact-label">Événements annuels</span>
            </div>
            <div class="impact-block">
                <span class="impact-number">+10</span>
                <span class="impact-label">Partenariats</span>
            </div>
        </div>
    </section>

    <!-- ACTUALITÉS -->
    <section class="actus-section">
        <div class="actus-header">
            <h2>Actualités récentes</h2>
            <a href="accueil.php" class="actus-link">Voir tout</a>
        </div>
        <div class="actus-cards-row">
            <!-- Exemple de carte actualité -->
            <div class="actus-card">
                <div class="actus-card-img">
                    <img src="img/synapse-bg.jpg" alt="Coding Day">
                </div>
                <div class="actus-card-content">
                    <div class="actus-card-meta">
                        <span>12/06/2024</span>
                        <span>Événement</span>
                    </div>
                    <h3 class="actus-card-title">Retour sur le Coding Day 2024</h3>
                    <p class="actus-card-desc">Une journée d’innovation, de challenges et de rencontres autour du
                        numérique à l’UN-CHK.</p>
                    <a href="#" class="actus-card-btn">Lire plus</a>
                </div>
            </div>
            <!-- Duplique la carte pour d'autres actualités -->
            <div class="actus-card">
                <div class="actus-card-img">
                    <img src="img/synapse-login.png" alt="Formation">
                </div>
                <div class="actus-card-content">
                    <div class="actus-card-meta">
                        <span>05/06/2024</span>
                        <span>Formation</span>
                    </div>
                    <h3 class="actus-card-title">Nouvelle formation Python</h3>
                    <p class="actus-card-desc">Inscrivez-vous à notre prochaine session d’initiation à la programmation
                        Python.</p>
                    <a href="#" class="actus-card-btn">Lire plus</a>
                </div>
            </div>
        </div>
    </section>

    <!-- APPEL À L'ACTION -->
    <section class="cta-section">
        <div class="cta-container">
            <h2>Envie de participer à l’aventure numérique ?</h2>
            <a href="register.php" class="cta-btn">Créer un compte</a>
        </div>
    </section>

    <?php include './includes/footer.php'; ?>
    <script src="./js/main.js"></script>
</body>

</html>