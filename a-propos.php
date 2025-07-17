<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - Cellule Numérique UN-CHK</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include './includes/header.php'; ?>

    <!-- HERO À PROPOS -->
    <section class="hero-section">
        <div class="hero-bg">
            <div class="hero-content">
                <h1 class="hero-title">À propos de la Cellule Numérique UN-CHK</h1>
                <p class="hero-subtitle">
                    Découvrez la mission, l'équipe et les valeurs qui animent la Cellule Numérique de l'Université Cheikh Hamidou Kane.
                </p>
            </div>
        </div>
    </section>

    <!-- SECTION MISSION / VALEURS / ÉQUIPE -->
    <section class="impact-section">
        <div class="impact-container">
            <div class="impact-block">
                <span class="impact-number">Notre mission</span>
                <span class="impact-label">Favoriser l'innovation pédagogique, la transformation digitale et la réussite des étudiants à l'UN-CHK.</span>
            </div>
            <div class="impact-block">
                <span class="impact-number">Nos valeurs</span>
                <span class="impact-label">Collaboration, excellence, inclusion, ouverture et engagement pour le numérique éducatif.</span>
            </div>
            <div class="impact-block">
                <span class="impact-number">Notre équipe</span>
                <span class="impact-label">Des enseignants, experts, étudiants et partenaires passionnés par la transformation digitale.</span>
            </div>
        </div>
    </section>

    <!-- SECTION CONTACT / APPEL À L'ACTION -->
    <section class="cta-section">
        <div class="cta-container">
            <h2>Envie d'en savoir plus ou de rejoindre la Cellule ?</h2>
            <a href="register.php" class="cta-btn">Rejoindre la communauté</a>
        </div>
    </section>

    <?php include './includes/footer.php'; ?>
    <script src="./js/main.js"></script>
</body>
</html> 