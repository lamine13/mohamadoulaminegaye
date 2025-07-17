<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: accueil.php');
    exit;
}

$error = '';
$logoutMsg = '';

if (isset($_GET['logout']) && $_GET['logout'] == '1') {
    $logoutMsg = "Vous avez été déconnecté avec succès.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Charger les utilisateurs depuis le fichier JSON
    $usersFile = __DIR__ . '/data/users.json';
    $usersData = json_decode(file_get_contents($usersFile), true);
    $found = false;

    if (!empty($usersData['users'])) {
        foreach ($usersData['users'] as $user) {
            if ($user['email'] === $email) {
                // Vérification du mot de passe (hashé)
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role'] ?? 'user'
                    ];
                    header('Location: accueil.php');
                    exit();
                } else {
                    $error = 'Mot de passe incorrect.';
                }
                $found = true;
                break;
            }
        }
    }
    if (!$found) {
        $error = "Aucun compte trouvé avec cet e-mail.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion – Coding Day</title>
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

    main.login-main {
        flex: 1 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f5f7fa;
        min-height: 0;
        height: calc(100vh - 86px);
    }

    @media (max-width: 900px) {
        main.login-main {
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
    <?php include __DIR__ . '/includes/header.php'; ?>
    <main class="login-main ">
        <div class="login-card-2col">
            <div class="login-img-col">
                <img src="img/synapse-bg.png" alt="Décor login" class="login-img-bg">

            </div>
            <div class="login-form-col">
                <a href="./index.php" class="back-link">&larr; Retour à l'accueil</a>
                <h2>Bienvenue !</h2>
                <p class="login-sub">Créez un <a href="register.php">compte gratuit</a> ou connectez-vous pour
                    continuer.</p>
                <form action="login.php" method="post" autocomplete="off">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                    <div class="login-actions">
                        <a href="#" class="forgot-link">Mot de passe oublié ?</a>
                    </div>
                    <button type="submit" class="login-main-btn">Se connecter</button>
                </form>
                <?php if (!empty($error)) : ?>
                <div class="error-message" style="color:red;margin-top:10px;">
                    <?= htmlspecialchars($error) ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($logoutMsg)) : ?>
                <div class="success-message" style="color:green;margin-top:10px;">
                    <?= htmlspecialchars($logoutMsg) ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="./js/main.js"></script>
</body>

</html>