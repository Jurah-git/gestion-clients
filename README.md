# Gestion des Clients

Application web de gestion de clients développée avec **Laravel, PHP, MySQL et Bootstrap 5**.

## Présentation du projet

Gestion des Clients est une application web qui permet de centraliser et d'organiser les informations des clients dans une interface moderne, simple et intuitive.

Ce projet met en pratique les principales fonctionnalités du développement web avec Laravel.

## Fonctionnalités

- Ajouter un nouveau client.
- Consulter les informations d'un client.
- Modifier les informations d'un client.
- Supprimer un client.
- Rechercher des clients.
- Filtrer les clients par entreprise.
- Trier les résultats.
- Parcourir les clients grâce à la pagination.
- Consulter les statistiques sur le tableau de bord.
- Exporter les données au format CSV.

## Technologies utilisées

| Technologie | Utilisation |
|---|---|
| PHP | Logique de l'application |
| Laravel | Framework backend |
| MySQL | Base de données |
| Blade | Templates et vues |
| Bootstrap 5 | Interface utilisateur |
| HTML5 / CSS3 | Structure et présentation |
| JavaScript | Interactions de l'interface |

## Installation

### Prérequis

- PHP et les extensions nécessaires à Laravel.
- Composer.
- MySQL ou MariaDB.
- Node.js et npm si nécessaires pour les ressources frontend.

### 1. Cloner le projet

```bash
git clone URL_DE_TON_DEPOT
cd gestion-clients
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer l'environnement

Sous Windows :

```bash
copy .env.example .env
```

Générer la clé de l'application :

```bash
php artisan key:generate
```

### 4. Configurer la base de données

Créer une base de données MySQL nommée `gestion_clients`, puis configurer les paramètres suivants dans `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_clients
DB_USERNAME=root
DB_PASSWORD=
```

Adapte le nom d'utilisateur et le mot de passe à ta configuration MySQL.

### 5. Exécuter les migrations

```bash
php artisan migrate
```

### 6. Démarrer l'application

```bash
php artisan serve
```

Ouvrir ensuite cette adresse dans le navigateur :

http://127.0.0.1:8000/clients

## Structure du projet

```text
gestion-clients/
├── app/
│   └── Http/
│       └── Controllers/
├── database/
│   └── migrations/
├── resources/
│   └── views/
│       ├── clients/
│       └── layouts/
├── routes/
│   └── web.php
├── .env.example
├── artisan
├── composer.json
└── README.md
```

## Auteur

Projet personnel réalisé dans le cadre de mon apprentissage du développement web avec Laravel.

**Compétences mises en pratique :** PHP, Laravel, MySQL, Bootstrap, opérations CRUD, recherche, filtrage, pagination et export CSV.
