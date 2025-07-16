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
                <li class="active"><a href="./index.php">Accueil</a></li>
                <!-- Lien vers la page d'accueil sécurisée (après connexion) -->
                <li><a href="./accueil.php">Espace membre</a></li>
                <!-- Lien vers la page des finalistes -->
                <li><a href="./finalistes.php">Finalistes</a></li>
                <!-- Lien vers la page à propos -->
                <li><a href="./a-propos.php">À propos</a></li>
                <!-- Lien vers la page infos -->
                <li><a href="./infos.php">Infos</a></li>
                <!-- Lien vers le livre d'or (bonus) -->
                <li><a href="./livre-or.php">Livre d'or</a></li>
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
            <a href="./login.php" class="login-btn">Connexion</a>
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