<?php
header('Content-Type: application/json');

// Activer les logs d'erreur
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log pour debug
error_log("save_guestbook.php appelé");

// Vérifier si c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    error_log("Méthode non autorisée: " . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
    exit;
}

// Vérifier si l'action est correcte
if (!isset($_POST['action']) || $_POST['action'] !== 'save_guestbook') {
    error_log("Action invalide: " . (isset($_POST['action']) ? $_POST['action'] : 'non définie'));
    echo json_encode(['success' => false, 'error' => 'Action invalide']);
    exit;
}

// Vérifier si le message est présent
if (!isset($_POST['message']) || empty(trim($_POST['message']))) {
    error_log("Message vide ou non défini");
    echo json_encode(['success' => false, 'error' => 'Message vide']);
    exit;
}

$message = trim($_POST['message']);
error_log("Message reçu: " . $message);

// Générer un ID unique
$id = 'GB_' . date('Y') . '_' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

// Générer des données aléatoires pour l'auteur
$firstNames = ['Alex', 'Bakary', 'Camara', 'Diop', 'Elise', 'Fatou', 'Gueye', 'Hawa', 'Ibrahima', 'Jules', 'Kadiatou', 'Lamine', 'Mariama', 'Ndiaye', 'Ousmane'];
$lastNames = ['Diallo', 'Sall', 'Gueye', 'Diop', 'Fall', 'Ba', 'Ndiaye', 'Cisse', 'Toure', 'Sy', 'Thiam', 'Mane', 'Sow', 'Dia', 'Kane'];

$firstName = $firstNames[array_rand($firstNames)];
$lastName = $lastNames[array_rand($lastNames)];
$author = $firstName . ' ' . $lastName;
$initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));

// Créer le nouveau message
$newMessage = [
    'id' => $id,
    'author' => $author,
    'initials' => $initials,
    'message' => $message,
    'date' => date('Y-m-d'),
    'time' => date('H:i'),
    'status' => 'published'
];

// Charger les messages existants
$guestbook_file = __DIR__ . '/data/guestbook.json';
$messages = [];

// Créer le dossier data s'il n'existe pas
$data_dir = __DIR__ . '/data';
if (!is_dir($data_dir)) {
    mkdir($data_dir, 0755, true);
    error_log("Dossier data créé: " . $data_dir);
}

// Créer le fichier s'il n'existe pas
if (!file_exists($guestbook_file)) {
    file_put_contents($guestbook_file, json_encode([], JSON_PRETTY_PRINT));
    error_log("Fichier guestbook.json créé: " . $guestbook_file);
}

if (file_exists($guestbook_file)) {
    $file_content = file_get_contents($guestbook_file);
    error_log("Contenu du fichier: " . $file_content);
    
    $messages = json_decode($file_content, true);
    if (!is_array($messages)) {
        $messages = [];
        error_log("JSON invalide, tableau vide créé");
    }
}

// Ajouter le nouveau message au début
array_unshift($messages, $newMessage);
error_log("Nouveau message ajouté. Total: " . count($messages));

// Limiter à 50 messages maximum
if (count($messages) > 50) {
    $messages = array_slice($messages, 0, 50);
    error_log("Messages limités à 50");
}

// Sauvegarder dans le fichier JSON
try {
    error_log("Tentative de sauvegarde dans: " . $guestbook_file);
    $json_content = json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    error_log("JSON à sauvegarder: " . $json_content);
    
    // Vérifier les permissions
    if (!is_writable($guestbook_file) && file_exists($guestbook_file)) {
        chmod($guestbook_file, 0666);
        error_log("Permissions modifiées pour le fichier");
    }
    
    if (!is_writable(dirname($guestbook_file))) {
        chmod(dirname($guestbook_file), 0755);
        error_log("Permissions modifiées pour le dossier");
    }
    
    $result = file_put_contents($guestbook_file, $json_content);
    
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
    error_log("Exception: " . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Erreur: ' . $e->getMessage()]);
}
?> 