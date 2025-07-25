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
    <link rel="icon" type="image/png" href="./img/logo.png">
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

    <!-- EVENEMENTS A VENIR -->
    <?php
    $events = [];
    $events_json = @file_get_contents('data/events.json');
    if ($events_json) {
        $events = json_decode($events_json, true);
    }
    ?>
    <section class="actus-section">
        <div class="actus-header">
            <h2>Événements à venir</h2>
            <a href="accueil.php" class="actus-link">Voir tout</a>
        </div>
        <div class="actus-cards-row">
            <?php 
            $count = 0;
            foreach ($events as $i => $event): 
                if ($count >= 3) break;
            ?>
                <div class="actus-card">
                    <div class="actus-card-img">
                        <?php if (!empty($event['image'])): ?>
                            <img src="<?= htmlspecialchars($event['image']) ?>" alt="<?= htmlspecialchars($event['titre']) ?>">
                        <?php else: ?>
                            <div style="width:100%;height:100%;background:linear-gradient(135deg,#639b42 0%,#105da1 100%);"></div>
                        <?php endif; ?>
                    </div>
                    <div class="actus-card-content">
                        <div class="actus-card-meta">
                            <span><?= htmlspecialchars($event['date']) ?> à <?= htmlspecialchars($event['heure']) ?></span>
                            <span style="margin-left:10px;">Lieu : <?= htmlspecialchars($event['lieu']) ?></span>
                        </div>
                        <h3 class="actus-card-title"><?= htmlspecialchars($event['titre']) ?></h3>
                        <p class="actus-card-desc"><?php
                            $desc = isset($event['description']) ? $event['description'] : '';
                            $desc_tronque = mb_strlen($desc) > 120 ? mb_substr($desc, 0, 120) . '…' : $desc;
                            echo htmlspecialchars($desc_tronque);
                        ?></p>
                    </div>
                </div>
            <?php 
                $count++;
            endforeach; 
            ?>
        </div>
    </section>

    <!-- ACTUALITÉS -->
    <?php
    $actus = [];
    $actus_json = @file_get_contents('data/actualites.json');
    if ($actus_json) {
        $actus = json_decode($actus_json, true);
    }
    ?>
    <section class="actus-section">
        <div class="actus-header">
            <h2>Actualités récentes</h2>
            <a href="accueil.php" class="actus-link">Voir tout</a>
        </div>
        <div class="actus-cards-row">
            <?php foreach ($actus as $i => $actu): ?>
                <div class="actus-card">
                    <div class="actus-card-img">
                        <img src="<?= htmlspecialchars($actu['image']) ?>" alt="<?= htmlspecialchars($actu['titre']) ?>">
                    </div>
                    <div class="actus-card-content">
                        <div class="actus-card-meta">
                            <span><?= htmlspecialchars($actu['date']) ?></span>
                        </div>
                        <h3 class="actus-card-title"><?= htmlspecialchars($actu['titre']) ?></h3>
                        <p class="actus-card-desc"><?php
                            $texte = isset($actu['texte']) ? $actu['texte'] : '';
                            $texte_tronque = mb_strlen($texte) > 120 ? mb_substr($texte, 0, 120) . '…' : $texte;
                            echo htmlspecialchars($texte_tronque);
                        ?></p>
                        <a href="actualite.php?id=<?= isset($actu['id']) ? urlencode($actu['id']) : $i ?>" class="actus-card-btn">Lire plus</a>
                    </div>
                </div>
            <?php endforeach; ?>
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