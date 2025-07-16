<?php



// Démarrage de la session pour la gestion des utilisateurs et CSRF
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Définir les constantes de chemin
define('BASE_PATH', dirname(__DIR__));
define('IMG_PATH', BASE_PATH . '/img/');
define('DATA_PATH', BASE_PATH . '/data/');

define('DB_HOST', 'localhost');
define('DB_NAME', 'coding_day_db');
define('DB_USER', 'root');
define('DB_PASS', ''); 

date_default_timezone_set('Africa/Dakar');


try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

}

// Génération du token CSRF si absent
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Fonction d'échappement XSS
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
} 