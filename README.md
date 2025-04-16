# Projet Quiz

Bienvenue dans le projet OpenEmoQuiz, une application web permettant aux utilisateurs de répondre à des rébus à partir d'émoticones. Ce projet est développé avec Symfony.

## Fonctionnalités

- **Création et Gestion des Questions** : Vous pouvez proposer des questions. Pour les Emoji, rendez-vous sur le site : https://openmoji.org/ et quand vous avez trouvé l'emoji qui vous convient copiez le Unicode pour le saisir dans le formulaire. Les administrateurs doivent valider la question avant qu'elle n'apparaisse dans les quizz.
- **Catégories de Questions** : Les questions peuvent être classées en différentes catégories comme films, livres, mangas, personnalité et jeux.
- **Système de Score** : Les utilisateurs peuvent voir leurs scores après avoir répondu aux questions. Un tableau higScore est accessible

## Prérequis

- PHP 8.1 ou supérieur
- Composer
- Symfony CLI
- Base de données MySQL

## Installation

1. **Cloner le dépôt** :

   ```bash
   git clone https://github.com/Syllac21/openemojiquizz.git
   cd projet-quiz

2. **Installer les dépendances** :

    ```bash
    composer install

3. **Configurer la base de données** :

Dans le fichier .env configurez la ligne suivante avec vos paramètres :
nom de l'utilisateur de votre base de donnée
mot de passe
nom de la base de donnée


DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4"

4. **Créer la base de données**

    ```bash
    symfony console doctrine\:database\:create

5. **Faire les migrations**

    ```bash
    symfony console doctrine\:migrations\:migrate

## Utilisation

1. **Lancer le serveur Symfony**

    ```bash
    symfony server:start

2. **Acceder à l'application**

Ouvrez votre navigateur et allez sur l'URL : localhost:8000

Sur la page d'accueil, on vous invite soit à créer un compte, soit à vous connecter

Bon jeu!!!
