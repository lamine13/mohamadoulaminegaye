<?php

// FICHIER DE CONFIGURATION GLOBAL - Paramètres de base et fonctions utilitaires
// Ce fichier contient toutes les constantes, configurations et fonctions communes à l'application

// GESTION DES SESSIONS - Initialisation de la session PHP pour la sécurité
// La session permet de gérer l'authentification utilisateur et les tokens CSRF
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// DÉFINITION DES CHEMINS - Constantes pour les répertoires de l'application
// Ces constantes facilitent la navigation dans l'arborescence des fichiers
define('BASE_PATH', dirname(__DIR__));        // Chemin racine du projet
define('IMG_PATH', BASE_PATH . '/img/');      // Répertoire des images
define('DATA_PATH', BASE_PATH . '/data/');    // Répertoire des fichiers de données JSON

// CONFIGURATION BASE DE DONNÉES - Paramètres de connexion MySQL
// Ces constantes définissent les paramètres de connexion à la base de données
define('DB_HOST', 'localhost');               // Adresse du serveur MySQL
define('DB_NAME', 'coding_day_db');           // Nom de la base de données
define('DB_USER', 'root');                    // Nom d'utilisateur MySQL
define('DB_PASS', '');                        // Mot de passe MySQL (vide pour développement)

// CONFIGURATION TEMPORELLE - Définition du fuseau horaire de l'application
// Utilisation du fuseau horaire de Dakar pour la cohérence avec le Sénégal
date_default_timezone_set('Africa/Dakar');

// CONNEXION BASE DE DONNÉES - Établissement de la connexion PDO
// Utilisation de PDO pour une interface sécurisée et moderne avec MySQL
try {
    // Création de l'objet PDO avec gestion des erreurs
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    
    // Configuration du mode d'erreur PDO pour lever des exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Gestion silencieuse des erreurs de connexion (pour le développement)
    // En production, il faudrait logger l'erreur et afficher un message approprié
}

// SÉCURITÉ CSRF - Génération du token de protection contre les attaques CSRF
// Le token CSRF protège contre les attaques Cross-Site Request Forgery
if (empty($_SESSION['csrf_token'])) {
    // Génération d'un token aléatoire de 32 bytes (256 bits) converti en hexadécimal
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// FONCTION DE SÉCURITÉ XSS - Protection contre les attaques Cross-Site Scripting
// Cette fonction échappe les caractères spéciaux pour empêcher l'injection de code malveillant
function e($string) {
    // Conversion des caractères spéciaux en entités HTML sécurisées
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
} 