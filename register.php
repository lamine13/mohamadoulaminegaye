<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: accueil.php');
    exit;
}
require_once __DIR__ . '/includes/config.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Vérification des champs requis
    if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
        $errors[] = "Tous les champs sont requis.";
    }

    // Vérification des mots de passe identiques
    if ($password !== $password_confirm) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    // Vérification unicité de l'email et du pseudo
    $usersFile = __DIR__ . '/data/users.json';
    $usersData = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : ["users" => []];
    foreach ($usersData["users"] as $user) {
        if (strtolower($user["email"]) === strtolower($email)) {
            $errors[] = "Cet e-mail est déjà utilisé.";
            break;
        }
    }
    foreach ($usersData["users"] as $user) {
        if (strtolower($user["username"]) === strtolower($username)) {
            $errors[] = "Ce pseudo est déjà utilisé.";
            break;
        }
    }

    // Si pas d'erreurs, on enregistre
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $newUser = [
            "id" => count($usersData["users"]) + 1,
            "username" => $username,
            "email" => $email,
            "password" => $hashedPassword,
            "role" => "user",
            "created_at" => date('Y-m-d H:i:s')
        ];
        $usersData["users"][] = $newUser;
        file_put_contents($usersFile, json_encode($usersData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header('Location: login.php');
        exit;
    }
}
include __DIR__ . '/includes/header.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription – Coding Day</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        min-height: 100vh;
        height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main.register-main {
        flex: 1 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f5f7fa;
        min-height: 0;
        height: calc(100vh - 86px);
    }

    @media (max-width: 900px) {
        main.register-main {
            height: calc(100vh - 60px);
        }
    }

    /* Empêche le scroll vertical inutile */
    body,
    html {
        overflow: hidden;
    }
    </style>
</head>

<body>
    <main class="register-main"
        style="min-height:calc(100vh - 86px);display:flex;align-items:center;justify-content:center;background:#f5f7fa;">
        <div class="login-card-2col">
            <div class="login-img-col">
                <img src="img/synapse-bg.png" alt="Décor inscription" class="login-img-bg">
            </div>
            <div class="login-form-col">
                <a href="./index.php" class="back-link">&larr; Retour à l'accueil</a>
                <h2>Créer un compte</h2>
                <p class="login-sub">Déjà inscrit ? <a href="login.php">Connectez-vous</a></p>
                <form action="register.php" method="post" autocomplete="off">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" required
                        value="<?= isset($username) ? htmlspecialchars($username) : '' ?>"
                        style="width:100%;padding:0.9rem 1rem;border-radius:24px;border:1.5px solid #e0e0e0;background:#f7f9fa;font-size:1.08rem;transition:border 0.2s,box-shadow 0.2s;outline:none;">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required
                        value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                    <label for="password_confirm">Confirmation du mot de passe</label>
                    <input type="password" id="password_confirm" name="password_confirm" required>
                    <button type="submit" class="login-main-btn">S'inscrire</button>
                </form>
                <?php if (!empty($errors)) : ?>
                <div class="error-message" style="color:red;margin-top:10px;">
                    <ul style="margin:0;padding-left:18px;">
                        <?php foreach ($errors as $error) : ?>
                        <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="./js/main.js"></script>
</body>

</html>