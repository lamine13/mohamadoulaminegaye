<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

// Affichage des erreurs PHP pour debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $texte = trim($_POST['texte'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $imagePath = '';

    // Validation basique
    if ($titre === '' || $texte === '' || $date === '') {
        $error = "Tous les champs sont obligatoires.";
    } else {
        // Gestion de l'upload d'image (facultatif)
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imgTmp = $_FILES['image']['tmp_name'];
            $imgName = basename($_FILES['image']['name']);
            $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($imgExt, $allowed)) {
                $newName = uniqid('actu_', true) . '.' . $imgExt;
                $dest = 'img/' . $newName;
                if (move_uploaded_file($imgTmp, $dest)) {
                    $imagePath = $dest;
                } else {
                    $error = "Erreur lors de l'upload de l'image.";
                }
            } else {
                $error = "Format d'image non autorisé.";
            }
        }
        // Si pas d'erreur d'image
        if (!$error) {
            $actusFile = 'data/actualites.json';
            $actus = [];
            if (file_exists($actusFile)) {
                $json = file_get_contents($actusFile);
                $actus = json_decode($json, true) ?: [];
            }
            $actus[] = [
                'id' => uniqid('actu_', true),
                'titre' => $titre,
                'texte' => $texte,
                'date' => $date,
                'image' => $imagePath !== '' ? $imagePath : 'img/bglam.jpg' // image par défaut si vide
            ];
            if (file_put_contents($actusFile, json_encode($actus, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
                $success = "Actualité ajoutée avec succès !";
            } else {
                $error = "Erreur lors de l'enregistrement de l'actualité.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une actualité - Cellule Numérique UN-CHK</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <style>
    .form-section {
        max-width: 520px;
        margin: 4rem auto 2rem auto;
        padding: auto;
        margin-top: 15vh;
        background-image: url(img/bglam3.jpg);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin-bottom: 15vh;

        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(16, 93, 161, 0.10);
        padding: 2.5rem 2rem;
    }

    .form-section h1 {
        color: #105da1;
        font-size: 2rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .form-group {
        margin-bottom: 1.3rem;
    }

    .form-group label {
        display: block;
        font-weight: 700;
        color: #105da1;
        margin-bottom: 0.5rem;
    }

    .form-group input[type="text"],
    .form-group input[type="date"],
    .form-group input[type="file"],
    .form-group textarea {
        width: 100%;
        padding: 0.8rem;
        border-radius: 8px;
        border: 1.5px solid #e0e0e0;
        background: #f7f9fa;
        font-size: 1.08rem;
        margin-bottom: 0.2rem;
    }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-btn {
        display: block;
        width: 100%;
        background: #105da1;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 1rem;
        font-size: 1.1rem;
        font-family: 'Orbitron', Arial, sans-serif;
        font-weight: 700;
        cursor: pointer;
        margin-top: 1rem;
        transition: background 0.2s;
    }

    .form-btn:hover {
        background: #639b42;
    }
    </style>
</head>

<body class=""
    style="background-image: url(img/bglam.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <?php include './includes/header.php'; ?>
    <section class="form-section">
        <h1>Ajouter une actualité</h1>
        <?php if ($success): ?>
        <div
            style="background:#e6f4ea;color:#105da1;padding:1em 1.2em;border-radius:8px;margin-bottom:1em;font-weight:700;">
            <?= htmlspecialchars($success) ?>
        </div>
        <?php elseif ($error): ?>
        <div
            style="background:#ffeaea;color:#a11a1a;padding:1em 1.2em;border-radius:8px;margin-bottom:1em;font-weight:700;">
            <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" required>
            </div>
            <div class="form-group">
                <label for="texte">Texte</label>
                <textarea id="texte" name="texte" required></textarea>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" class="form-btn">Publier l'actualité</button>
        </form>
    </section>
    <?php include './includes/footer.php'; ?>
    <script src="./js/main.js"></script>
</body>

</html>