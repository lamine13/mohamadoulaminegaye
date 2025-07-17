<?php
session_start();
$token = $_GET['token'] ?? '';
$message = '';
$showForm = false;
if ($token) {
    $usersFile = __DIR__ . '/data/users.json';
    $usersData = json_decode(file_get_contents($usersFile), true);
    $found = false;
    foreach ($usersData['users'] as &$user) {
        if (isset($user['reset_token']) && $user['reset_token'] === $token && isset($user['reset_token_expiry']) && $user['reset_token_expiry'] >= time()) {
            $found = true;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $pass1 = $_POST['password'] ?? '';
                $pass2 = $_POST['password2'] ?? '';
                if ($pass1 === '' || $pass2 === '') {
                    $message = "Veuillez remplir les deux champs.";
                } elseif ($pass1 !== $pass2) {
                    $message = "Les mots de passe ne correspondent pas.";
                } else {
                    $user['password'] = password_hash($pass1, PASSWORD_DEFAULT);
                    unset($user['reset_token'], $user['reset_token_expiry']);
                    file_put_contents($usersFile, json_encode($usersData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                    $message = "Mot de passe réinitialisé avec succès. <a href='login.php'>Se connecter</a>";
                    $showForm = false;
                    break;
                }
            } else {
                $showForm = true;
            }
            break;
        }
    }
    unset($user);
    if (!$found) {
        $message = "Lien invalide ou expiré.";
    }
} else {
    $message = "Lien de réinitialisation manquant.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe – Coding Day</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <style>
    html, body { height: 100%; margin: 0; padding: 0; }
    body { min-height: 100vh; height: 100vh; display: flex; flex-direction: column; }
    main.login-main { flex: 1 0 auto; display: flex; align-items: center; justify-content: center; background: #f5f7fa; min-height: 0; height: calc(100vh - 86px); }
    @media (max-width: 900px) { main.login-main { height: calc(100vh - 60px); } }
    body, html { overflow: hidden; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/includes/header.php'; ?>
    <main class="login-main ">
        <div class="login-card-2col">
            <div class="login-img-col">
                <img src="img/synapse-bg.png" alt="Décor login" class="login-img-bg">
            </div>
            <div class="login-form-col">
                <a href="./login.php" class="back-link">&larr; Retour à la connexion</a>
                <h2>Réinitialiser le mot de passe</h2>
                <?php if ($message): ?>
                    <div style="margin-bottom:1rem;color:#105da1;">
                        <?= $message ?>
                    </div>
                <?php endif; ?>
                <?php if ($showForm): ?>
                <form method="post" autocomplete="off">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" name="password" id="password" required>
                    <label for="password2">Confirmer le mot de passe</label>
                    <input type="password" name="password2" id="password2" required>
                    <button type="submit" class="login-main-btn">Réinitialiser</button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="./js/main.js"></script>
</body>
</html> 