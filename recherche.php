<?php
session_start();
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$actus = [];
if (file_exists('data/actualites.json')) {
    $actus = json_decode(file_get_contents('data/actualites.json'), true);
}
$results = [];
if ($q !== '' && is_array($actus)) {
    foreach ($actus as $a) {
        if (
            stripos($a['titre'], $q) !== false ||
            stripos($a['texte'], $q) !== false
        ) {
            $results[] = $a;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche actualités - Cellule Numérique UN-CHK</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php include './includes/header.php'; ?>
<section class="actus-section" style="min-height:60vh; padding-top: 5rem;">
    <div class="actus-header">
        <h2>Résultats de recherche pour : "<?= htmlspecialchars($q) ?>"</h2>
        <a href="index.php" class="actus-link">Retour à l'accueil</a>
    </div>
    <div class="actus-cards-row">
        <?php if ($q === ''): ?>
            <div style="color:#a11a1a;font-weight:700;font-size:1.1rem;">Veuillez saisir un mot-clé pour rechercher.</div>
        <?php elseif (empty($results)): ?>
            <div style="color:#a11a1a;font-weight:700;font-size:1.1rem;">Aucune actualité trouvée.</div>
        <?php else:
            foreach ($results as $i => $actu): ?>
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
            <?php endforeach;
        endif; ?>
    </div>
</section>
<?php include './includes/footer.php'; ?>
<script src="./js/main.js"></script>
</body>
</html> 