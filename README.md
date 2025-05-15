# Projet E-commerce Laravel avec PostgreSQL

Ce projet consiste à développer une application web e-commerce en Laravel avec une base de données PostgreSQL. Il comprend l'authentification, la gestion des rôles, la gestion des produits, l'ajout au panier avec `localStorage` et la gestion des commandes avec paiement en ligne via Stripe.

## Prérequis

- PHP >= 8.0
- Composer
- Laravel 9
- PostgreSQL / MySQL
- Node.js & npm
- Stripe (pour le paiement en ligne)

## Installation

### 1. Cloner le projet
```bash
git clone https://github.com/Black0list/YouShop.git
cd YouShop
```

### 2. Installer les dépendances
```bash
composer install
npm install && npm run dev
```

### 3. Configurer l'environnement
Copiez le fichier `.env.example` et renommez-le `.env`.
```bash
cp .env.example .env
```

Modifiez le fichier `.env` pour configurer la base de données PostgreSQL :
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nom_de_la_base
DB_USERNAME=nom_utilisateur
DB_PASSWORD=mot_de_passe
```

Générez une clé d'application Laravel :
```bash
php artisan key:generate
```

### 4. Exécuter les migrations et les seeders
```bash
php artisan migrate 
```

### 5. Lancer le serveur de développement
```bash
php artisan serve
```

## Fonctionnalités

### 1. Authentification & Gestion des Rôles
- Inscription & connexion avec Laravel Breeze
- Attribution de rôles (Admin / Client)
- Accès restreint aux fonctionnalités sensibles (Middleware)

### 2. Gestion des Produits
- CRUD des produits (Admin uniquement)
- Liste des produits accessibles aux utilisateurs
- Détails des produits

### 3. Gestion du Panier avec `localStorage`
- Ajout de produits au panier
- Modification des quantités
- Sauvegarde en `localStorage` pour persistance
- Suppression de produits du panier

### 4. Gestion des Commandes
- Validation du panier et passage de commande
- Historique des commandes pour les clients
- Liste des commandes pour les administrateurs
- Mise à jour du statut des commandes (en cours, expédiée, livrée)

### 5. Paiement en Ligne avec Stripe
- Intégration de Stripe pour les paiements sécurisés
- Confirmation de paiement et récapitulatif de commande
- Suivi du statut des paiements pour l'admin


![DASHBOARD](Conception/imagr)
