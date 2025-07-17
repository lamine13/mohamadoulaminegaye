// FICHIER JAVASCRIPT PRINCIPAL - Gestion des interactions utilisateur et animations
// Ce fichier contient toutes les fonctionnalités JavaScript pour l'interface utilisateur

// INITIALISATION PRINCIPALE - Exécution du code après chargement complet de la page
document.addEventListener('DOMContentLoaded', function() {
  // ANIMATIONS D'ENTRÉE - Effet de fade-in-up pour les éléments avec la classe fade-in-up
  // Chaque élément apparaît avec un délai progressif pour créer un effet cascade
  document.querySelectorAll('.fade-in-up').forEach(function(el, i) {
    setTimeout(() => el.classList.add('visible'), 200 + i * 150);
  });

  // DÉFILEMENT FLUIDE - Gestion du scroll smooth pour les liens internes
  // Permet une navigation fluide vers les sections de la page
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });

  // EFFET PARALLAX - Animation du fond de la section hero lors du défilement
  // Crée un effet de profondeur en déplaçant le background plus lentement que le scroll
  const hero = document.querySelector('.hero');
  if(hero) {
    window.addEventListener('scroll', function() {
      let offset = window.scrollY * 0.3;
      hero.style.backgroundPosition = `center calc(50% + ${offset}px)`;
    });
  }

  // CARROUSEL TÉMOIGNAGES - Rotation automatique des témoignages
  // Affiche un témoignage différent toutes les 4 secondes
  const carousel = document.getElementById('carouselTemoignages');
  if(carousel) {
    let index = 0;
    const items = carousel.children;
    setInterval(() => {
      for(let i=0; i<items.length; i++) items[i].style.display = 'none';
      items[index].style.display = 'block';
      index = (index + 1) % items.length;
    }, 4000);
  }
});

// GESTION HEADER - Script pour la navigation mobile et la recherche
// ---------------------------------------------------------------

// SÉLECTION ÉLÉMENTS DOM - Récupération de tous les éléments HTML nécessaires
const burgerBtn = document.getElementById('burgerMenuBtn');           // Bouton menu burger
const headerNav = document.querySelector('.header-nav ul');          // Navigation desktop
const mobileMenu = document.getElementById('mobileMenuModal');        // Modal menu mobile
const closeMobileMenu = document.getElementById('closeMobileMenu');   // Bouton fermeture mobile
const mobileBackdrop = document.querySelector('.mobile-menu-backdrop'); // Arrière-plan modal
const searchToggleBtn = document.getElementById('searchToggleBtn');   // Bouton recherche
const headerSearchForm = document.getElementById('headerSearchForm'); // Formulaire recherche
const closeSearchBtn = document.getElementById('closeSearchBtn');     // Bouton fermeture recherche

// --- GESTION MENU BURGER MOBILE - Navigation adaptée aux appareils mobiles ---

// DÉTECTION APPAREIL MOBILE - Fonction pour identifier les écrans mobiles et tablettes
function isMobileOrSurfacePro() {
    return window.innerWidth <= 1024;
}

// OUVERTURE MENU MOBILE - Affichage du modal de navigation mobile
function openMobileMenu() {
    if (mobileMenu) {
        mobileMenu.classList.add('active');
        document.body.style.overflow = 'hidden'; // Empêche le scroll de la page
    }
}

// FERMETURE MENU MOBILE - Masquage du modal de navigation mobile
function closeMobileMenuFunc() {
    if (mobileMenu) {
        mobileMenu.classList.remove('active');
        document.body.style.overflow = ''; // Restaure le scroll de la page
    }
}

// GESTION CLIC BURGER - Ouverture du menu selon le type d'appareil
if (burgerBtn) {
    burgerBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // Empêche la propagation du clic
        if (isMobileOrSurfacePro()) {
            openMobileMenu(); // Ouverture modal sur mobile
        } else {
            if (headerNav) {
                headerNav.classList.toggle('show'); // Toggle navigation desktop
            }
        }
    });
}

// GESTION FERMETURE MODAL - Fermeture via le bouton X
if (closeMobileMenu && mobileMenu) {
    closeMobileMenu.addEventListener('click', (e) => {
        e.stopPropagation();
        closeMobileMenuFunc();
    });
}

// GESTION CLIC ARRIÈRE-PLAN - Fermeture en cliquant à l'extérieur du modal
if (mobileBackdrop && mobileMenu) {
    mobileBackdrop.addEventListener('click', (e) => {
        e.stopPropagation();
        closeMobileMenuFunc();
    });
}

// GESTION REDIMENSIONNEMENT - Fermeture automatique du menu lors du passage en desktop
window.addEventListener('resize', () => {
    if (!isMobileOrSurfacePro()) {
        closeMobileMenuFunc();
    }
});

// --- GESTION RECHERCHE ANIMÉE - Interface de recherche dans le header ---

// OUVERTURE RECHERCHE - Affichage du formulaire de recherche avec animation
function openSearch() {
    if (headerSearchForm) {
        headerSearchForm.style.display = 'flex';
        setTimeout(() => headerSearchForm.classList.add('active'), 10);
        document.querySelector('.header-search-input').focus(); // Focus automatique
    }
}

