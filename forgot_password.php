<?php
session_start();
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    if ($email === '') {
        $message = "Veuillez saisir votre e-mail.";
    } else {
        $usersFile = __DIR__ . '/data/users.json';
        $usersData = json_decode(file_get_contents($usersFile), true);
        $found = false;
        foreach ($usersData['users'] as &$user) {
            if (strtolower($user['email']) === strtolower($email)) {
                $found = true;
                $token = bin2hex(random_bytes(16));
                $expiry = time() + 1800; // 30 min
                $user['reset_token'] = $token;
                $user['reset_token_expiry'] = $expiry;
                file_put_contents($usersFile, json_encode($usersData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                $resetLink = "reset_password.php?token=$token";
                $message = "Lien de réinitialisation : <a href='$resetLink'>$resetLink</a> (valable 30 min)";
                break;
            }
        }
        if (!$found) {
            $message = "Aucun compte trouvé avec cet e-mail.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié – Coding Day</title>
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
                <h2>Mot de passe oublié</h2>
                <p class="login-sub">Saisissez votre e-mail pour recevoir un lien de réinitialisation.</p>
                <form method="post" autocomplete="off">
                    <label for="email">Votre e-mail</label>
                    <input type="email" name="email" id="email" required>
                    <button type="submit" class="login-main-btn">Envoyer le lien</button>
                </form>
                <?php if ($message): ?>
                    <div style="margin-top:1.5rem;padding:1.2rem 1rem;background:#e8f5e9;border:1.5px solid #4caf50;border-radius:8px;box-shadow:0 2px 8px rgba(76,175,80,0.07);color:#222;display:flex;align-items:center;gap:12px;">
                        <span style="font-size:1.7em;color:#43a047;">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#43a047" stroke-width="2"><circle cx="12" cy="12" r="10" stroke="#43a047" stroke-width="2" fill="#e8f5e9"/><path d="M9 12l2 2l4-4" stroke="#43a047" stroke-width="2" fill="none"/></svg>
                        </span>
                        <span style="font-size:1.08em;line-height:1.5;">
                            <?= $message ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="./js/main.js"></script>
</body>
</html> 