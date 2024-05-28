# Projet Technique Laravel & React

![Backend CI](https://github.com/Audmqx/test-technique-groupe-actual/actions/workflows/Backend-CI.yml/badge.svg)
![Frontend CI](https://github.com/Audmqx/test-technique-groupe-actual/actions/workflows/Frontend-CI.yml/badge.svg)

## Description

Ce projet est une application web développée avec Laravel pour le backend et React pour le frontend. L'objectif est de gérer des candidats et leurs missions associées. L'application permet de lire et supprimer des candidats, ainsi que de filtrer les candidats par date de fin de mission.

## Installation

### Prérequis

- **PHP 8.2 ou supérieur**
- **Composer 2.0 ou supérieur**
- **Node.js 16.x ou supérieur**
- **npm 7.x ou supérieur**
- **MySQL 8.0 ou autre base de données compatible avec Laravel**

### Étapes d'installation

- `git clone <url-du-depot>`
- `cd <nom-du-repertoire>`
- `composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`
- `npm install`
- `php artisan serve`
- `npm run dev` ou `npm run build`

### Tests

- `php artisan test`
- `npm test`

### Méthodologie de Développement

J'ai appliqué la méthode du Test-Driven Development (TDD) au maximum, en committant à chaque phase verte et de refactorisation.
Mise en place de l'intégration continue (CI) pour le frontend et le backend.
J'ai privilégié le développement sur la branch main (trunk-based development) au lieu du développement basé sur des branches pour aller plus vite.
Je n'ai pas mis en place de découplage (DIP) domaine / persistence / presenter car ce n'était pas demandé.

### Améliorations

- Ajout des uses cases
- Extraction de classes au niveau de la factory des missions.
- Remplacer les primitives des models par des Value Objects pour encapsuler les données.
- Enrichir le vocabulaire du domaine avec des First Class Collections 
- Mise en place de la pagination côté frontend pour une meilleure gestion de l'affichage des candidats.
- Amélioration de la gestion des erreurs et des validations côté frontend et backend.
- Optimisation des performances de requêtes et du rendu frontend.
- Ajout de tests end-to-end pour couvrir les scénarios utilisateurs complets.