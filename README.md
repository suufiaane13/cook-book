# 🍳 CookBook - Application de Gestion de Recettes

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.1-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

**Application web moderne de partage et gestion de recettes culinaires**

[Fonctionnalités](#-fonctionnalités) • [Installation](#-installation) • [Technologies](#-technologies) • [Documentation](#-documentation)

</div>

---

## 📖 À propos

CookBook est une application web développée avec Laravel 12 permettant aux utilisateurs de créer, partager, consulter et sauvegarder leurs recettes culinaires préférées. L'application offre une interface moderne et intuitive avec un thème "Naturel / Healthy / Bio".

### ✨ Fonctionnalités principales

- 🔐 **Authentification complète** : Inscription, connexion, réinitialisation de mot de passe
- 📝 **CRUD de recettes** : Création, modification, suppression de recettes
- 🖼️ **Upload d'images** : Ajout d'images pour chaque recette
- 🏷️ **Catégories** : Organisation par Plats, Desserts, Boissons
- ⭐ **Système de favoris** : Sauvegarder vos recettes préférées
- 🔍 **Recherche avancée** : Recherche par titre, description ou ingrédients
- 📊 **Dashboard personnel** : Vue d'ensemble de vos recettes et favoris
- 👤 **Gestion de profil** : Modification des informations personnelles
- 📱 **Design responsive** : Interface adaptée à tous les écrans

---

## 🚀 Installation

### Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js 18+ et npm
- MySQL 5.7+ ou 8.0+
- Git

### Étapes d'installation

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/votre-username/cook_book.git
   cd cook_book
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Installer les dépendances Node.js**
   ```bash
   npm install
   ```

4. **Configurer l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurer la base de données**
   
   Éditer le fichier `.env` :
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=cook_book
   DB_USERNAME=root
   DB_PASSWORD=votre_mot_de_passe
   ```

6. **Créer la base de données**


7. **Exécuter les migrations**
   ```bash
   php artisan migrate
   ```

8. **Peupler la base de données (optionnel)**
   ```bash
   php artisan db:seed
   ```

9. **Créer le lien symbolique pour le stockage**
   ```bash
   php artisan storage:link
   ```

10. **Compiler les assets**
    ```bash
    npm run build
    # ou pour le développement
    npm run dev
    ```

11. **Démarrer le serveur**
    ```bash
    php artisan serve
    ```

L'application sera accessible sur `http://localhost:8000`

---

## 🛠️ Technologies

### Backend
- **Laravel 12.0** - Framework PHP
- **PHP 8.2+** - Langage de programmation
- **MySQL** - Base de données relationnelle

### Frontend
- **TailwindCSS 3.1** - Framework CSS utility-first
- **Alpine.js 3.4** - Framework JavaScript léger
- **Blade** - Moteur de templating Laravel

### Outils
- **Vite 7.0** - Build tool et bundler
- **Laravel Breeze 2.3** - Authentification
- **Composer** - Gestionnaire de dépendances PHP
- **npm** - Gestionnaire de paquets Node.js

---

## 📁 Structure du projet

```
cook_book/
├── app/
│   ├── Enums/              # Enums (CategoryEnum, DifficultyEnum)
│   ├── Http/
│   │   ├── Controllers/   # Contrôleurs (Recipe, Favorite, Profile)
│   │   └── Requests/      # Form Requests (validation)
│   ├── Models/            # Modèles Eloquent
│   └── Policies/         # Policies d'autorisation
├── database/
│   ├── migrations/        # Migrations de base de données
│   ├── seeders/           # Seeders pour données de test
│   └── factories/        # Factories pour tests
├── resources/
│   ├── views/            # Vues Blade
│   ├── css/              # Styles TailwindCSS
│   └── js/               # JavaScript
├── routes/               # Routes de l'application
└── storage/              # Fichiers uploadés
```

---

## 🎨 Thème et design

L'application utilise un thème "Naturel / Healthy / Bio" avec les couleurs suivantes :

- 🟢 **Vert olive** : `#6A994E`
- 🟢 **Vert clair** : `#A7C957`
- ⚪ **Blanc cassé** : `#F2F2F2`
- 🟤 **Marron doux** : `#8D6E63`

---

## 📸 Captures d'écran

> _Note : Ajoutez vos captures d'écran ici_

---

## 🔑 Fonctionnalités détaillées

### Gestion des recettes
- ✅ Création de recettes avec titre, description, image
- ✅ Ajout dynamique d'ingrédients (nom, quantité, unité)
- ✅ Ajout dynamique d'étapes de préparation
- ✅ Catégorisation (Plat, Dessert, Boisson)
- ✅ Niveau de difficulté (Facile, Moyen, Difficile)
- ✅ Temps de préparation et nombre de personnes
- ✅ Modification et suppression (propriétaire uniquement)

### Recherche et filtrage
- ✅ Recherche par titre, description ou ingrédients
- ✅ Filtrage par catégorie
- ✅ Pagination des résultats
- ✅ Combinaison recherche + filtres

### Système de favoris
- ✅ Ajout/retrait de favoris en un clic
- ✅ Page dédiée "Mes favoris"
- ✅ Indicateur visuel sur les cartes de recettes

### Dashboard
- ✅ Statistiques personnelles (mes recettes, mes favoris)
- ✅ Aperçu des dernières recettes créées
- ✅ Aperçu des derniers favoris

---

## 📚 Documentation

- 📘 [Guide Technique](GUIDE_TECHNIQUE.md) - Documentation technique complète
- 📊 [Rapport de Projet](RAPPORT_PROJET.md) - Analyse et état du projet

---

## 🧪 Tests

Pour exécuter les tests :

```bash
php artisan test
```

---

## 🤝 Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Fork le projet
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

---

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

---

## 👤 Auteur

**Votre Nom**
- GitHub: [@votre-username](https://github.com/votre-username)
- Email: votre.email@example.com

---

## 🙏 Remerciements

- [Laravel](https://laravel.com) - Framework PHP
- [TailwindCSS](https://tailwindcss.com) - Framework CSS
- [Laravel Breeze](https://laravel.com/breeze) - Authentification

---

## 📊 Statistiques du projet

- **Contrôleurs** : 3
- **Modèles** : 5
- **Enums** : 2
- **Policies** : 1
- **Form Requests** : 2
- **Routes** : 20+
- **Vues Blade** : 35+

---

<div align="center">

**Fait avec ❤️ en utilisant Laravel**

⭐ Si ce projet vous plaît, n'hésitez pas à lui donner une étoile !

</div>
