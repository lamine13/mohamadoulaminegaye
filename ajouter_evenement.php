<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $heure = trim($_POST['heure'] ?? '');
    $lieu = trim($_POST['lieu'] ?? '');
    $type = trim($_POST['type'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $places = intval($_POST['places'] ?? 0);
    $inscription = isset($_POST['inscription']) ? true : false;
    $image = '';
    // Gestion image (optionnelle)
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif'];
        if (in_array($ext, $allowed)) {
            $img_name = 'event_' . uniqid() . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $img_name);
            $image = 'img/' . $img_name;
        }
    }
    if ($titre && $date && $heure && $lieu && $type && $description) {
        $eventsFile = __DIR__ . '/data/events.json';
        $events = file_exists($eventsFile) ? json_decode(file_get_contents($eventsFile), true) : [];
        $id = strtoupper(substr($type,0,2)) . '_' . date('Y') . '_' . uniqid();
        $events[] = [
            'id' => $id,
            'titre' => $titre,
            'date' => $date,
            'heure' => $heure,
            'lieu' => $lieu,
            'adresse' => '',
            'type' => $type,
            'description' => $description,
            'image' => $image,
            'statut' => 'à venir',
            'places_disponibles' => $places,
            'inscription_requise' => $inscription
        ];
        file_put_contents($eventsFile, json_encode($events, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $success = 'Événement ajouté avec succès !';
    } else {
        $error = 'Veuillez remplir tous les champs obligatoires.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un événement - Cellule Numérique UN-CHK</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/png" href="./img/logo.png">
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
    .form-group input[type="time"],
    .form-group input[type="number"],
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
        min-height: 80px;
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
<body style="background-image: url(img/bglam.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
<?php include __DIR__ . '/includes/header.php'; ?>
<section class="form-section">
    <h1>Ajouter un événement</h1>
    <?php if ($success): ?>
        <div style="background:#e6f4ea;color:#105da1;padding:1em 1.2em;border-radius:8px;margin-bottom:1em;font-weight:700;">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php elseif ($error): ?>
        <div style="background:#ffeaea;color:#a11a1a;padding:1em 1.2em;border-radius:8px;margin-bottom:1em;font-weight:700;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titre">Titre de l'événement</label>
            <input type="text" id="titre" name="titre" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="heure">Heure</label>
            <input type="time" id="heure" name="heure" required>
        </div>
        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input type="text" id="lieu" name="lieu" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" id="type" name="type" placeholder="Conférence, Hackathon, etc." required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image (optionnelle)</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>
        <div class="form-group">
            <label for="places">Places disponibles</label>
            <input type="number" id="places" name="places" min="0" value="0">
        </div>
        <div class="form-group" style="display:flex;align-items:center;gap:0.5rem;">
            <input type="checkbox" id="inscription" name="inscription">
            <label for="inscription" style="margin-bottom:0;color:#444;font-weight:400;">Inscription requise</label>
        </div>
        <button type="submit" class="form-btn">Ajouter l'événement</button>
    </form>
</section>
<?php if (file_exists(__DIR__ . '/includes/footer.php')) include __DIR__ . '/includes/footer.php'; ?>
<script src="./js/main.js"></script>
</body>
</html> 