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