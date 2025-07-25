# Plateforme Cellule Numérique UN-CHK

## Aperçu visuel

Voici quelques captures d’écran de l’application :

### Page d’accueil
![Accueil](img/screenshot-accueil.png)

### Page Ajout Actualité (Admin)
![Actualité](img/screenshot-add-actu.png)

### Page Membres
![Espace Membre](img/screenshot-accueil_.png)

### Page Login
![Login](img/screenshot-login.png)

### Responsive
![Responsivité](img/responsive.png)

## Auteur
**Mohamadou Lamine Gaye**

## Description du projet
Cette mini-application web a été réalisée dans le cadre de la finale du concours de codage. Elle propose une plateforme de gestion de membres, d'actualités et de livre d'or pour la Cellule Numérique de l'Université Cheikh Hamidou Kane (UN-CHK).

Le projet répond à toutes les exigences du sujet :
- Inscription et connexion sécurisées
- Accueil réservé aux membres connectés
- Gestion des rôles (admin/utilisateur)
- Ajout d'actualités (admin)
- Livre d'or (guestbook)
- Interface responsive avec menu mobile
- Stockage des données en fichiers JSON (aucune base de données requise)
- **Fonctionnalité mot de passe oublié (forgot password) complète**

## Technologies utilisées
- **HTML5**
- **CSS3** (responsive, mobile-first, design moderne)
- **PHP** (sessions, gestion utilisateurs, logique serveur)
- **JavaScript** (animations, interactions UI)
- **JSON** (stockage des utilisateurs, actualités, livre d'or)

## Fonctionnalités principales

### 1. Inscription (`register.php`)
- Formulaire avec : nom d'utilisateur, e-mail, mot de passe, confirmation du mot de passe
- Vérification :
  - Mots de passe identiques
  - E-mail non vide et non déjà utilisé
- Enregistrement dans `data/users.json`
- Redirection vers la page de connexion

### 2. Connexion (`login.php`)
- Formulaire : e-mail, mot de passe
- Vérification des identifiants (hash sécurisé)
- Création de session PHP à la connexion
- Redirection vers `accueil.php` si succès, sinon message d'erreur
- **Lien "Mot de passe oublié ?"** pour accéder à la récupération

### 3. Mot de passe oublié (`forgot_password.php` et `reset_password.php`)
- Lien accessible depuis la page de connexion
- Saisie de l'e-mail utilisateur
- Si l'e-mail existe, un lien de réinitialisation sécurisé s'affiche à l'écran (valable 30 minutes)
- L'utilisateur clique sur ce lien, choisit un nouveau mot de passe (avec confirmation)
- Le mot de passe est mis à jour dans `users.json` (hashé)
- **Expérience utilisateur moderne et message visuel attractif**
- Pour la démo locale, le lien s'affiche à l'écran (pas d'envoi mail requis)

### 4. Accueil membre (`accueil.php`)
- Accessible uniquement si connecté
- Affiche un message de bienvenue personnalisé
- Bouton "Déconnexion" (détruit la session et redirige vers login)
- Affiche les actualités (issues de `data/actualites.json`)
- Affiche le livre d'or (messages de `data/guestbook.json`)

### 5. Gestion des rôles
- **Admin** :
  - Peut ajouter une actualité (`ajouter_actualite.php`)
  - Accès à un lien spécial dans le menu
- **Utilisateur** :
  - Accès standard (lecture actualités, livre d'or)

### 6. Livre d'or (Guestbook)
- Les membres peuvent laisser un message
- Les messages sont stockés dans `data/guestbook.json`
- Affichage dynamique des messages

### 7. Responsive & Expérience mobile
- Menu principal et menu bottom-nav mobile
- Logo fourni (`img/logo.png`) intégré dans le header
- Design moderne, police Orbitron, couleurs institutionnelles

## Structure des fichiers

```
/ (racine)
├── index.php                # Page d'accueil publique
├── register.php             # Inscription
├── login.php                # Connexion
├── forgot_password.php      # Mot de passe oublié (demande)
├── reset_password.php       # Réinitialisation du mot de passe
├── accueil.php              # Accueil membre (protégé)
├── a-propos.php             # À propos
├── ajouter_actualite.php    # Ajout actualité (admin)
├── includes/
│   ├── header.php           # En-tête commun (menu, logo)
│   └── footer.php           # Pied de page (footer, bottom-nav)
├── css/
│   ├── style.css            # Styles principaux (responsive)
│   └── guestbook-mobile-fix.css # Styles guestbook mobile
├── js/
│   └── main.js              # JS pour interactions UI
├── data/
│   ├── users.json           # Utilisateurs (JSON)
│   ├── actualites.json      # Actualités (JSON)
│   └── guestbook.json       # Livre d'or (JSON)
├── img/
│   └── logo.png             # Logo obligatoire
└── README.md                # Ce fichier
```

## Installation & utilisation

1. **Cloner le dépôt**
   ```
   git clone <lien-du-repo-github>
   ```
2. **Placer le dossier dans le répertoire de votre serveur local** (ex : `htdocs` pour XAMPP/MAMP/WAMP)
3. **Lancer le serveur local**
4. **Accéder à l'application** via [http://localhost/nom-du-dossier/index.php](http://localhost/nom-du-dossier/index.php)

Aucune base de données n'est requise : toutes les données sont stockées dans le dossier `data/` au format JSON.

## Gestion des rôles et tests
- **admin** :
  - Identifiants de test :
    - **E-mail** : admin@codingday.sn
    - **Mot de passe** : email (mot de passe simple pour la démo)
  - Peut ajouter des actualités
- **user** :
  - Peut s'inscrire, se connecter, poster dans le livre d'or, lire les actualités

Pour tester les différentes fonctionnalités :
- Inscrivez-vous avec un nouvel e-mail (rôle user)
- Connectez-vous avec l'admin pour tester l'ajout d'actualités
- Essayez d'accéder à `accueil.php` sans être connecté : vous serez redirigé vers la connexion
- Testez la récupération de mot de passe avec un e-mail existant

## Sécurité et expérience utilisateur
- Les mots de passe sont hashés (jamais stockés en clair)
- Les liens de réinitialisation sont uniques et expirent après 30 minutes
- Les messages d’alerte et de succès sont visuels et rassurants
- Aucune dépendance externe, tout fonctionne en local

## Suivi de l'évolution du projet
Vous pouvez consulter l'historique des commits sur GitHub pour voir l'état d'évolution du projet depuis le début, comprendre les étapes de développement et les choix techniques réalisés.

## Contraintes respectées
- Projet 100% fonctionnel sous serveur local (XAMPP/MAMP/WAMP)
- Aucune dépendance externe (pas de framework)
- Code commenté, organisé, facile à lire
- Logo fourni intégré et responsive

## Remarques
- Si vous souhaitez réinitialiser les données, supprimez ou éditez les fichiers JSON dans `data/`
- Le projet peut être adapté pour une base de données MySQL si besoin (voir instructions dans l'énoncé)

## Auteur
Mohamadou Lamine Gaye

---
Bonne évaluation !
