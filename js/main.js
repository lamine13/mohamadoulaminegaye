// coding-day/js/main.js

document.addEventListener('DOMContentLoaded', function() {
  // Animation d'entrée fade-in-up
  document.querySelectorAll('.fade-in-up').forEach(function(el, i) {
    setTimeout(() => el.classList.add('visible'), 200 + i * 150);
  });

  // Smooth scroll pour les liens internes
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });

  // Parallax sur le hero
  const hero = document.querySelector('.hero');
  if(hero) {
    window.addEventListener('scroll', function() {
      let offset = window.scrollY * 0.3;
      hero.style.backgroundPosition = `center calc(50% + ${offset}px)`;
    });
  }

  // Carousel témoignages (simple)
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

// Script du header : gestion du burger menu mobile et de la recherche animée
// ---------------------------------------------------------------

// Sélection des éléments du DOM
const burgerBtn = document.getElementById('burgerMenuBtn');
const headerNav = document.querySelector('.header-nav ul');
const mobileMenu = document.getElementById('mobileMenuModal');
const closeMobileMenu = document.getElementById('closeMobileMenu');
const mobileBackdrop = document.querySelector('.mobile-menu-backdrop');
const searchToggleBtn = document.getElementById('searchToggleBtn');
const headerSearchForm = document.getElementById('headerSearchForm');
const closeSearchBtn = document.getElementById('closeSearchBtn');

// --- Gestion du burger menu mobile ---
function isMobileOrSurfacePro() {
    return window.innerWidth <= 1024;
}
function openMobileMenu() {
    if (mobileMenu) {
        mobileMenu.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}
function closeMobileMenuFunc() {
    if (mobileMenu) {
        mobileMenu.classList.remove('active');
        document.body.style.overflow = '';
    }
}
if (burgerBtn) {
    burgerBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        if (isMobileOrSurfacePro()) {
            openMobileMenu();
        } else {
            if (headerNav) {
                headerNav.classList.toggle('show');
            }
        }
    });
}
if (closeMobileMenu && mobileMenu) {
    closeMobileMenu.addEventListener('click', (e) => {
        e.stopPropagation();
        closeMobileMenuFunc();
    });
}
if (mobileBackdrop && mobileMenu) {
    mobileBackdrop.addEventListener('click', (e) => {
        e.stopPropagation();
        closeMobileMenuFunc();
    });
}
// Fermer le menu si on resize au-dessus de 1024px
window.addEventListener('resize', () => {
    if (!isMobileOrSurfacePro()) {
        closeMobileMenuFunc();
    }
});

// --- Gestion de la recherche animée dans le header ---
function openSearch() {
    if (headerSearchForm) {
        headerSearchForm.style.display = 'flex';
        setTimeout(() => headerSearchForm.classList.add('active'), 10);
        document.querySelector('.header-search-input').focus();
    }
}
function closeSearch() {
    if (headerSearchForm) {
        headerSearchForm.classList.remove('active');
        setTimeout(() => headerSearchForm.style.display = 'none', 250);
    }
}
if (searchToggleBtn && headerSearchForm) {
    searchToggleBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        openSearch();
    });
}
if (closeSearchBtn) {
    closeSearchBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        closeSearch();
    });
}
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeSearch();
}); 

// Gestion du livre d'or
document.addEventListener('DOMContentLoaded', function() {
    const guestbookForm = document.querySelector('.guestbook-form');
    const guestbookTextarea = document.querySelector('.guestbook-textarea');
    const guestbookBtn = document.querySelector('.guestbook-btn');
    const guestbookMessages = document.querySelector('.guestbook-messages');

    if (guestbookBtn && guestbookTextarea && guestbookMessages) {
        guestbookBtn.addEventListener('click', function() {
            console.log('Bouton cliqué');
            const message = guestbookTextarea.value.trim();
            console.log('Message:', message);
            
            if (message.length === 0) {
                console.log('Message vide');
                // Animation d'erreur si le message est vide
                guestbookTextarea.style.borderColor = '#dc3545';
                guestbookTextarea.style.boxShadow = '0 0 0 4px rgba(220, 53, 69, 0.1)';
                
                setTimeout(() => {
                    guestbookTextarea.style.borderColor = '#e9ecef';
                    guestbookTextarea.style.boxShadow = 'none';
                }, 2000);
                return;
            }

            // Désactiver le bouton pendant l'envoi
            guestbookBtn.disabled = true;
            guestbookBtn.textContent = 'Envoi en cours...';

            // Créer un nouveau message
            const newMessage = createGuestbookMessage(message);
            console.log('Nouveau message créé:', newMessage);
            
            // Sauvegarder le message via AJAX
            saveGuestbookMessage(message, newMessage);
            
            // Animation d'apparition
            newMessage.style.opacity = '0';
            newMessage.style.transform = 'translateY(-20px)';
            
            setTimeout(() => {
                newMessage.style.transition = 'all 0.5s ease';
                newMessage.style.opacity = '1';
                newMessage.style.transform = 'translateY(0)';
            }, 100);

            // Vider le textarea
            guestbookTextarea.value = '';
            
            // Animation de succès sur le bouton
            guestbookBtn.textContent = 'Message publié !';
            guestbookBtn.style.background = 'linear-gradient(135deg, #105da1 0%, #105da1 100%)';
            
            setTimeout(() => {
                guestbookBtn.textContent = 'Publier un message';
                guestbookBtn.style.background = 'linear-gradient(135deg, var(--main-blue) 0%, var(--main-green) 100%)';
            }, 2000);
        });

        // Permettre l'envoi avec Entrée
        guestbookTextarea.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                guestbookBtn.click();
            }
        });
    }
});

