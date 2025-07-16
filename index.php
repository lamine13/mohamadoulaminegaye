<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coding Day</title>
    <!-- Police Orbitron pour un effet digital/technologique -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <!-- Barre de navigation mobile en bas de l'écran -->
    <nav class="bottom-nav">
        <a href="./index.php" class="bottom-link active" aria-label="Accueil">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor"
                    d="M12.827 3.834a1.5 1.5 0 0 0-2.26.054L5 10.58v8.92A1.5 1.5 0 0 0 6.5 21h1.79a1.5 1.5 0 0 0 1.5-1.5v-3.011a1.5 1.5 0 0 1 1.5-1.5h1.42a1.5 1.5 0 0 1 1.5 1.5V19.5a1.5 1.5 0 0 0 1.5 1.5h1.79a1.5 1.5 0 0 0 1.5-1.5v-8.92z" />
            </svg>
            <span>Accueil</span>
        </a>
        <a href="./accueil.php" class="bottom-link" aria-label="Espace membre">
            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4" />
                <path d="M4 20c0-4 8-4 8-4s8 0 8 4" />
            </svg>
            <span>Membre</span>
        </a>
        <a href="./infos.php" class="bottom-link" aria-label="Infos">
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
                    <li><a href="./index.php">Accueil</a></li>
                    <li><a href="./accueil.php">Espace membre</a></li>
                    <li><a href="./finalistes.php">Finalistes</a></li>
                    <li><a href="./a-propos.php">À propos</a></li>
                    <li><a href="./infos.php">Infos</a></li>
                    <li><a href="./livre-or.php">Livre d'or</a></li>
                </ul>
            </nav>
            <div class="mobile-menu-auth">
                <a href="./login.php" class="login-btn2">Connexion</a>
            </div>

            <div class="mobile-menu-footer">
                <div class="footer-info">
                    &copy; 2025 Mohamadou Lamine Gaye — Auteur
                </div>
            </div>
        </div>
        <div class="mobile-menu-backdrop"></div>
    </div>
    <!-- Script pour le burger menu (affichage nav principale sur mobile/tablette) -->
    <script>
    // Gestion du burger menu (headerNav) ET du menu modal mobile (slide up)
    const burgerBtn = document.getElementById('burgerMenuBtn');
    const headerNav = document.querySelector('.header-nav ul');
    const mobileMenu = document.getElementById('mobileMenuModal');
    const closeMobileMenu = document.getElementById('closeMobileMenu');
    const mobileBackdrop = document.querySelector('.mobile-menu-backdrop');

    if (burgerBtn) {
        // Pour tablette : toggle menu principal
        if (headerNav) {
            burgerBtn.addEventListener('click', () => {
                headerNav.classList.toggle('show');
            });
        }
        // Pour mobile : ouvrir le menu modal
        if (mobileMenu) {
            burgerBtn.addEventListener('click', () => {
                mobileMenu.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        }
    }
    if (closeMobileMenu && mobileMenu) {
        closeMobileMenu.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    if (mobileBackdrop && mobileMenu) {
        mobileBackdrop.addEventListener('click', () => {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    </script>
    <script src="./js/main.js"></script>
</body>

</html>