<!-- EN-TÊTE PRINCIPAL - Barre de navigation globale du site -->
<!-- Cette section contient le logo, la navigation et les éléments d'authentification -->

<header class="main-header">

    <div class="header-container">
        <!-- SECTION BRANDING - Logo et identité visuelle de l'institution -->
        <div class="header-left">
            <img src="./img/logo.png" alt="Logo" class="header-logo">
            <div class="header-title">
                <span class="header-title-main">Cellule Numérique (Dakar)</span>
                <span class="header-title-sub">Université UNCHK</span>
            </div>
        </div>

        <!-- NAVIGATION PRINCIPALE - Menu de navigation entre les pages du site -->
        <nav class="header-nav">
            <ul>
                <!-- DÉTECTION DE PAGE ACTIVE - Identification de la page courante pour le menu -->
                <?php
                // Récupération du nom du fichier PHP actuel pour déterminer la page active
                $currentPage = basename($_SERVER['PHP_SELF']);
                ?>

                <!-- LIEN ACCUEIL PUBLIC - Page d'accueil accessible à tous les visiteurs -->
                <li<?php if ($currentPage === 'index.php') echo ' class="active"'; ?>><a href="./index.php">Accueil</a>
                    </li>

                    <!-- LIEN ESPACE MEMBRE - Zone sécurisée réservée aux utilisateurs connectés -->
                    <li<?php if ($currentPage === 'accueil.php') echo ' class="active"'; ?>><a
                            href="./accueil.php">Espace membre</a></li>


                        <!-- LIEN À PROPOS - Page d'informations sur la Cellule Numérique -->
                        <li<?php if ($currentPage === 'a-propos.php') echo ' class="active"'; ?>><a
                                href="./a-propos.php">À propos</a></li>
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                            <li<?php if ($currentPage === 'ajouter_actualite.php') echo ' class="active"'; ?>><a
                                    href="./ajouter_actualite.php">Ajouter une actualité</a></li>
                                <?php endif; ?>
            </ul>
        </nav>

        <!-- SECTION UTILISATEUR - Éléments d'authentification et recherche -->
        <div class="header-right">
            <!-- BOUTON RECHERCHE - Activation du formulaire de recherche -->
            <button class="search-btn" aria-label="Recherche" id="searchToggleBtn">
                <svg width="20" height="20" fill="none" stroke="#6B7280" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7" />
                    <line x1="16.65" y1="16.65" x2="21" y2="21" />
                </svg>
            </button>

            <!-- FORMULAIRE RECHERCHE - Interface de recherche avec champ de saisie -->
            <form class="header-search-form" id="headerSearchForm" action="recherche.php" method="get"
                style="display:none;">
                <input type="text" name="q" class="header-search-input" placeholder="Rechercher..."
                    autocomplete="off" />
                <button type="submit" class="search-submit-btn" aria-label="Rechercher"
                    style="background:none;border:none;cursor:pointer;padding:0 8px;display:flex;align-items:center;">
                    <svg width="20" height="20" fill="none" stroke="#105da1" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7" />
                        <line x1="16.65" y1="16.65" x2="21" y2="21" />
                    </svg>
                </button>
                <button type="button" class="close-search-btn" id="closeSearchBtn"
                    aria-label="Fermer la recherche">&times;</button>
            </form>

            <!-- GESTION UTILISATEUR CONNECTÉ - Affichage des informations utilisateur -->
            <?php if (isset($_SESSION['user'])): ?>
            <!-- PROFIL UTILISATEUR - Affichage du nom et email de l'utilisateur connecté -->
            <div class="user-info-header user-header-desktop" id="userHeaderBtn" style="cursor:pointer;">
                <span class="user-header-avatar">
                    <svg width="22" height="22" fill="none" stroke="#105da1" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 20c0-4 8-4 8-4s8 0 8 4" />
                    </svg>
                </span>
                <div style="display:flex;flex-direction:column;line-height:1.1;">
                    <span style="font-weight:700;font-size:1.05rem;">
                        <?= htmlspecialchars($_SESSION['user']['username']) ?>
                    </span>
                    <span style="font-size:0.98rem;color:#444;">
                        <?= htmlspecialchars($_SESSION['user']['email']) ?>
                    </span>
                </div>
            </div>
            <?php else: ?>
            <!-- BOUTON CONNEXION - Lien vers la page de connexion pour les visiteurs non connectés -->
            <a href="./login.php" class="login-btn">Connexion</a>
            <?php endif; ?>

            <!-- MENU BURGER MOBILE - Bouton de menu pour les appareils mobiles -->
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

