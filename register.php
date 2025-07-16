<?php
require_once __DIR__ . '/includes/config.php';
include __DIR__ . '/includes/header.php';

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

    // Vérification unicité de l'email
    $usersFile = __DIR__ . '/data/users.json';
    $usersData = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : ["users" => []];
    foreach ($usersData["users"] as $user) {
        if (strtolower($user["email"]) === strtolower($email)) {
            $errors[] = "Cet e-mail est déjà utilisé.";
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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription – Coding Day</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= e($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form action="register.php" method="post" autocomplete="off">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required value="<?= isset($username) ? e($username) : '' ?>">

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required value="<?= isset($email) ? e($email) : '' ?>">

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirm">Confirmation du mot de passe</label>
            <input type="password" id="password_confirm" name="password_confirm" required>

            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà inscrit ? <a href="login.php">Connectez-vous</a></p>
    </div>
</body>
</html> 