// FERMETURE RECHERCHE - Masquage du formulaire de recherche avec animation
function closeSearch() {
    if (headerSearchForm) {
        headerSearchForm.classList.remove('active');
        setTimeout(() => headerSearchForm.style.display = 'none', 250);
    }
}

// GESTION CLIC RECHERCHE - Ouverture du formulaire de recherche
if (searchToggleBtn && headerSearchForm) {
    searchToggleBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        openSearch();
    });
}

// GESTION FERMETURE RECHERCHE - Fermeture via le bouton X
if (closeSearchBtn) {
    closeSearchBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        closeSearch();
    });
}

// GESTION TOUCHE ÉCHAP - Fermeture de la recherche avec la touche Escape
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeSearch();
}); 

// GESTION LIVRE D'OR - Fonctionnalité de publication de messages communautaires
document.addEventListener('DOMContentLoaded', function() {
    // SÉLECTION ÉLÉMENTS LIVRE D'OR - Récupération des éléments de l'interface
    const guestbookForm = document.querySelector('.guestbook-form');        // Conteneur du formulaire
    const guestbookTextarea = document.querySelector('.guestbook-textarea'); // Zone de saisie
    const guestbookBtn = document.querySelector('.guestbook-btn');          // Bouton de publication
    const guestbookMessages = document.querySelector('.guestbook-messages'); // Conteneur des messages

    // VÉRIFICATION ÉLÉMENTS - Contrôle que tous les éléments nécessaires sont présents
    if (guestbookBtn && guestbookTextarea && guestbookMessages) {
        
        // GESTION CLIC PUBLICATION - Traitement de la publication d'un message
        guestbookBtn.addEventListener('click', function() {
            console.log('Bouton cliqué');
            const message = guestbookTextarea.value.trim(); // Récupération et nettoyage du message
            console.log('Message:', message);
            
            // VALIDATION MESSAGE - Vérification que le message n'est pas vide
            if (message.length === 0) {
                console.log('Message vide');
                // ANIMATION ERREUR - Effet visuel pour indiquer l'erreur
                guestbookTextarea.style.borderColor = '#dc3545';
                guestbookTextarea.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
                
                // RESTAURATION STYLE - Retour à l'apparence normale après 2 secondes
                setTimeout(() => {
                    guestbookTextarea.style.borderColor = '#e9ecef';
                    guestbookTextarea.style.boxShadow = 'none';
                }, 2000);
                return;
            }

            // DÉSACTIVATION BOUTON - Évite les clics multiples pendant l'envoi
            guestbookBtn.disabled = true;
            guestbookBtn.textContent = 'Envoi en cours...';

            // CRÉATION MESSAGE - Génération de l'élément HTML du nouveau message
            const newMessage = createGuestbookMessage(message);
            console.log('Nouveau message créé:', newMessage);
            
            // SAUVEGARDE AJAX - Envoi du message au serveur via requête AJAX
            saveGuestbookMessage(message, newMessage);
            
            // ANIMATION APPARITION - Effet de fade-in pour le nouveau message
            newMessage.style.opacity = '0';
            newMessage.style.transform = 'translateY(-20px)';
            
            setTimeout(() => {
                newMessage.style.transition = 'all 0.5s ease';
                newMessage.style.opacity = '1';
                newMessage.style.transform = 'translateY(0)';
            }, 100);

            // VIDAGE ZONE SAISIE - Réinitialisation du champ de saisie
            guestbookTextarea.value = '';
            
            // ANIMATION SUCCÈS - Confirmation visuelle de la publication
            guestbookBtn.textContent = 'Message publié !';
            guestbookBtn.style.background = 'linear-gradient(135deg, #105da1 0%, #105da1 100%)';
            
            // RESTAURATION BOUTON - Retour à l'état initial après 2 secondes
            setTimeout(() => {
                guestbookBtn.textContent = 'Publier un message';
                guestbookBtn.style.background = 'linear-gradient(135deg, var(--main-blue) 0%, var(--main-green) 100%)';
            }, 2000);
        });

        // GESTION TOUCHE ENTRÉE - Permet l'envoi du message avec la touche Entrée
        // Shift+Entrée permet toujours d'aller à la ligne
        guestbookTextarea.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                guestbookBtn.click();
            }
        });
    }
});

// FONCTION CRÉATION MESSAGE - Génération de l'élément HTML pour un nouveau message
// Cette fonction crée la structure HTML d'un message avec des données temporaires
function createGuestbookMessage(message) {
    const messageDiv = document.createElement('div');
    messageDiv.className = 'guestbook-message';
    
    // DONNÉES TEMPORAIRES - Valeurs par défaut qui seront remplacées par le serveur
    // Ces valeurs sont utilisées pour l'affichage immédiat, puis mises à jour avec les vraies données
    const initials = 'U'; // Initiales temporaires
    const authorName = 'Utilisateur'; // Nom temporaire
    
    // STRUCTURE HTML - Création de la structure complète du message
    messageDiv.innerHTML = `
        <div class="guestbook-avatar">${initials}</div>
        <div class="guestbook-content">
            <div class="guestbook-author">${authorName}</div>
            <div class="guestbook-text">${escapeHtml(message)}</div>
            <div class="guestbook-date">À l'instant</div>
        </div>
    `;
    
    return messageDiv;
}

