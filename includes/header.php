<header class="main-header">

    <div class="header-container">
        <div class="header-left">
            <img src="./img/logo.png" alt="Logo" class="header-logo">
            <div class="header-title">
                <span class="header-title-main">Cellule Numérique (Dakar)</span>
                <span class="header-title-sub">Université Virtuelle du Sénégal</span>
            </div>
        </div>
        <nav class="header-nav">
            <ul>
                <!-- Lien vers la page publique d'accueil -->
                <?php
                $currentPage = basename($_SERVER['PHP_SELF']);
                ?>
                <li<?php if ($currentPage === 'index.php') echo ' class="active"'; ?>><a href="./index.php">Accueil</a></li>
                <!-- Lien vers la page d'accueil sécurisée (après connexion) -->
                <li<?php if ($currentPage === 'accueil.php') echo ' class="active"'; ?>><a href="./accueil.php">Espace membre</a></li>
                <!-- Lien vers la page des finalistes -->
                <li<?php if ($currentPage === 'finalistes.php') echo ' class="active"'; ?>><a href="./finalistes.php">Finalistes</a></li>
                <!-- Lien vers la page à propos -->
                <li<?php if ($currentPage === 'a-propos.php') echo ' class="active"'; ?>><a href="./a-propos.php">À propos</a></li>
                <!-- Lien vers la page infos -->
                <li<?php if ($currentPage === 'infos.php') echo ' class="active"'; ?>><a href="./infos.php">Infos</a></li>
                <!-- Lien vers le livre d'or (bonus) -->
                <li<?php if ($currentPage === 'livre-or.php') echo ' class="active"'; ?>><a href="./livre-or.php">Livre d'or</a></li>
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
            <?php if (isset($_SESSION['user'])): ?>
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
            <a href="./login.php" class="login-btn">Connexion</a>
            <?php endif; ?>
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
<!-- Menu mobile modal (slide up) -->
<div class="mobile-menu-modal" id="mobileMenuModal" style="font-family: 'Orbitron', Arial, sans-serif;">
    <div class="mobile-menu-content">
        <button class="close-mobile-menu" id="closeMobileMenu" aria-label="Fermer le menu">&times;</button>
        <nav>
            <ul>
                <li><a href="./index.php">Accueil</a></li>
                <li><a href="./accueil.php">Espace membre</a></li>
                <li><a href="./finalistes.php">Finalistes</a></li>
                <li><a href="./a-propos.php">À propos</a></li>
                <li><a href="./infos.php">Infos</a></li>
                <li><a href="./livre-or.php">Livre d'or</a></li>
            </ul>
        </nav>
        <div class="mobile-menu-auth">
            <?php if (isset($_SESSION['user'])): ?>
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
            <a href="logout.php" class="logout-btn" style="margin-bottom:1.2rem;">Déconnexion</a>
            <?php else: ?>
            <a href="./login.php" class="login-btn2">Connexion</a>
            <?php endif; ?>
        </div>
        <div class="mobile-menu-footer">
            <div class="footer-info">
                &copy; 2025 Mohamadou Lamine Gaye — Auteur
            </div>
        </div>
    </div>
    <div class="mobile-menu-backdrop"></div>
</div>
<!-- Dropdown utilisateur (desktop/tablette) -->
<div id="userModal" class="user-modal" style="display:none;font-family: 'Orbitron', Arial, sans-serif;">
    <div class="user-modal-backdrop"></div>
    <div class="user-modal-content">
        <button class="user-modal-close" id="closeUserModal" aria-label="Fermer">&times;</button>
        <h3>Détails du compte</h3>
        <div class="user-modal-info">
            <div><strong>Pseudo :</strong> <?= htmlspecialchars($_SESSION['user']['username'] ?? '') ?></div>
            <div><strong>Email :</strong> <?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?></div>
            <div><strong>Rôle :</strong> <?= htmlspecialchars($_SESSION['user']['role'] ?? 'Utilisateur') ?></div>
        </div>
        <a href="logout.php" class="logout-btn">Déconnexion</a>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var userBtn = document.getElementById('userHeaderBtn');
    var userModal = document.getElementById('userModal');
    var userModalContent = userModal ? userModal.querySelector('.user-modal-content') : null;
    var closeUserModal = document.getElementById('closeUserModal');
    var userBackdrop = document.querySelector('.user-modal-backdrop');

    function positionDropdown() {
        if (!userBtn || !userModalContent) return;
        var rect = userBtn.getBoundingClientRect();
        var scrollTop = window.scrollY || document.documentElement.scrollTop;
        var scrollLeft = window.scrollX || document.documentElement.scrollLeft;
        userModalContent.style.position = 'absolute';
        userModalContent.style.left = (rect.left + scrollLeft) + 'px';
        userModalContent.style.top = (rect.bottom + scrollTop + 8) + 'px';
        userModalContent.style.margin = '0';
    }
    if (userBtn && userModal) {
        userBtn.addEventListener('click', function(e) {
            userModal.style.display = 'block';
            if (window.innerWidth > 700) {
                positionDropdown();
            } else {
                userModalContent.style.position = '';
                userModalContent.style.left = '';
                userModalContent.style.top = '';
                userModalContent.style.margin = '';
            }
        });
    }
    if (closeUserModal && userModal) {
        closeUserModal.addEventListener('click', function() {
            userModal.style.display = 'none';
        });
    }
    if (userBackdrop && userModal) {
        userBackdrop.addEventListener('click', function() {
            userModal.style.display = 'none';
        });
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && userModal.style.display === 'block') {
            userModal.style.display = 'none';
        }
    });
    window.addEventListener('resize', function() {
        if (userModal.style.display === 'block' && window.innerWidth > 700) {
            positionDropdown();
        }
    });
});
</script>