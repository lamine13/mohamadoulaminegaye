<?php
header('Content-Type: application/json');

// Test simple pour vérifier les permissions et le chemin
$guestbook_file = __DIR__ . '/data/guestbook.json';

echo json_encode([
    'success' => true,
    'debug' => [
        'file_path' => $guestbook_file,
        'file_exists' => file_exists($guestbook_file),
        'is_writable' => is_writable($guestbook_file),
        'dir_writable' => is_writable(dirname($guestbook_file)),
        'current_dir' => __DIR__,
        'post_data' => $_POST
    ]
]);
?> 