function createGuestbookMessage(message) {
    const messageDiv = document.createElement('div');
    messageDiv.className = 'guestbook-message';
    
    // Générer des initiales aléatoires
    const initials = generateRandomInitials();
    const authorName = generateRandomName();
    
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

function generateRandomInitials() {
    const firstNames = ['AL', 'BK', 'CM', 'DN', 'EP', 'FQ', 'GR', 'HS', 'IT', 'JU', 'KV', 'LW', 'MX', 'NY', 'OZ'];
    return firstNames[Math.floor(Math.random() * firstNames.length)];
}

function generateRandomName() {
    const firstNames = ['Alex', 'Bakary', 'Camara', 'Diop', 'Elise', 'Fatou', 'Gueye', 'Hawa', 'Ibrahima', 'Jules', 'Kadiatou', 'Lamine', 'Mariama', 'Ndiaye', 'Ousmane'];
    const lastNames = ['Diallo', 'Sall', 'Gueye', 'Diop', 'Fall', 'Ba', 'Ndiaye', 'Cisse', 'Toure', 'Sy', 'Thiam', 'Mane', 'Sow', 'Dia', 'Kane'];
    
    const firstName = firstNames[Math.floor(Math.random() * firstNames.length)];
    const lastName = lastNames[Math.floor(Math.random() * lastNames.length)];
    
    return `${firstName} ${lastName}`;
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function saveGuestbookMessage(message, messageElement) {
    console.log('Début de saveGuestbookMessage');
    const formData = new FormData();
    formData.append('message', message);
    formData.append('action', 'save_guestbook');
    
    console.log('Envoi de la requête à save_guestbook.php');
    
    fetch('save_guestbook.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log('Réponse reçue:', response);
        return response.json();
    })
    .then(data => {
        console.log('Données reçues:', data);
        if (data.success) {
            // Ajouter le message au début de la liste
            const guestbookMessages = document.querySelector('.guestbook-messages');
            guestbookMessages.insertBefore(messageElement, guestbookMessages.firstChild);
            
            // Animation d'apparition
            messageElement.style.opacity = '0';
            messageElement.style.transform = 'translateY(-20px)';
            
            setTimeout(() => {
                messageElement.style.transition = 'all 0.5s ease';
                messageElement.style.opacity = '1';
                messageElement.style.transform = 'translateY(0)';
            }, 100);

            // Vider le textarea
            const guestbookTextarea = document.querySelector('.guestbook-textarea');
            guestbookTextarea.value = '';
            
            // Réactiver le bouton et afficher le succès
            const guestbookBtn = document.querySelector('.guestbook-btn');
            guestbookBtn.textContent = 'Message publié !';
            guestbookBtn.style.background = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
            
            setTimeout(() => {
                guestbookBtn.disabled = false;
                guestbookBtn.textContent = 'Publier un message';
                guestbookBtn.style.background = 'linear-gradient(135deg, var(--main-blue) 0%, var(--main-blue) 100%)';
            }, 2000);
        } else {
            console.error('Erreur lors de la sauvegarde:', data.error);
            alert('Erreur lors de la sauvegarde du message: ' + data.error);
            
            // Réactiver le bouton en cas d'erreur
            const guestbookBtn = document.querySelector('.guestbook-btn');
            guestbookBtn.disabled = false;
            guestbookBtn.textContent = 'Publier un message';
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur de connexion: ' + error.message);
        
        // Réactiver le bouton en cas d'erreur
        const guestbookBtn = document.querySelector('.guestbook-btn');
        guestbookBtn.disabled = false;
        guestbookBtn.textContent = 'Publier un message';
    });
}

// Animation des messages existants au chargement
document.addEventListener('DOMContentLoaded', function() {
    const existingMessages = document.querySelectorAll('.guestbook-message');
    
    existingMessages.forEach((message, index) => {
        message.style.opacity = '0';
        message.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            message.style.transition = 'all 0.5s ease';
            message.style.opacity = '1';
            message.style.transform = 'translateY(0)';
        }, index * 200);
    });
}); 