<!-- MODAL MENU MOBILE - Interface de navigation pour les appareils mobiles -->
<!-- Ce modal s'affiche en slide-up pour remplacer la navigation desktop sur mobile -->
<div class="mobile-menu-modal" id="mobileMenuModal" style="font-family: 'Orbitron', Arial, sans-serif;">
    <div class="mobile-menu-content">
        <!-- BOUTON FERMETURE - Fermeture du menu mobile -->
        <button class="close-mobile-menu" id="closeMobileMenu" aria-label="Fermer le menu">&times;</button>

        <!-- NAVIGATION MOBILE - Menu de navigation adapté aux écrans tactiles -->
        <nav>
            <ul>
                <li><a href="./index.php">Accueil</a></li>
                <li><a href="./accueil.php">Espace membre</a></li>
                <li><a href="./a-propos.php">À propos</a></li>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <li<?php if ($currentPage === 'ajouter_actualite.php') echo ' class="active"'; ?>><a
                        href="./ajouter_actualite.php">Ajouter une actualité</a></li>
                    <?php endif; ?>
            </ul>
        </nav>

        <!-- SECTION AUTHENTIFICATION MOBILE - Gestion de connexion/déconnexion -->
        <div class="mobile-menu-auth">
            <?php if (isset($_SESSION['user'])): ?>
            <!-- PROFIL UTILISATEUR MOBILE - Affichage des informations utilisateur sur mobile -->
            <div class="user-header-mobile">
                <span class="user-header-avatar">
                    <svg width="22" height="22" fill="none" stroke="#105da1" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 20c0-4 8-4 8-4s8 0 8 4" />
                    </svg>
                </span>
                <div>
                    <span><?= htmlspecialchars($_SESSION['user']['username']) ?></span>
                    <span><?= htmlspecialchars($_SESSION['user']['email']) ?></span>
                </div>
            </div>
            <!-- BOUTON DÉCONNEXION MOBILE - Déconnexion de l'utilisateur -->
            <a href="logout.php" class="logout-btn" style="margin-bottom:1.2rem;">Déconnexion</a>
            <?php else: ?>
            <!-- BOUTON CONNEXION MOBILE - Accès à la page de connexion -->
            <a href="./login.php" class="login-btn2">Connexion</a>
            <?php endif; ?>
        </div>

        <!-- PIED DE PAGE MOBILE - Informations de copyright -->
        <div class="mobile-menu-footer">
            <div class="footer-info">
                &copy; 2025 Mohamadou Lamine Gaye — Auteur
            </div>
        </div>
    </div>
    <!-- ARRIÈRE-PLAN MODAL - Overlay pour fermer le menu en cliquant à l'extérieur -->
    <div class="mobile-menu-backdrop"></div>
</div>

<!-- MODAL UTILISATEUR DESKTOP - Popup d'informations utilisateur détaillées -->
<!-- Ce modal s'affiche en dropdown pour les écrans desktop et tablette -->
<div id="userModal" class="user-modal" style="display:none;font-family: 'Orbitron', Arial, sans-serif;">
    <!-- ARRIÈRE-PLAN MODAL - Overlay pour fermer le modal -->


    <!-- CONTENU MODAL - Détails du compte utilisateur -->
    <div class="user-modal-content">
        <!-- BOUTON FERMETURE - Fermeture du modal utilisateur -->
        <button class="user-modal-close" id="closeUserModal" aria-label="Fermer">&times;</button>

        <!-- TITRE MODAL - En-tête du modal d'informations -->
        <h3>Détails du compte</h3>

        <!-- INFORMATIONS UTILISATEUR - Affichage des données du compte -->
        <div class="user-modal-info">
            <div><strong>Pseudo :</strong> <?= htmlspecialchars($_SESSION['user']['username'] ?? '') ?></div>
            <div><strong>Email :</strong> <?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?></div>
            <div><strong>Rôle :</strong> <?= htmlspecialchars($_SESSION['user']['role'] ?? 'Utilisateur') ?></div>
        </div>

        <!-- BOUTON DÉCONNEXION - Déconnexion de l'utilisateur -->
        <a href="logout.php" class="logout-btn">Déconnexion</a>
    </div>
</div>

<!-- SCRIPT JAVASCRIPT - Gestion des interactions utilisateur -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // RÉCUPÉRATION DES ÉLÉMENTS DOM - Sélection des éléments HTML nécessaires
    var userBtn = document.getElementById('userHeaderBtn');
    var userModal = document.getElementById('userModal');
    var userModalContent = userModal ? userModal.querySelector('.user-modal-content') : null;
    var closeUserModal = document.getElementById('closeUserModal');
    var userBackdrop = document.querySelector('.user-modal-backdrop');

    // FONCTION POSITIONNEMENT - Calcul de la position du dropdown utilisateur
    function positionDropdown() {
        if (!userBtn || !userModalContent) return;
        if (window.innerWidth > 700) {
            userModalContent.style.position = 'fixed';
            userModalContent.style.top = '90px';
            userModalContent.style.right = '0';
            userModalContent.style.left = '';
            userModalContent.style.margin = '0';
        } else {
            userModalContent.style.position = '';
            userModalContent.style.left = '';
            userModalContent.style.top = '';
            userModalContent.style.right = '';
            userModalContent.style.margin = '';
        }
    }

    // GESTION CLIC UTILISATEUR - Ouverture du modal utilisateur
    if (userBtn && userModal) {
        userBtn.addEventListener('click', function(e) {
            userModal.style.display = 'block';

            // ADAPTATION RESPONSIVE - Positionnement différent selon la taille d'écran
            if (window.innerWidth > 700) {
                positionDropdown();
            } else {
                // RÉINITIALISATION POSITION - Retour au positionnement par défaut sur mobile
                userModalContent.style.position = '';
                userModalContent.style.left = '';
                userModalContent.style.top = '';
                userModalContent.style.margin = '';
            }
        });
    }

    // GESTION FERMETURE MODAL - Fermeture via le bouton X
    if (closeUserModal && userModal) {
        closeUserModal.addEventListener('click', function() {
            userModal.style.display = 'none';
        });
    }

    // GESTION CLIC ARRIÈRE-PLAN - Fermeture en cliquant à l'extérieur du modal
    if (userBackdrop && userModal) {
        userBackdrop.addEventListener('click', function() {
            userModal.style.display = 'none';
        });
    }

    // GESTION TOUCHE ÉCHAP - Fermeture du modal avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && userModal.style.display === 'block') {
            userModal.style.display = 'none';
        }
    });

    // GESTION REDIMENSIONNEMENT - Repositionnement lors du changement de taille d'écran
    window.addEventListener('resize', function() {
        if (userModal.style.display === 'block' && window.innerWidth > 700) {
            positionDropdown();
        }
    });
});
</script>