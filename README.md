# Projet Visites Tuteurs

Application Symfony pour gérer les visites de tuteurs en entreprise et le suivi des étudiants en stage/alternance.

## Technologies utilisées

- PHP 8.2
- Symfony 6.4
- Twig
- Docker (PHP-FPM, Nginx, MySQL, phpMyAdmin)
- Composer

## Installation (en local, sans Docker)

1. Cloner le dépôt :

git clone https://github.com/ornelnana4/Projet_pw.git
cd Projet_pw/apptuteur

text

2. Installer les dépendances PHP :

composer install

text

3. Configurer l’environnement :

Copier le fichier `.env` si besoin et adapter les paramètres (base de données, etc.).

4. Lancer le serveur de développement PHP :

php -S 127.0.0.1:8000 -t public

text

5. Ouvrir l’application :

- Page d’accueil : http://127.0.0.1:8000/
- Liste des tuteurs : http://127.0.0.1:8000/tuteur
- Détail d’un tuteur : http://127.0.0.1:8000/tuteurs/1
- Sujets de stage : http://127.0.0.1:8000/sujets

## Installation avec Docker (si utilisée)

Depuis le dossier `mon_projet_docker` :

docker compose up -d

text

- Nginx : http://localhost:8000  
- phpMyAdmin : http://localhost:8081  

(À adapter selon ton `docker-compose.yml`.)

## Fonctionnalités

- Liste des tuteurs avec :
  - Nom, prénom, entreprise, email, téléphone.
  - Nombre d’étudiants suivis.
  - Tri sur le nom (asc/desc) via paramètres `?sort=` et `?dir=`.
- Page détail d’un tuteur :
  - Carte tuteur réutilisable (`_tuteur_card.html.twig`).
  - Informations de contact (mailto, téléphone).
  - Liste des étudiants du tuteur avec sujet de stage.
  - Affichage d’un message si aucun étudiant (Twig `for ... else`).
- Page “Sujets de stage” :
  - Récupération de tous les sujets de tous les tuteurs/étudiants.
  - Affichage des sujets avec nom de l’étudiant, du tuteur et de l’entreprise.
  - Filtre par entreprise via un menu déroulant (`?entreprise=...`).
  - Utilisation d’une macro Twig pour afficher un badge de sujet.
- Layout commun :
  - `base.html.twig` avec barre de navigation (Tuteurs, Étudiants, Sujets).
  - Styles centralisés dans `public/css/app.css`.
  - Design simple et professionnel (tableau zébré, hover, cartes).

## Structure principale du projet

- `src/Controller/TuteurController.php`  
  - `index()` : liste des tuteurs.  
  - `show()` : détail d’un tuteur.  
  - `sujets()` : page des sujets de stage.

- `templates/base.html.twig` : layout global.  
- `templates/tuteur/index.html.twig` : liste des tuteurs.  
- `templates/tuteur/show.html.twig` : détail d’un tuteur.  
- `templates/sujet/index.html.twig` : page des sujets de stage.  
- `templates/partials/_tuteur_card.html.twig` : carte tuteur réutilisable.  
- `public/css/app.css` : styles de l’application.

## Commandes utiles Symfony

Depuis le dossier `apptuteur` :

Infos sur le projet
php bin/console about

Vider le cache
php bin/console cache:clear

Vérifier les routes
php bin/console debug:router

text

## Auteur

- ORNELLA NANA –
- GAEL BONNECHERE –

  
