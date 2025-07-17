<?php
session_start();
$actusFile = 'data/actualites.json';
$eventsFile = 'data/events.json';
$actus = [];
$events = [];
if (file_exists($actusFile)) {
    $json = file_get_contents($actusFile);
    $actus = json_decode($json, true) ?: [];
}
if (file_exists($eventsFile)) {
    $json = file_get_contents($eventsFile);
    $events = json_decode($json, true) ?: [];
}
$id = isset($_GET['id']) ? $_GET['id'] : '';
$actu = null;
if ($id !== '') {
    foreach ($actus as $i => $a) {
        if ((isset($a['id']) && $a['id'] === $id) || (!isset($a['id']) && (string)$i === (string)$id)) {
            $actu = $a;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualité - Cellule Numérique UN-CHK</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <style>
    .actu-detail-layout {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        gap: 2.5rem;
        max-width: 1200px;
        margin: 3rem auto 2rem auto;
        justify-content: center;
    }

    .actu-main {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(16, 93, 161, 0.10);
        padding: 0;
        max-width: 650px;
        width: 100%;
        min-width: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .actu-main-card {
        width: 100%;
        border-radius: 18px;
        overflow: hidden;
        display: flex;
        height: 100%;
        min-height: 100%;
        flex-direction: column;
        align-items: center;
        box-shadow: none;
    }

    .actu-main-img {
        width: 100%;
        height: 220px;
        background: #e0f2e9;
        overflow: hidden;
        border-radius: 18px 18px 0 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .actu-main-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 18px 18px 0 0;
    }

    .actu-main-content {
        padding: 1.2rem 2rem 2rem 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        gap: 0.7rem;
    }

    .actu-main-date {
        color: #639b42;
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 0.2rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .actu-main-title {
        color: #105da1;
        font-size: 1.4rem;
        font-weight: 900;
        text-align: center;
        margin-bottom: 0.2rem;
    }

    .actu-main-text {
        color: #444;
        font-size: 1.08rem;
        text-align: center;
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }

    .actu-main-btn {
        display: inline-block;
        background: #f5f7fa;
        color: #105da1;
        border-radius: 1.2rem;
        padding: 0.5rem 1.3rem;
        font-size: 1rem;
        font-weight: 700;
        text-decoration: none;
        margin-top: 0.7rem;
        border: none;
        transition: background 0.2s, color 0.2s;
        box-shadow: 0 2px 8px rgba(16, 93, 161, 0.07);
    }

    .actu-main-btn:hover {
        background: #105da1;
        color: #fff;
    }

    .suggestions-col {
        min-width: 320px;
        max-width: 370px;
        width: 100%;
        background: transparent;
        border-radius: 0;
        box-shadow: none;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 1.2rem;
        align-items: center;
    }

    .suggestion-title {
        color: #105da1;
        font-size: 1.1rem;
        font-weight: 900;
        margin-bottom: 1.2rem;
        text-align: left;
        letter-spacing: 0.5px;
        width: 100%;
    }

    .event-suggestion-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(16, 93, 161, 0.07);
        padding: 1.1rem 1rem 1.1rem 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        border-left: 5px solid #639b42;
    }

    .event-suggestion-title {
        color: #105da1;
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 0.2rem;
    }

    .event-suggestion-date {
        color: #639b42;
        font-size: 0.98rem;
        font-weight: 600;
    }

    .event-suggestion-type {
        color: #444;
        font-size: 0.92rem;
        font-style: italic;
    }

    .event-suggestion-desc {
        color: #444;
        font-size: 0.95rem;
        margin-bottom: 0.2rem;
    }

    .actus-cards-row.suggestions {
        flex-direction: column;
        gap: 1.1rem;
        width: 100%;
        align-items: center;
    }

    .actus-card.suggestion {
        min-width: 0;
        width: 100%;
        max-width: 100%;
        border-radius: 14px;
        box-shadow: 0 2px 8px rgba(16, 93, 161, 0.07);
        padding: 0;
        margin: 0 auto;
    }

    .actus-card.suggestion .actus-card-img {
        height: 80px;
        border-radius: 14px 14px 0 0;
        overflow: hidden;
    }

    .actus-card.suggestion .actus-card-img img {
        height: 80px;
        border-radius: 14px 14px 0 0;
        object-fit: cover;
    }

    .actus-card.suggestion .actus-card-content {
        padding: 0.7rem 1rem 1rem 1rem;
        gap: 0.4rem;
    }

    .actus-card.suggestion .actus-card-title {
        font-size: 1rem;
        margin-bottom: 0.2rem;
    }

    .actus-card.suggestion .actus-card-desc {
        font-size: 0.92rem;
        margin-bottom: 0.4rem;
        color: #444;
    }

    .actus-card.suggestion .actus-card-meta span {
        font-size: 0.92rem;
    }

    .actus-card.suggestion .actus-card-btn {
        font-size: 0.92rem;
        padding: 0.35rem 1rem;
        border-radius: 1.2rem;
        margin-top: 0.2rem;
    }

    @media (max-width: 1000px) {
        .actu-detail-layout {
            flex-direction: column;
            gap: 2rem;
            max-width: 98vw;
        }

        .suggestions-col {
            max-width: 100vw;
            min-width: 0;
        }

        .actu-main {
            max-width: 100vw;
        }
    }

    @media (max-width: 600px) {
        .actu-main-content {
            padding: 0.7rem 0.5rem 1.2rem 0.5rem;
        }

        .actu-main-img {
            height: 120px;
        }

        .actu-main-title {
            font-size: 1.05rem;
        }

        .actu-main-text {
            font-size: 0.95rem;
        }
    }
    </style>
</head>

<body>
    <?php include './includes/header.php'; ?>
    <section class="actus-section" style="min-height:60vh; padding-top: 5rem;">
        <div class="actu-detail-layout">
            <div class="actu-main">
                <?php if ($actu): ?>
                <div class="actu-main-card ">
                    <div class="actu-main-img">
                        <img src="<?= htmlspecialchars($actu['image']) ?>"
                            alt="<?= htmlspecialchars($actu['titre']) ?>">
                    </div>
                    <div class="actu-main-content">
                        <div class="actu-main-date"> <?= htmlspecialchars($actu['date']) ?></div>
                        <div class="actu-main-title"><?= htmlspecialchars($actu['titre']) ?></div>
                        <div class="actu-main-text"><?= nl2br(htmlspecialchars($actu['texte'])) ?></div>
                        <a href="index.php" class="actu-main-btn">← Retour à l'accueil</a>
                    </div>
                </div>
                <?php else: ?>
                <div style="color:#a11a1a;font-weight:700;font-size:1.2rem;text-align:center;">Actualité introuvable.
                </div>
                <div style="text-align:center;margin-top:2rem;"><a href="index.php" class="cta-btn">Retour à
                        l'accueil</a></div>
                <?php endif; ?>
            </div>
            <aside class="suggestions-">
                <div class="suggestion-title">Autres actualités à découvrir</div>
                <div class="actus-cards-row suggestions">
                    <?php
                $suggestions = [];
                foreach ($actus as $a) {
                    if (
                        (isset($a['id']) && isset($actu['id']) && $a['id'] === $actu['id']) ||
                        (!isset($a['id']) && $a['titre'] === $actu['titre'])
                    ) {
                        continue;
                    }
                    $suggestions[] = $a;
                    if (count($suggestions) >= 2) break;
                }
                if (!empty($suggestions)):
                    foreach ($suggestions as $i => $sugg):
                        $sugg_id = isset($sugg['id']) ? urlencode($sugg['id']) : $i;
                ?>
                    <div class="actus-card suggestion">
                        <div class="actus-card-img">
                            <?php if (!empty($sugg['image'])): ?>
                            <img src="<?= htmlspecialchars($sugg['image']) ?>"
                                alt="<?= htmlspecialchars($sugg['titre']) ?>">
                            <?php else: ?>
                            <div
                                style="width:100%;height:100%;background:linear-gradient(135deg,#105da1 0%,#639b42 100%);">
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="actus-card-content">
                            <div class="actus-card-meta">
                                <span style="color:#639b42;">
                                    <?= htmlspecialchars($sugg['date']) ?>
                                </span>
                            </div>
                            <h3 class="actus-card-title" style="color:#105da1;">
                                <?= htmlspecialchars($sugg['titre']) ?>
                            </h3>
                            <p class="actus-card-desc">
                                <?php
                                $texte = isset($sugg['texte']) ? $sugg['texte'] : '';
                                $texte_tronque = mb_strlen($texte) > 120 ? mb_substr($texte, 0, 120) . '…' : $texte;
                                echo htmlspecialchars($texte_tronque);
                                ?>
                            </p>
                            <a href="actualite.php?id=<?= $sugg_id ?>" class="actus-card-btn">Lire plus</a>
                        </div>
                    </div>
                    <?php endforeach; else: ?>
                    <div style="color:#888;">Aucune autre actualité à suggérer.</div>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
    </section>
    <?php include './includes/footer.php'; ?>
</body>

</html>