<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
include __DIR__ . '/includes/header.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace membre – Cellule Numérique UN-CHK</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <main class="dashboard-main">
        <div class="dashboard-grid">
            <!-- Colonne gauche -->
            <section>
                <div class="dashboard-welcome card">
                    <h1>Bienvenue, <?= htmlspecialchars($_SESSION['user']['username']) ?> !</h1>
                    <!-- <p>Votre profil est activé.<br>
                        Vous êtes connecté à l’espace membre de la <span style="color:#639b42;font-weight:600;">Cellule
                            Numérique</span>.</p> -->
                </div>
                <div class="card info-card">
                    <h2 class="section-title">
                        <svg width="22" height="22" fill="none" stroke="#639b42" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                        Que pouvez-vous faire ici ?
                    </h2>
                    <div class="actions-grid">

                        <div class="action-block">
                            <div class="action-icon">
                                <svg width="32" height="32" fill="none" stroke="#fff" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            </div>
                            <div class="action-content">
                                <h3>Événements</h3>
                                <p>Participez aux événements comme le Coding Day et autres activités</p>
                            </div>
                        </div>
                        <div class="action-block">
                            <div class="action-icon">
                                <svg width="32" height="32" fill="none" stroke="#fff" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                    <path d="M8 9h8M8 13h6" />
                                </svg>
                            </div>
                            <div class="action-content">
                                <h3>Livre d'or</h3>
                                <p>Laissez un message et partagez votre expérience avec la communauté</p>
                            </div>
                        </div>
                        <div class="action-block">
                            <div class="action-icon">
                                <svg width="32" height="32" fill="none" stroke="#fff" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M4 4h16v16H4z" />
                                    <path d="M8 8h8v8H8z" />
                                </svg>
                            </div>
                            <div class="action-content">
                                <h3>Actualités</h3>
                                <p>Restez informé des dernières nouvelles et événements de la Cellule Numérique</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $events_path = __DIR__ . '/data/events.json';
                if (file_exists($events_path)) {
                    $events = json_decode(file_get_contents($events_path), true);
                    if (is_array($events) && count($events) > 0) {
                        echo '<div class="card" style="margin-bottom:0.5rem;"><h2 class="section-title"><svg width="22" height="22" fill="none" stroke="#639b42" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>Événements à venir</h2><div class="events-cards-row">';
                        $count = 0;
                        foreach (array_slice($events, 0, 4) as $event) {
                            echo '<div class="event-card-modern">';
                            echo '<div class="event-card-header">';
                            echo '<h2 class="event-card-title">' . htmlspecialchars($event['titre']) . '</h2>';
                            echo '</div>';
                            echo '<div class="event-card-content">';
                            // Date et heure
                            echo '<div class="event-card-info">';
                            echo '<div class="event-info-item">';
                            echo '<svg width="20" height="20" fill="none" stroke="#666" stroke-width="2" viewBox="0 0 24 24">';
                            echo '<rect x="3" y="4" width="18" height="18" rx="2" />';
                            echo '<path d="M16 2v4M8 2v4M3 10h18" />';
                            echo '</svg>';
                            echo '<span class="event-info-label">Date et heure</span>';
                            echo '</div>';
                            echo '<div class="event-info-value">' . htmlspecialchars($event['date']) . ', ' . htmlspecialchars($event['heure']) . '</div>';
                            echo '</div>';
                            // Lieu
                            echo '<div class="event-card-info">';
                            echo '<div class="event-info-item">';
                            echo '<svg width="20" height="20" fill="none" stroke="#666" stroke-width="2" viewBox="0 0 24 24">';
                            echo '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />';
                            echo '<circle cx="12" cy="10" r="3" />';
                            echo '</svg>';
                            echo '<span class="event-info-label">Lieu</span>';
                            echo '</div>';
                            echo '<div class="event-info-value">' . htmlspecialchars($event['lieu']) . ' — ' . htmlspecialchars($event['adresse']) . '</div>';
                            echo '</div>';
                            // Type d'événement
                            echo '<div class="event-card-info">';
                            echo '<div class="event-info-item">';
                            echo '<svg width="20" height="20" fill="none" stroke="#666" stroke-width="2" viewBox="0 0 24 24">';
                            echo '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />';
                            echo '</svg>';
                            echo '<span class="event-info-label">Type d\'événement</span>';
                            echo '</div>';
                            echo '<div class="event-info-value">' . htmlspecialchars($event['type']) . '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="event-card-footer">';
                            echo '<div class="event-ref">';
                            echo '<svg width="16" height="16" fill="#fff" viewBox="0 0 24 24">';
                            echo '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />';
                            echo '</svg>';
                            echo '<div class="event-ref-text">';
                            echo '<span class="event-ref-label">Ref :</span>';
                            echo '<span class="event-ref-number">' . htmlspecialchars($event['id']) . '</span>';
                            echo '</div>';
                            echo '</div>';
                            if ($event['inscription_requise']) {
                                echo '<div class="event-countdown">';
                                echo '<svg width="16" height="16" fill="#fff" viewBox="0 0 24 24">';
                                echo '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />';
                                echo '</svg>';
                                echo '<span class="event-countdown-text">' . $event['places_disponibles'] . ' places</span>';
                                echo '</div>';
                            }
                            echo '</div>';
                            echo '</div>';
                            $count++;
                            if ($count >= 4) break;
                        }
                        echo '</div></div>';
                    }
                }
                ?>

                <!-- Section Livre d'or -->
                <div class="card" style="margin-bottom:0.5rem;">
                    <h2 class="section-title">
                        <svg width="22" height="22" fill="none" stroke="#105da1" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                            <path d="M8 9h8M8 13h6" />
                        </svg>
                        Livre d'or
                    </h2>
                    <div class="guestbook-section">
                        <div class="guestbook-form">
                            <textarea placeholder="Partagez votre expérience avec la communauté..."
                                class="guestbook-textarea"></textarea>
                            <button class="guestbook-btn">Publier un message</button>
                        </div>
                        <div class="guestbook-messages">
                            <?php
                            $guestbook_path = __DIR__ . '/data/guestbook.json';
                            if (file_exists($guestbook_path)) {
                                $guestbook_messages = json_decode(file_get_contents($guestbook_path), true);
                                if (is_array($guestbook_messages) && count($guestbook_messages) > 0) {
                                    foreach (array_slice($guestbook_messages, 0, 5) as $msg) {
                                        // Calculer le temps écoulé
                                        $message_date = new DateTime($msg['date'] . ' ' . $msg['time']);
                                        $now = new DateTime();
                                        $interval = $now->diff($message_date);
                                        
                                        $time_ago = '';
                                        if ($interval->days > 0) {
                                            $time_ago = 'Il y a ' . $interval->days . ' jour' . ($interval->days > 1 ? 's' : '');
                                        } elseif ($interval->h > 0) {
                                            $time_ago = 'Il y a ' . $interval->h . ' heure' . ($interval->h > 1 ? 's' : '');
                                        } elseif ($interval->i > 0) {
                                            $time_ago = 'Il y a ' . $interval->i . ' minute' . ($interval->i > 1 ? 's' : '');
                                        } else {
                                            $time_ago = 'À l\'instant';
                                        }
                                        
                                        echo '<div class="guestbook-message">';
                                        echo '<div class="guestbook-avatar">' . htmlspecialchars($msg['initials']) . '</div>';
                                        echo '<div class="guestbook-content">';
                                        echo '<div class="guestbook-author">' . htmlspecialchars($msg['author']) . '</div>';
                                        echo '<div class="guestbook-text">' . htmlspecialchars($msg['message']) . '</div>';
                                        echo '<div class="guestbook-date">' . $time_ago . '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <?php
      $actus_path = __DIR__ . '/data/actualites.json';
      if (file_exists($actus_path)) {
          $actus = json_decode(file_get_contents($actus_path), true);
          if (is_array($actus) && count($actus) > 0) {
              echo '<div class="card" style="margin-bottom:0.5rem;"><h2 class="section-title"><svg width="22" height="22" fill="none" stroke="#105da1" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M8 8h8v8H8z"/></svg>Actualités récentes</h2><div class="actus-cards-row">';
              $count = 0;
              foreach (array_slice($actus, 0, 4) as $actu) {
                  // Déterminer la catégorie basée sur le titre
                  $categorie = "Actualité";
                  if (stripos($actu['titre'], 'coding day') !== false || stripos($actu['titre'], 'événement') !== false) {
                      $categorie = "Événement";
                  } elseif (stripos($actu['titre'], 'formation') !== false || stripos($actu['titre'], 'programme') !== false) {
                      $categorie = "Formation";
                  } elseif (stripos($actu['titre'], 'partenariat') !== false || stripos($actu['titre'], 'innovation') !== false) {
                      $categorie = "Innovation";
                  }
                  
                  echo '<div class="actus-card">';
                  // Image en haut
                  echo '<div class="actus-card-img">';
                  if (!empty($actu['image'])) {
                      echo '<img src="' . htmlspecialchars($actu['image']) . '" alt="' . htmlspecialchars($actu['titre']) . '">';
                  } else {
                      echo '<div style="width:100%;height:100%;background:linear-gradient(135deg,#105da1 0%,#639b42 100%);"></div>';
                  }
                  // Tag de catégorie
                  echo '<div class="actus-card-tag">' . $categorie . '</div>';
                  // Icône de favori
                  echo '<button class="actus-card-favorite"><svg width="18" height="18" fill="none" stroke="#666" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></button>';
                  echo '</div>';
                  // Contenu
                  echo '<div class="actus-card-content">';
                  // Métadonnées
                  echo '<div class="actus-card-meta">';
                  echo '<div class="actus-card-meta-item"><svg width="14" height="14" fill="none" stroke="#666" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg><span>' . htmlspecialchars($actu['date']) . '</span></div>';
                  echo '<div class="actus-card-meta-item"><svg width="14" height="14" fill="none" stroke="#666" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg><span>5 min</span></div>';
                  echo '<div class="actus-card-meta-item"><svg width="14" height="14" fill="none" stroke="#666" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg><span>8 commentaires</span></div>';
                  echo '</div>';
                  // Titre
                  echo '<h3 class="actus-card-title">' . htmlspecialchars($actu['titre']) . '</h3>';
                  // Auteur
                  echo '<div class="actus-card-author">';
                  echo '<div class="actus-card-author-avatar">CN</div>';
                  echo '<span>Cellule Numérique UN-CHK</span>';
                  echo '</div>';
                  // Footer avec bouton
                  echo '<div class="actus-card-footer">';
                  echo '<a href="#" class="actus-card-btn">Lire plus</a>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  $count++;
                  if ($count >= 4) break;
              }
              echo '</div></div>';
          }
      }
      ?>
            </section>
        </div>
    </main>
    <?php if (file_exists(__DIR__ . '/includes/footer.php')) include __DIR__ . '/includes/footer.php'; ?>
    <script src="./js/main.js"></script>
</body>

</html>