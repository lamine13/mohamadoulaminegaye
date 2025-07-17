<?php
// FICHIER DE TRAITEMENT LIVRE D'OR - API pour sauvegarder les messages du livre d'or
// Ce script reçoit les messages via AJAX et les sauvegarde dans un fichier JSON

// EN-TÊTE RÉPONSE - Définition du type de contenu pour les réponses JSON
header('Content-Type: application/json');

// CONFIGURATION DÉBOGAGE - Activation des logs d'erreur pour le développement
// Ces lignes permettent de voir les erreurs PHP pendant le développement
error_reporting(E_ALL);
ini_set('display_errors', 1);

// LOG DÉBOGAGE - Enregistrement de l'appel au script pour tracer les requêtes
error_log("save_guestbook.php appelé");

// VÉRIFICATION MÉTHODE HTTP - Contrôle que la requête utilise bien la méthode POST
// Seules les requêtes POST sont autorisées pour des raisons de sécurité
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    error_log("Méthode non autorisée: " . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
    exit;
}

// VÉRIFICATION ACTION - Contrôle que l'action demandée est correcte
// Cette vérification ajoute une couche de sécurité supplémentaire
if (!isset($_POST['action']) || $_POST['action'] !== 'save_guestbook') {
    error_log("Action invalide: " . (isset($_POST['action']) ? $_POST['action'] : 'non définie'));
    echo json_encode(['success' => false, 'error' => 'Action invalide']);
    exit;
}

// VALIDATION MESSAGE - Vérification que le message n'est pas vide
// Le message doit être présent et contenir du texte après suppression des espaces
if (!isset($_POST['message']) || empty(trim($_POST['message']))) {
    error_log("Message vide ou non défini");
    echo json_encode(['success' => false, 'error' => 'Message vide']);
    exit;
}

// NETTOYAGE MESSAGE - Suppression des espaces inutiles au début et à la fin
$message = trim($_POST['message']);
error_log("Message reçu: " . $message);

// GÉNÉRATION ID UNIQUE - Création d'un identifiant unique pour chaque message
// Format: GB_ANNÉE_NUMÉRO (ex: GB_2025_001)
$id = 'GB_' . date('Y') . '_' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

// RÉCUPÉRATION UTILISATEUR - Utilisation du pseudo de l'utilisateur connecté
// Démarrage de la session pour accéder aux informations utilisateur
session_start();
$author = isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : 'Anonyme';
$initials = strtoupper(substr($author, 0, 2));

// CRÉATION MESSAGE - Structure du nouveau message avec toutes les métadonnées
$newMessage = [
    'id' => $id,                    // Identifiant unique du message
    'author' => $author,            // Nom de l'auteur (utilisateur connecté)
    'initials' => $initials,        // Initiales pour l'avatar
    'message' => $message,          // Contenu du message
    'date' => date('Y-m-d'),        // Date de publication
    'time' => date('H:i'),          // Heure de publication
    'status' => 'published'         // Statut du message
];

// CHARGEMENT MESSAGES EXISTANTS - Lecture du fichier JSON des messages
$guestbook_file = __DIR__ . '/data/guestbook.json';
$messages = [];

// CRÉATION DOSSIER DATA - Création automatique du dossier s'il n'existe pas
// Cette fonctionnalité assure que l'application fonctionne même si le dossier n'existe pas
$data_dir = __DIR__ . '/data';
if (!is_dir($data_dir)) {
    mkdir($data_dir, 0755, true);
    error_log("Dossier data créé: " . $data_dir);
}

// CRÉATION FICHIER JSON - Création automatique du fichier s'il n'existe pas
// Le fichier est initialisé avec un tableau vide en format JSON
if (!file_exists($guestbook_file)) {
    file_put_contents($guestbook_file, json_encode([], JSON_PRETTY_PRINT));
    error_log("Fichier guestbook.json créé: " . $guestbook_file);
}

// LECTURE FICHIER EXISTANT - Chargement des messages déjà sauvegardés
if (file_exists($guestbook_file)) {
    $file_content = file_get_contents($guestbook_file);
    error_log("Contenu du fichier: " . $file_content);
    
    // DÉCODAGE JSON - Conversion du contenu JSON en tableau PHP
    $messages = json_decode($file_content, true);
    if (!is_array($messages)) {
        $messages = [];
        error_log("JSON invalide, tableau vide créé");
    }
}

// AJOUT NOUVEAU MESSAGE - Insertion du nouveau message au début de la liste
// array_unshift place le nouveau message en première position
array_unshift($messages, $newMessage);
error_log("Nouveau message ajouté. Total: " . count($messages));

// LIMITATION MESSAGES - Limitation à 50 messages maximum pour éviter la surcharge
// Cette limitation assure les performances et évite les fichiers trop volumineux
if (count($messages) > 50) {
    $messages = array_slice($messages, 0, 50);
    error_log("Messages limités à 50");
}

// SAUVEGARDE FICHIER - Écriture des messages dans le fichier JSON
try {
    error_log("Tentative de sauvegarde dans: " . $guestbook_file);
    
    // ENCODAGE JSON - Conversion du tableau PHP en JSON formaté
    $json_content = json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    error_log("JSON à sauvegarder: " . $json_content);
    
    // GESTION PERMISSIONS FICHIER - Vérification et correction des permissions d'écriture
    if (!is_writable($guestbook_file) && file_exists($guestbook_file)) {
        chmod($guestbook_file, 0666);
        error_log("Permissions modifiées pour le fichier");
    }
    
    // GESTION PERMISSIONS DOSSIER - Vérification et correction des permissions du dossier
    if (!is_writable(dirname($guestbook_file))) {
        chmod(dirname($guestbook_file), 0755);
        error_log("Permissions modifiées pour le dossier");
    }
    
    // ÉCRITURE FICHIER - Sauvegarde effective du contenu JSON
    $result = file_put_contents($guestbook_file, $json_content);
    
    // VÉRIFICATION SUCCÈS - Contrôle que l'écriture s'est bien déroulée
    if ($result !== false) {
        error_log("Sauvegarde réussie. Bytes écrits: " . $result);
        echo json_encode([
            'success' => true,
            'message' => $newMessage
        ]);
    } else {
        error_log("Erreur lors de l'écriture du fichier");
        echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'écriture du fichier']);
    }
} catch (Exception $e) {
    // GESTION EXCEPTIONS - Capture et log des erreurs inattendues
    error_log("Exception: " . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Erreur: ' . $e->getMessage()]);
}
?> 