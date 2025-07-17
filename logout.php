<?php
session_start();
// Détruit toutes les variables de session
$_SESSION = array();
// Si vous voulez détruire complètement la session, effacez aussi le cookie de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
header('Location: login.php?logout=1');
exit; 