// FONCTION SÉCURITÉ XSS - Protection contre les attaques Cross-Site Scripting
// Cette fonction échappe les caractères spéciaux pour empêcher l'injection de code malveillant
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text; // Utilisation de textContent pour échapper automatiquement
    return div.innerHTML;
}

// FONCTION SAUVEGARDE AJAX - Envoi du message au serveur via requête AJAX
// Cette fonction gère la communication avec le serveur pour sauvegarder le message
function saveGuestbookMessage(message, messageElement) {
    console.log('Début de saveGuestbookMessage');
    
    // PRÉPARATION DONNÉES - Création du FormData pour l'envoi des données
    const formData = new FormData();
    formData.append('message', message);           // Contenu du message
    formData.append('action', 'save_guestbook');   // Action à effectuer
    
    console.log('Envoi de la requête à save_guestbook.php');
    
    // REQUÊTE FETCH - Envoi de la requête POST vers le serveur
    fetch('save_guestbook.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log('Réponse reçue:', response);
        return response.json(); // Conversion de la réponse en JSON
    })
    .then(data => {
        console.log('Données reçues:', data);
        
        // TRAITEMENT SUCCÈS - Mise à jour de l'interface en cas de succès
        if (data.success) {
            // MISE À JOUR DONNÉES - Remplacement des données temporaires par les vraies données du serveur
            const serverMessage = data.message;
            messageElement.querySelector('.guestbook-avatar').textContent = serverMessage.initials;
            messageElement.querySelector('.guestbook-author').textContent = serverMessage.author;
            
            // INSERTION MESSAGE - Ajout du message au début de la liste des messages
            const guestbookMessages = document.querySelector('.guestbook-messages');
            guestbookMessages.insertBefore(messageElement, guestbookMessages.firstChild);
            
            // ANIMATION APPARITION - Effet visuel pour l'apparition du nouveau message
            messageElement.style.opacity = '0';
            messageElement.style.transform = 'translateY(-20px)';
            
            setTimeout(() => {
                messageElement.style.transition = 'all 0.5s ease';
                messageElement.style.opacity = '1';
                messageElement.style.transform = 'translateY(0)';
            }, 100);

            // VIDAGE ZONE SAISIE - Réinitialisation du champ de saisie
            const guestbookTextarea = document.querySelector('.guestbook-textarea');
            guestbookTextarea.value = '';
            
            // CONFIRMATION SUCCÈS - Animation de confirmation sur le bouton
            const guestbookBtn = document.querySelector('.guestbook-btn');
            guestbookBtn.textContent = 'Message publié !';
            guestbookBtn.style.background = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
            
            // RESTAURATION BOUTON - Retour à l'état initial après 2 secondes
            setTimeout(() => {
                guestbookBtn.disabled = false;
                guestbookBtn.textContent = 'Publier un message';
                guestbookBtn.style.background = 'linear-gradient(135deg, var(--main-blue) 0%, var(--main-green) 100%)';
            }, 2000);
        } else {
            // GESTION ERREUR SERVEUR - Affichage de l'erreur retournée par le serveur
            console.error('Erreur lors de la sauvegarde:', data.error);
            alert('Erreur lors de la sauvegarde du message: ' + data.error);
            
            // RÉACTIVATION BOUTON - Réactivation du bouton en cas d'erreur
            const guestbookBtn = document.querySelector('.guestbook-btn');
            guestbookBtn.disabled = false;
            guestbookBtn.textContent = 'Publier un message';
        }
    })
    .catch(error => {
        // GESTION ERREUR RÉSEAU - Capture des erreurs de connexion ou de réseau
        console.error('Erreur:', error);
        alert('Erreur de connexion: ' + error.message);
        
        // RÉACTIVATION BOUTON - Réactivation du bouton en cas d'erreur réseau
        const guestbookBtn = document.querySelector('.guestbook-btn');
        guestbookBtn.disabled = false;
        guestbookBtn.textContent = 'Publier un message';
    });
}

// ANIMATION MESSAGES EXISTANTS - Effet d'apparition progressive des messages au chargement
// Cette fonction anime les messages déjà présents dans la page lors du chargement initial
document.addEventListener('DOMContentLoaded', function() {
    const existingMessages = document.querySelectorAll('.guestbook-message');
    
    // ANIMATION CASCADE - Chaque message apparaît avec un délai progressif
    existingMessages.forEach((message, index) => {
        // ÉTAT INITIAL - Message invisible et décalé vers le bas
        message.style.opacity = '0';
        message.style.transform = 'translateY(20px)';
        
        // ANIMATION DÉCALÉE - Apparition progressive avec délai selon l'index
        setTimeout(() => {
            message.style.transition = 'all 0.5s ease';
            message.style.opacity = '1';
            message.style.transform = 'translateY(0)';
        }, index * 200); // Délai de 200ms entre chaque message
    });
}); 