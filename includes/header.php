<?php
// coding-day/includes/header.php
// Détection du chemin relatif pour les assets (CSS, images)
$basePath = dirname($_SERVER['SCRIPT_NAME']);
if ($basePath === '/' || $basePath === '\\') {
  $basePath = '';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coding Day</title>
    <!-- Police Orbitron pour un effet digital/technologique -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $basePath; ?>/css/style.css">
</head>

<body>
    <header class="main-header">
        <div class="header-container">
            <div class="header-left">
                <img src="<?php echo $basePath; ?>/img/logo.png" alt="Logo" class="header-logo">
                <div class="header-title">
                    <span class="header-title-main">Cellule Numérique (Dakar)</span>
                    <span class="header-title-sub">Université Virtuelle du Sénégal</span>
                </div>
            </div>
            <nav class="header-nav">
                <ul>
                    <!-- Lien vers la page publique d'accueil -->
                    <li class="active"><a href="<?php echo $basePath; ?>/index.php">Accueil</a></li>
                    <!-- Lien vers la page d'accueil sécurisée (après connexion) -->
                    <li><a href="<?php echo $basePath; ?>/accueil.php">Espace membre</a></li>
                    <!-- Lien vers la page des finalistes -->
                    <li><a href="<?php echo $basePath; ?>/finalistes.php">Finalistes</a></li>
                    <!-- Lien vers la page à propos -->
                    <li><a href="<?php echo $basePath; ?>/a-propos.php">À propos</a></li>
                    <!-- Lien vers la page infos -->
                    <li><a href="<?php echo $basePath; ?>/infos.php">Infos</a></li>
                    <!-- Lien vers le livre d'or (bonus) -->
                    <li><a href="<?php echo $basePath; ?>/livre-or.php">Livre d'or</a></li>
                </ul>
            </nav>
            <div class="header-right">
                <button class="search-btn" aria-label="Recherche" id="searchToggleBtn">
                    <svg width="20" height="20" fill="none" stroke="#6B7280" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7" />
                        <line x1="16.65" y1="16.65" x2="21" y2="21" />
                    </svg>
                </button>
                <form class="header-search-form" id="headerSearchForm" action="#" method="get" style="display:none;">
                    <input type="text" name="q" class="header-search-input" placeholder="Rechercher..."
                        autocomplete="off" />
                    <button type="button" class="close-search-btn" id="closeSearchBtn"
                        aria-label="Fermer la recherche">&times;</button>
                </form>
                <!-- Bouton Connexion vers login.php -->
                <a href="<?php echo $basePath; ?>/login.php" class="login-btn">Connexion</a>
                <!-- Burger menu pour tablette/mobile -->
                <button class="burger-menu" id="burgerMenuBtn" aria-label="Menu principal">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#105da1" stroke-width="2"
                        stroke-linecap="round">
                        <line x1="4" y1="7" x2="20" y2="7" />
                        <line x1="4" y1="12" x2="20" y2="12" />
                        <line x1="4" y1="17" x2="20" y2="17" />
                    </svg>
                </button>
            </div>
        </div>
    </header>
    <!-- Barre de navigation mobile en bas de l'écran -->
    <nav class="bottom-nav">
        <a href="<?php echo $basePath; ?>/index.php"
            class="bottom-link<?php if(basename($_SERVER['SCRIPT_NAME']) == 'index.php') echo ' active'; ?>"
            aria-label="Accueil">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M12.827 3.834a1.5 1.5 0 0 0-2.26.054L5 10.58v8.92A1.5 1.5 0 0 0 6.5 21h1.79a1.5 1.5 0 0 0 1.5-1.5v-3.011a1.5 1.5 0 0 1 1.5-1.5h1.42a1.5 1.5 0 0 1 1.5 1.5V19.5a1.5 1.5 0 0 0 1.5 1.5h1.79a1.5 1.5 0 0 0 1.5-1.5v-8.92z" />
            </svg>
            <span>Accueil</span>
        </a>
        <a href="<?php echo $basePath; ?>/accueil.php"
            class="bottom-link<?php if(basename($_SERVER['SCRIPT_NAME']) == 'accueil.php') echo ' active'; ?>"
            aria-label="Espace membre">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4" />
                <path d="M4 20c0-4 8-4 8-4s8 0 8 4" />
            </svg>
            <span>Membre</span>
        </a>
        <!-- <a href="<?php echo $basePath; ?>/finalistes.php" class="bottom-link<?php if(basename($_SERVER['SCRIPT_NAME']) == 'finalistes.php') echo ' active'; ?>" aria-label="Finalistes">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            <span>Finalistes</span>
        </a> -->
        <a href="<?php echo $basePath; ?>/infos.php"
            class="bottom-link<?php if(basename($_SERVER['SCRIPT_NAME']) == 'infos.php') echo ' active'; ?>"
            aria-label="Infos">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024">
                <path fill="currentColor"
                    d="M512 64a448 448 0 1 1 0 896.064A448 448 0 0 1 512 64m67.2 275.072c33.28 0 60.288-23.104 60.288-57.344s-27.072-57.344-60.288-57.344c-33.28 0-60.16 23.104-60.16 57.344s26.88 57.344 60.16 57.344M590.912 699.2c0-6.848 2.368-24.64 1.024-34.752l-52.608 60.544c-10.88 11.456-24.512 19.392-30.912 17.28a12.99 12.99 0 0 1-8.256-14.72l87.68-276.992c7.168-35.136-12.544-67.2-54.336-71.296c-44.096 0-108.992 44.736-148.48 101.504c0 6.784-1.28 23.68.064 33.792l52.544-60.608c10.88-11.328 23.552-19.328 29.952-17.152a12.8 12.8 0 0 1 7.808 16.128L388.48 728.576c-10.048 32.256 8.96 63.872 55.04 71.04c67.84 0 107.904-43.648 147.456-100.416z" />
            </svg>
            <span>Infos</span>
        </a>
    </nav>
    <!-- Menu modal mobile (slide up) -->
    <div id="mobileMenuModal" class="mobile-menu-modal">
        <div class="mobile-menu-content">
            <button class="close-mobile-menu" id="closeMobileMenu" aria-label="Fermer le menu">&times;</button>
            <nav>
                <ul>
                    <li><a href="<?php echo $basePath; ?>/index.php">Accueil</a></li>
                    <li><a href="<?php echo $basePath; ?>/accueil.php">Espace membre</a></li>
                    <li><a href="<?php echo $basePath; ?>/finalistes.php">Finalistes</a></li>
                    <li><a href="<?php echo $basePath; ?>/a-propos.php">À propos</a></li>
                    <li><a href="<?php echo $basePath; ?>/infos.php">Infos</a></li>
                    <li><a href="<?php echo $basePath; ?>/livre-or.php">Livre d'or</a></li>
                </ul>
            </nav>
            <div class="mobile-menu-auth">
                <?php
                if (session_status() === PHP_SESSION_NONE) session_start();
                if (isset($_SESSION['user'])) {
                    $user = $_SESSION['user'];
                    echo '<span class="user-info">Connecté : ' . htmlspecialchars($user['prenom']) . ' ' . htmlspecialchars($user['nom']) . '</span>';
                    echo ' <a href="' . $basePath . '/logout.php" class="logout-btn">Déconnexion</a>';
                } else {
                    echo '<a href="' . $basePath . '/login.php" class="login-btn2">Connexion</a>';
                }
                ?>
            </div>

            <div class="mobile-menu-footer">
                <div class="footer-info">
                    &copy; <?php echo date('Y'); ?> Mohamadou Lamine Gaye — Auteur
                </div>
            </div>
        </div>
        <div class="mobile-menu-backdrop"></div>
    </div>
    <!-- Script pour le burger menu (affichage nav principale sur mobile/tablette) -->
    <script>
    // (Le script du header a été déplacé dans js/main.js)
    </script>
    <script src="<?php echo $basePath; ?>/js/main.js"></script>
</body>