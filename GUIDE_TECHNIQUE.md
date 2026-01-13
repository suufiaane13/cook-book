# 📘 Guide Technique - Application CookBook

**Version** : 1.0  
**Date** : 2026-01-11  
**Framework** : Laravel 12.0

---

## 📋 Table des matières

1. [Vue d'ensemble](#vue-densemble)
2. [Prérequis et installation](#prérequis-et-installation)
3. [Configuration](#configuration)
4. [Architecture du projet](#architecture-du-projet)
5. [Structure de la base de données](#structure-de-la-base-de-données)
6. [Modèles et relations](#modèles-et-relations)
7. [Contrôleurs](#contrôleurs)
8. [Routes](#routes)
9. [Vues et composants](#vues-et-composants)
10. [Authentification](#authentification)
11. [Gestion des fichiers](#gestion-des-fichiers)
12. [Thème et design](#thème-et-design)
13. [Bonnes pratiques](#bonnes-pratiques)
14. [Déploiement](#déploiement)

---

## 🎯 Vue d'ensemble

### Description
Application web de gestion de recettes de cuisine développée avec Laravel 12. L'application permet aux utilisateurs de créer, consulter, modifier et partager des recettes culinaires avec un système de favoris.

### Technologies principales

| Technologie | Version | Usage |
|------------|---------|-------|
| **Laravel** | 12.0 | Framework PHP backend |
| **PHP** | 8.2+ | Langage de programmation |
| **MySQL** | - | Base de données |
| **TailwindCSS** | 3.1.0 | Framework CSS |
| **Alpine.js** | 3.4.2 | JavaScript réactif |
| **Vite** | 7.0.7 | Build tool |
| **Laravel Breeze** | 2.3 | Authentification |

---

## 🚀 Prérequis et installation

### Prérequis système

- **PHP** : 8.2 ou supérieur
- **Composer** : Dernière version
- **Node.js** : 18+ et npm
- **MySQL** : 5.7+ ou 8.0+
- **Git** : Pour le contrôle de version

### Installation

#### 1. Cloner le projet
```bash
git clone <repository-url>
cd cook_book
```

#### 2. Installer les dépendances PHP
```bash
composer install
```

#### 3. Installer les dépendances Node.js
```bash
npm install
```

#### 4. Configuration de l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

#### 5. Configurer la base de données
Éditer le fichier `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cook_book
DB_USERNAME=root
DB_PASSWORD=
```

#### 6. Créer la base de données
```sql
CREATE DATABASE cook_book CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 7. Exécuter les migrations
```bash
php artisan migrate
```

#### 8. Peupler la base de données
```bash
php artisan db:seed
```

#### 9. Créer le lien symbolique pour le stockage
```bash
php artisan storage:link
```

#### 10. Compiler les assets
```bash
npm run build
# ou pour le développement
npm run dev
```

#### 11. Démarrer le serveur
```bash
php artisan serve
```

L'application sera accessible sur `http://localhost:8000`

---

## ⚙️ Configuration

### Variables d'environnement importantes

Fichier `.env` :

```env
APP_NAME="CookBook"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cook_book
DB_USERNAME=root
DB_PASSWORD=

FILESYSTEM_DISK=local
```

### Configuration du stockage

Les images sont stockées dans `storage/app/public/recipes`. Le lien symbolique `public/storage` doit pointer vers `storage/app/public`.

---

## 🏗️ Architecture du projet

### Structure des dossiers

```
cook_book/
├── app/
│   ├── Enums/                    # Enums pour catégories et difficultés
│   ├── Http/
│   │   ├── Controllers/         # Contrôleurs de l'application
│   │   └── Requests/            # Form Requests pour validation
│   ├── Models/                  # Modèles Eloquent
│   └── Policies/                # Policies d'autorisation
├── bootstrap/
│   └── app.php                  # Bootstrap Laravel 11+
├── config/                       # Fichiers de configuration
├── database/
│   ├── factories/               # Factories pour tests
│   ├── migrations/              # Migrations de base de données
│   └── seeders/                 # Seeders pour données de test
├── public/                      # Point d'entrée public
│   ├── images/                  # Images statiques (logo)
│   └── storage/                 # Lien symbolique vers storage
├── resources/
│   ├── css/                     # Styles CSS/Tailwind
│   ├── js/                      # JavaScript
│   └── views/                   # Vues Blade
│       ├── auth/                # Pages d'authentification
│       ├── components/          # Composants Blade réutilisables
│       ├── favorites/           # Pages des favoris
│       ├── layouts/             # Layouts principaux
│       ├── profile/              # Pages de profil
│       └── recipes/             # Pages des recettes
├── routes/
│   ├── auth.php                 # Routes d'authentification
│   ├── console.php              # Commandes console
│   └── web.php                  # Routes web principales
└── storage/
    └── app/
        └── public/
            └── recipes/         # Images des recettes
```

---

## 🗄️ Structure de la base de données

### Schéma de base de données

#### Table `users`
```sql
- id (bigint, primary key)
- name (string)
- email (string, unique)
- email_verified_at (timestamp, nullable)
- password (string)
- avatar (string, nullable)
- remember_token (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

#### Table `recipes`
```sql
- id (bigint, primary key)
- user_id (bigint, foreign key → users.id)
- titre (string)
- description (text)
- image (string, nullable)
- temps_preparation (integer)
- nb_personnes (integer)
- categorie (enum: plat, dessert, boisson)
- difficulte (enum: facile, moyen, difficile)
- created_at (timestamp)
- updated_at (timestamp)
```

#### Table `ingredients`
```sql
- id (bigint, primary key)
- recipe_id (bigint, foreign key → recipes.id)
- nom (string)
- quantite (string)
- unite (string, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

#### Table `etapes`
```sql
- id (bigint, primary key)
- recipe_id (bigint, foreign key → recipes.id)
- numero_etape (integer)
- description (text)
- created_at (timestamp)
- updated_at (timestamp)
```

#### Table `favoris`
```sql
- id (bigint, primary key)
- user_id (bigint, foreign key → users.id)
- recipe_id (bigint, foreign key → recipes.id)
- created_at (timestamp)
- updated_at (timestamp)
- UNIQUE(user_id, recipe_id)
```

### Relations

```
User
  ├── hasMany Recipe
  └── belongsToMany Recipe (via favoris)

Recipe
  ├── belongsTo User
  ├── hasMany Ingredient
  ├── hasMany Etape
  └── belongsToMany User (via favoris)

Ingredient
  └── belongsTo Recipe

Etape
  └── belongsTo Recipe

Favorite
  ├── belongsTo User
  └── belongsTo Recipe
```

---

## 📦 Modèles et relations

### Modèle `User`

**Fichier** : `app/Models/User.php`

```php
// Relations
public function recipes(): HasMany
public function favoriteRecipes(): BelongsToMany

// Attributs fillable
protected $fillable = ['name', 'email', 'password', 'avatar'];
```

### Modèle `Recipe`

**Fichier** : `app/Models/Recipe.php`

```php
// Relations
public function user(): BelongsTo
public function ingredients(): HasMany
public function etapes(): HasMany
public function favoritedByUsers(): BelongsToMany

// Attributs fillable
protected $fillable = [
    'user_id', 'titre', 'description', 'image',
    'temps_preparation', 'nb_personnes', 'categorie', 'difficulte'
];

// Casts
protected function casts(): array
{
    return [
        'categorie' => CategoryEnum::class,
        'difficulte' => DifficultyEnum::class,
    ];
}
```

### Modèle `Ingredient`

**Fichier** : `app/Models/Ingredient.php`

```php
// Relations
public function recipe(): BelongsTo

// Attributs fillable
protected $fillable = ['recipe_id', 'nom', 'quantite', 'unite'];
```

### Modèle `Etape`

**Fichier** : `app/Models/Etape.php`

```php
// Relations
public function recipe(): BelongsTo

// Attributs fillable
protected $fillable = ['recipe_id', 'numero_etape', 'description'];
```

### Modèle `Favorite`

**Fichier** : `app/Models/Favorite.php`

```php
// Table personnalisée
protected $table = 'favoris';

// Relations
public function user(): BelongsTo
public function recipe(): BelongsTo

// Attributs fillable
protected $fillable = ['user_id', 'recipe_id'];
```

---

## 🎮 Contrôleurs

### `RecipeController`

**Fichier** : `app/Http/Controllers/RecipeController.php`

#### Méthodes principales

| Méthode | Route | Description |
|---------|-------|-------------|
| `index()` | GET `/recettes` | Liste des recettes avec pagination et recherche |
| `show()` | GET `/recettes/{recipe}` | Détail d'une recette |
| `create()` | GET `/recettes/creer` | Formulaire de création |
| `store()` | POST `/recettes` | Enregistrement d'une nouvelle recette |
| `edit()` | GET `/recettes/{recipe}/editer` | Formulaire d'édition |
| `update()` | PUT `/recettes/{recipe}` | Mise à jour d'une recette |
| `destroy()` | DELETE `/recettes/{recipe}` | Suppression d'une recette |
| `byCategory()` | GET `/recettes/categorie/{category}` | Filtrage par catégorie |

#### Logique de recherche

La recherche s'effectue dans :
- Le titre de la recette (`titre LIKE %search%`)
- La description (`description LIKE %search%`)
- Les noms d'ingrédients (`ingredients.nom LIKE %search%`)

### `FavoriteController`

**Fichier** : `app/Http/Controllers/FavoriteController.php`

| Méthode | Route | Description |
|---------|-------|-------------|
| `index()` | GET `/favoris` | Liste des recettes favorites |
| `store()` | POST `/favoris/{recipe}` | Ajouter aux favoris |
| `destroy()` | DELETE `/favoris/{recipe}` | Retirer des favoris |

### `ProfileController`

**Fichier** : `app/Http/Controllers/ProfileController.php`

Gestion du profil utilisateur (hérité de Laravel Breeze).

---

## 🛣️ Routes

### Routes publiques

```php
GET  /                          → home (page d'accueil)
GET  /recettes                  → recettes.index (liste)
GET  /recettes/categorie/{cat}  → recettes.categorie (filtre)
GET  /recettes/{recipe}         → recettes.show (détail)
```

### Routes authentifiées

```php
GET    /dashboard                    → dashboard
GET    /recettes/creer               → recettes.create
POST   /recettes                    → recettes.store
GET    /recettes/{recipe}/editer    → recettes.edit
PUT    /recettes/{recipe}            → recettes.update
DELETE /recettes/{recipe}            → recettes.destroy

GET    /favoris                      → favoris.index
POST   /favoris/{recipe}             → favoris.store
DELETE /favoris/{recipe}             → favoris.destroy

GET    /profile                      → profile.edit
PATCH  /profile                      → profile.update
DELETE /profile                      → profile.destroy
```

### Routes d'authentification (Laravel Breeze)

```php
GET    /login                        → login
POST   /login                        → login
POST   /logout                       → logout
GET    /register                     → register
POST   /register                     → register
GET    /forgot-password              → password.request
POST   /forgot-password              → password.email
GET    /reset-password/{token}      → password.reset
POST   /reset-password               → password.update
```

---

## 🎨 Vues et composants

### Layouts

#### `layouts/app.blade.php`
Layout principal pour les pages authentifiées avec navigation.

#### `layouts/guest.blade.php`
Layout pour les pages publiques (login, register).

#### `layouts/navigation.blade.php`
Barre de navigation avec :
- Logo et nom du site
- Barre de recherche
- Liens de navigation
- Menu utilisateur
- Version mobile responsive

### Composants réutilisables

#### `components/recipe-card.blade.php`
Carte de recette réutilisable avec :
- Image avec badges
- Informations (temps, personnes)
- Auteur ou "Ma Recette"
- Bouton favori

**Usage** :
```blade
<x-recipe-card :recipe="$recipe" />
```

#### Autres composants
- `application-logo.blade.php` : Logo de l'application
- `primary-button.blade.php` : Bouton principal avec gradient
- `text-input.blade.php` : Champ de saisie stylisé
- `dropdown.blade.php` : Menu déroulant
- Etc.

### Pages principales

#### `recipes/index.blade.php`
- Liste des recettes en grille
- Filtres par catégorie
- Barre de recherche
- Pagination

#### `recipes/show.blade.php`
- Détail complet d'une recette
- Image, informations, ingrédients, étapes
- Bouton favori
- Actions (modifier/supprimer si propriétaire)

#### `recipes/create.blade.php`
- Formulaire de création
- Champs dynamiques pour ingrédients et étapes
- Prévisualisation d'image
- Validation JavaScript

#### `recipes/edit.blade.php`
- Formulaire d'édition pré-rempli
- Même structure que create

#### `dashboard.blade.php`
- Statistiques (mes recettes, mes favoris)
- Dernières recettes
- Derniers favoris

---

## 🔐 Authentification

### Laravel Breeze

L'authentification est gérée par **Laravel Breeze** qui fournit :
- Inscription
- Connexion
- Déconnexion
- Réinitialisation de mot de passe
- Vérification d'email

### Middleware

Les routes protégées utilisent :
- `auth` : Vérifie que l'utilisateur est connecté
- `verified` : Vérifie que l'email est vérifié

### Autorisation

#### RecipePolicy

**Fichier** : `app/Policies/RecipePolicy.php`

```php
// Seul le propriétaire peut modifier
public function update(User $user, Recipe $recipe): bool
{
    return $user->id === $recipe->user_id;
}

// Seul le propriétaire peut supprimer
public function delete(User $user, Recipe $recipe): bool
{
    return $user->id === $recipe->user_id;
}
```

**Usage dans les contrôleurs** :
```php
$this->authorize('update', $recipe);
$this->authorize('delete', $recipe);
```

---

## 📁 Gestion des fichiers

### Upload d'images

Les images sont stockées dans `storage/app/public/recipes/`.

#### Dans le contrôleur
```php
if ($request->hasFile('image')) {
    $data['image'] = $request->file('image')->store('recipes', 'public');
}
```

#### Affichage dans les vues
```blade
<img src="{{ Storage::url($recipe->image) }}" alt="{{ $recipe->titre }}">
```

### Lien symbolique

Le lien `public/storage` doit pointer vers `storage/app/public` :
```bash
php artisan storage:link
```

---

## 🎨 Thème et design

### Couleurs du thème "Naturel / Healthy / Bio"

Définies dans `resources/css/app.css` :

```css
--color-olive: #6A994E;        /* Vert olive */
--color-green-light: #A7C957;  /* Vert clair */
--color-cream: #F2F2F2;        /* Blanc cassé */
--color-brown: #8D6E63;        /* Marron doux */
```

### Classes Tailwind personnalisées

```css
.bg-olive, .text-olive, .border-olive
.bg-green-light, .text-green-light, .border-green-light
.bg-cream, .text-cream
.bg-brown, .text-brown, .border-brown
```

### Gradients

Les boutons principaux utilisent un gradient :
```css
background: linear-gradient(to right, #6A994E, #A7C957);
```

---

## 📝 Bonnes pratiques

### Conventions de code

#### PHP
- Utilisation de `match` au lieu de `switch`
- Property promotion dans les constructeurs
- Return types explicites
- Enums dans `app/Enums/`
- Services injectés dans les méthodes si utilisés une seule fois

#### Laravel
- Form Requests pour la validation
- Policies pour l'autorisation
- Eager loading pour éviter N+1
- Factories pour les tests
- Seeders pour les données de test

#### Blade
- Composants réutilisables
- Layouts pour la structure
- Sections pour le contenu dynamique
- Directives `@auth`, `@guest` pour l'authentification

### Structure des requêtes

#### StoreRecipeRequest
```php
'titre' => ['required', 'string', 'max:255']
'description' => ['required', 'string']
'image' => ['nullable', 'image', 'max:2048']
'ingredients' => ['required', 'array', 'max:10']
'etapes' => ['required', 'array', 'min:1']
```

### Gestion des erreurs

Les erreurs de validation sont affichées automatiquement via le composant `input-error` :
```blade
<x-input-error :messages="$errors->get('titre')" class="mt-2" />
```

---

## 🔍 Fonctionnalités techniques

### Recherche

La recherche fonctionne sur :
- Titre de la recette
- Description
- Noms d'ingrédients

**Implémentation** :
```php
$query->where(function ($q) use ($search) {
    $q->where('titre', 'like', "%{$search}%")
      ->orWhere('description', 'like', "%{$search}%")
      ->orWhereHas('ingredients', function ($ingredientQuery) use ($search) {
          $ingredientQuery->where('nom', 'like', "%{$search}%");
      });
});
```

### Pagination

Laravel préserve automatiquement les paramètres de requête dans les liens de pagination.

### Filtrage par catégorie

Les filtres sont combinables avec la recherche :
```php
if ($request->has('categorie')) {
    $query->where('categorie', $request->categorie);
}
```

---

## 🧪 Tests et développement

### Seeders

Le seeder principal (`DatabaseSeeder`) crée :
- 3 utilisateurs avec noms marocains
- 9 recettes complètes avec images
- Tous les ingrédients et étapes
- Des favoris aléatoires

### Factories

Factories disponibles pour :
- `UserFactory`
- `RecipeFactory`
- `IngredientFactory`
- `EtapeFactory`

### Commandes utiles

```bash
# Réinitialiser la base de données
php artisan migrate:fresh --seed

# Compiler les assets en production
npm run build

# Compiler les assets en développement (watch)
npm run dev

# Nettoyer le cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 🚀 Déploiement

### Préparation pour la production

1. **Variables d'environnement**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **Optimisation**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   composer install --optimize-autoloader --no-dev
   ```

3. **Assets**
   ```bash
   npm run build
   ```

4. **Permissions**
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

### Configuration serveur

#### Apache
Assurez-vous que `mod_rewrite` est activé et que le `.htaccess` est présent.

#### Nginx
Configuration recommandée :
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

---

## 📚 Références

### Documentation Laravel
- [Laravel 12 Documentation](https://laravel.com/docs/12.x)
- [Laravel Breeze](https://laravel.com/docs/breeze)
- [Eloquent ORM](https://laravel.com/docs/eloquent)

### Documentation TailwindCSS
- [TailwindCSS Documentation](https://tailwindcss.com/docs)

### Outils
- [Vite Documentation](https://vitejs.dev/)
- [Alpine.js Documentation](https://alpinejs.dev/)

---

## 🐛 Dépannage

### Problèmes courants

#### Images non affichées
```bash
php artisan storage:link
```
Vérifier que le lien symbolique existe.

#### Erreur 500
- Vérifier les logs : `storage/logs/laravel.log`
- Vérifier les permissions : `storage/` et `bootstrap/cache/`
- Nettoyer le cache : `php artisan config:clear`

#### Erreur de migration
```bash
php artisan migrate:fresh --seed
```

#### Assets non compilés
```bash
npm install
npm run build
```

---

## 📞 Support

Pour toute question technique, consulter :
- La documentation Laravel
- Les logs dans `storage/logs/laravel.log`
- Le rapport de projet : `RAPPORT_PROJET.md`

---

**Guide technique généré le** : 2026-01-11  
**Version du projet** : 1.0
