# Documentation Fonctionnelle - Somatho

## 1. Présentation générale du projet

### Nom du projet
Somatho

### Objectif et contexte
Somatho est une application web dédiée à la gestion d'un cabinet de somatopathie. Elle permet de gérer les informations relatives aux thérapeutes, patients, traitements, articles de blog et factures. L'application facilite la gestion quotidienne d'un cabinet professionnel tout en offrant une vitrine publique pour présenter les services et partager des informations via un blog.

### Technologies utilisées
- **Backend** : Laravel 10 (PHP 8.1)
- **Frontend** : Vue.js 3 via Inertia.js, Livewire
- **Interface d'administration** : Filament 3
- **Base de données** : MySQL
- **Gestion d'authentification** : Laravel Sanctum
- **Styles** : Tailwind CSS
- **Icônes** : Font Awesome, Heroicons
- **Génération de PDF** : DomPDF

## 2. Structure du projet

### Arborescence des fichiers

```
somatho/
├── app/                # Code principal de l'application
│   ├── Console/        # Commandes d'artisan personnalisées
│   ├── Exceptions/     # Gestionnaires d'exceptions
│   ├── Filament/       # Configuration et personnalisation de Filament (admin)
│   ├── Forms/          # Formulaires Filament
│   ├── Http/           # Contrôleurs et middlewares
│   ├── Jobs/           # Jobs pour les tâches en arrière-plan
│   ├── Livewire/       # Composants Livewire (pages et composants)
│   ├── Models/         # Modèles Eloquent
│   ├── Notifications/  # Notifications du système
│   ├── Policies/       # Politiques d'autorisation
│   ├── Providers/      # Fournisseurs de services
│   ├── Repositories/   # Repositories pour l'accès aux données
│   ├── Services/       # Services métier
│   ├── Tables/         # Tables Filament
│   └── View/           # Composants de vue
├── bootstrap/          # Fichiers de démarrage de l'application
├── config/             # Fichiers de configuration
├── database/           # Migrations, factories et seeders
├── public/             # Fichiers accessibles publiquement
├── resources/          # Assets, vues et langues
├── routes/             # Définitions des routes
├── storage/            # Fichiers générés par l'application
├── tests/              # Tests automatisés
└── vendor/             # Dépendances Composer
```

### Principales conventions utilisées

- **Architecture** : L'application suit un modèle MVC avec l'utilisation de repositories et services pour la séparation des responsabilités.
- **Nommage** : 
  - Modèles : Noms singuliers avec PascalCase (ex: Article, Therapist)
  - Contrôleurs : Suffixe "Controller" (ex: ArticleController)
  - Tables : Noms pluriels en snake_case (ex: articles, therapists)
- **Routes** : Les routes sont organisées par domaine fonctionnel, avec préfixes API pour les endpoints d'API.
- **Interfaces** : Utilisation de Livewire pour les pages publiques et Filament pour l'interface d'administration.

## 3. Gestion des articles (Blog)

### Liste des articles
Les articles sont récupérés et affichés via le composant Livewire `Articles.php`. 

**Fonctionnalités** :
- Affichage des articles épinglés en premier
- Chargement paginé (8 articles à la fois) avec chargement automatique au scroll
- Filtrage des articles par tags
- Tri chronologique (du plus récent au plus ancien)
- Affichage conditionnel basé sur la date de publication (articles publiés uniquement)

**Code impliqué** :
- `app/Livewire/Components/Articles.php` : Composant principal de liste d'articles
- `app/Livewire/Components/ArticlePreview.php` : Prévisualisation d'un article dans la liste
- `resources/views/livewire/components/articles.blade.php` : Vue de la liste

### Détail d'un article
Un article individuel est accessible via une URL dédiée avec son slug. Le composant `Article.php` gère l'affichage d'un article.

**Fonctionnalités** :
- Affichage du contenu complet de l'article
- Affichage des tags associés
- Métadonnées pour SEO
- Date de mise à jour

**Code impliqué** :
- `app/Livewire/Pages/Article.php` : Composant pour l'affichage d'un article
- `resources/views/livewire/pages/article.blade.php` : Vue de l'article

### Ajout d'un article
L'ajout d'articles se fait via l'interface d'administration Filament.

**Processus** :
1. L'utilisateur accède à la section Articles dans le panneau d'administration
2. Il clique sur "Create Article"
3. Il remplit les champs requis :
   - Titre (générant automatiquement un slug)
   - Contenu (éditeur riche)
   - Date de publication
   - Image principale et miniature
   - Tags (existants ou nouveaux)
   - Option pour épingler l'article
4. Soumission du formulaire qui déclenche la création en base de données

**Validations** :
- Titre obligatoire
- Contenu obligatoire
- Image obligatoire
- Date de publication obligatoire (par défaut la date actuelle)

**Code impliqué** :
- `app/Filament/Resources/ArticleResource.php` : Définition du formulaire et des champs
- `app/Filament/Resources/ArticleResource/Pages/CreateArticle.php` : Logique de création

### Modification d'un article
La modification d'articles se fait également via l'interface Filament.

**Processus** :
1. L'utilisateur accède à la liste des articles dans l'administration
2. Il clique sur le bouton d'édition d'un article
3. Il modifie les champs souhaités
4. Soumission du formulaire pour enregistrer les modifications

**Règles de validation** :
- Identiques à celles de la création

**Code impliqué** :
- `app/Filament/Resources/ArticleResource.php` : Définition du formulaire
- `app/Filament/Resources/ArticleResource/Pages/EditArticle.php` : Logique de modification

### Suppression d'un article
La suppression se fait via l'interface d'administration Filament.

**Processus** :
1. L'utilisateur accède à la liste des articles
2. Il sélectionne l'action de suppression sur un article
3. Une confirmation est demandée
4. L'article est supprimé de la base de données

**Précautions** :
- La suppression est définitive (pas de corbeille)
- Les relations avec les tags sont supprimées automatiquement (cascade)

### Permissions et rôles
La gestion des articles est soumise à un système de permissions :

- **Admin** : Accès complet (création, modification, suppression de tous les articles)
- **Éditeur** : Peut créer et modifier des articles, mais pas les supprimer
- **Utilisateur standard** : Lecture seule des articles publiés

Ces permissions sont gérées via les politiques Laravel (`app/Policies/ArticlePolicy.php`).

### APIs utilisées

**Endpoints relatifs aux articles** :
- `GET /articles` : Page listant les articles (Livewire)
- `GET /articles/{slug}` : Page d'affichage d'un article (Livewire)

**Format des données** :
Le modèle Article contient les champs suivants :
- id
- title (string)
- slug (string)
- content (longText)
- published_at (date)
- is_pinned (boolean)
- image (string)
- image_thumbnail_url (string)
- created_at, updated_at (timestamps)

## 4. Gestion des utilisateurs

### Présentation
Le système de gestion des utilisateurs permet de gérer différents types d'utilisateurs avec des rôles et permissions distincts. Il sert de base pour l'authentification et le contrôle d'accès à travers l'application.

### Types d'utilisateurs
Le système distingue principalement deux types d'utilisateurs :

- **Thérapeutes** : Professionnels de santé qui utilisent la plateforme pour gérer leurs patients et leurs activités
- **Patients** : Clients des thérapeutes qui ont accès à un espace restreint de l'application

### Liste des utilisateurs
La liste des utilisateurs est accessible dans l'interface d'administration Filament.

**Fonctionnalités** :
- Affichage paginé des utilisateurs
- Filtrage par rôle, par statut (actif/inactif)
- Recherche par nom, email
- Tri par différents critères (nom, date d'inscription, etc.)

**Code impliqué** :
- `app/Filament/Resources/UserResource.php` : Définition de la ressource utilisateur
- `app/Models/User.php` : Modèle Eloquent de l'utilisateur

### Détail d'un utilisateur
La page de détail d'un utilisateur présente toutes les informations relatives à un compte.

**Fonctionnalités** :
- Affichage des informations personnelles
- Accès aux adresses liées
- Historique des activités (si applicable)
- Gestion des rôles et permissions

### Ajout d'un utilisateur
L'ajout d'utilisateurs se fait via l'interface d'administration.

**Processus** :
1. L'administrateur accède à la section Utilisateurs
2. Il clique sur "Créer un utilisateur"
3. Il remplit les champs requis :
   - Nom, prénom
   - Email (identifiant unique)
   - Mot de passe temporaire
   - Rôle(s) assigné(s)
   - Informations supplémentaires selon le type d'utilisateur
4. Soumission du formulaire

**Validations** :
- Email requis et unique
- Mot de passe conforme aux règles de sécurité
- Nom et prénom obligatoires

### Modification d'un utilisateur
La modification se fait via l'interface d'administration.

**Processus** :
1. L'administrateur accède à la liste des utilisateurs
2. Il clique sur l'utilisateur à modifier
3. Il modifie les champs souhaités
4. Soumission du formulaire

**Validations** :
- Similaires à celles de la création
- Vérification supplémentaire lors du changement d'email

### Suppression d'un utilisateur
La suppression d'un utilisateur peut être définitive ou "soft delete" (désactivation sans suppression des données).

**Processus** :
1. L'administrateur accède à la liste des utilisateurs
2. Il sélectionne l'action de suppression pour un utilisateur
3. Une confirmation est demandée
4. L'utilisateur est désactivé ou supprimé selon la configuration

**Précautions** :
- Vérification des dépendances (factures, rendez-vous) avant suppression définitive
- Option de transfert des données vers un autre utilisateur si nécessaire

### Authentification
Le système utilise Laravel Sanctum pour l'authentification et la gestion des tokens d'API.

**Fonctionnalités** :
- Connexion par email/mot de passe
- Maintien de session sécurisée
- Protection CSRF
- Vérification d'email pour les nouveaux comptes
- Option "Se souvenir de moi"
- Récupération de mot de passe

**Code impliqué** :
- Routes définies dans `routes/auth.php`
- Logique d'authentification standard de Laravel

### Format des données
Le modèle User contient les champs suivants :
- id
- name
- email
- email_verified_at
- password (hashé)
- remember_token
- created_at, updated_at (timestamps)

## 5. Gestion des thérapeutes

### Présentation
Les thérapeutes sont les professionnels de santé utilisant la plateforme. Ils disposent d'un profil enrichi et de fonctionnalités spécifiques pour gérer leur activité.

### Liste des thérapeutes
La liste des thérapeutes est disponible dans l'interface d'administration et partiellement sur le site public.

**Fonctionnalités** :
- Affichage avec filtres et recherche dans l'administration
- Affichage public selon les paramètres de visibilité
- Tri par spécialités, localisation, disponibilité

**Code impliqué** :
- `app/Models/Therapist.php` : Modèle principal
- `app/Filament/Resources/TherapistResource.php` : Ressource d'administration

### Détail d'un thérapeute
Le profil détaillé d'un thérapeute contient ses informations professionnelles et de contact.

**Fonctionnalités** :
- Informations personnelles et professionnelles
- Liste des traitements proposés
- Disponibilités et horaires
- Coordonnées de contact
- Adresses professionnelles

### Ajout d'un thérapeute
L'ajout d'un thérapeute se fait via l'interface d'administration.

**Processus** :
1. L'administrateur accède à la section Thérapeutes
2. Il clique sur "Créer un thérapeute"
3. Il remplit les informations:
   - Informations de base (nom, email, mot de passe)
   - Informations professionnelles (spécialités, numéro professionnel)
   - Coordonnées professionnelles
   - Traitements proposés
   - Configuration du compte (permissions)
4. Soumission du formulaire

**Validations** :
- Informations de base obligatoires
- Vérification des numéros professionnels
- Validation des coordonnées

### Modification d'un thérapeute
La modification se fait via l'interface d'administration ou par le thérapeute lui-même pour certaines informations.

**Processus** :
1. Accès à la fiche du thérapeute
2. Modification des champs souhaités
3. Soumission du formulaire

### Association aux traitements
Les thérapeutes peuvent être associés à différents traitements qu'ils pratiquent.

**Processus** :
1. Dans le profil du thérapeute, accéder à la section Traitements
2. Ajouter/retirer des traitements de la liste des traitements disponibles
3. Configurer éventuellement des paramètres spécifiques (prix, durée, etc.)

### Format des données
Le modèle Therapist contient les champs suivants :
- id
- user_id (relation avec User)
- professional_id (identifiant professionnel)
- biography
- specialties
- is_verified (statut de vérification)
- created_at, updated_at (timestamps)

### APIs utilisées
- `GET /api/therapist/{therapist}/patients/index` : Récupération des patients d'un thérapeute
- `GET /api/therapist/{therapist}/address` : Récupération des adresses d'un thérapeute

## 6. Gestion des traitements

### Présentation
Les traitements représentent les différents services et soins proposés par les thérapeutes. Cette fonctionnalité permet de gérer le catalogue des prestations disponibles.

### Liste des traitements
La liste des traitements est accessible via l'interface d'administration et sur le site public.

**Fonctionnalités** :
- Affichage paginé et filtrable dans l'administration
- Présentation publique catégorisée
- Recherche par nom, catégorie, symptômes associés

**Code impliqué** :
- `app/Models/Traitment.php` : Modèle du traitement
- `app/Livewire/Pages/Traitment.php` : Composant d'affichage public

### Détail d'un traitement
La page de détail d'un traitement présente l'ensemble des informations sur une prestation.

**Fonctionnalités** :
- Description détaillée
- Durée et tarifs
- Indications et contre-indications
- Thérapeutes proposant ce traitement
- Métadonnées pour SEO

### Ajout d'un traitement
L'ajout se fait via l'interface d'administration.

**Processus** :
1. L'administrateur accède à la section Traitements
2. Il clique sur "Créer un traitement"
3. Il remplit les champs:
   - Nom et slug
   - Description complète
   - Durée estimée
   - Tarif de base
   - Catégorie(s)
   - Images illustratives
4. Soumission du formulaire

**Validations** :
- Nom unique et obligatoire
- Description obligatoire
- Tarif et durée dans des plages acceptables
- Format d'image valide

### Modification d'un traitement
La modification se fait via l'interface d'administration.

**Processus** :
1. Accès à la liste des traitements
2. Sélection du traitement à modifier
3. Modification des champs souhaités
4. Soumission du formulaire

### Suppression d'un traitement
La suppression se fait via l'interface d'administration.

**Processus** :
1. Accès à la liste des traitements
2. Sélection de l'action de suppression
3. Confirmation de la suppression

**Précautions** :
- Vérification des dépendances (rendez-vous programmés avec ce traitement)
- Option pour désactiver temporairement plutôt que supprimer

### Format des données
Le modèle Traitment contient les champs suivants :
- id
- name
- slug
- description
- duration (en minutes)
- base_price
- image_url
- is_active
- created_at, updated_at (timestamps)

## 7. Gestion des factures

### Présentation
Le système de facturation permet de générer, gérer et suivre les factures émises pour les patients.

### Liste des factures
La liste des factures est accessible dans l'interface d'administration.

**Fonctionnalités** :
- Affichage paginé avec filtres (date, statut, client)
- Recherche par numéro, client ou montant
- Tri par différents critères
- Indicateurs visuels de statut (payée, en attente, annulée)

**Code impliqué** :
- `app/Models/Invoice.php` : Modèle de la facture
- `app/Filament/Resources/InvoiceResource.php` : Ressource d'administration

### Détail d'une facture
La page de détail affiche l'ensemble des informations d'une facture.

**Fonctionnalités** :
- Informations complètes (client, date, montants)
- Liste des prestations facturées
- Historique des paiements associés
- Options pour l'export PDF

### Création d'une facture
La création se fait via l'interface d'administration.

**Processus** :
1. Accès à la section Factures
2. Cliquer sur "Créer une facture"
3. Sélection du client
4. Ajout des prestations facturées:
   - Sélection des traitements
   - Ajustement des quantités et montants si nécessaire
   - Application de remises éventuelles
5. Configuration des modalités de paiement
6. Soumission du formulaire

**Validations** :
- Client obligatoire
- Au moins une prestation
- Montants cohérents
- Date d'émission valide

### Modification d'une facture
La modification est possible tant que la facture n'est pas marquée comme payée.

**Processus** :
1. Accès à la facture
2. Modification des éléments nécessaires
3. Soumission du formulaire

**Restrictions** :
- Modifications limitées ou interdites pour les factures déjà payées
- Conservation d'un historique des modifications

### Génération PDF
L'application permet de générer des factures au format PDF.

**Fonctionnalités** :
- Mise en page professionnelle
- Inclusion de toutes les informations légales
- Options d'envoi par email
- Archivage automatique

**Code impliqué** :
- Utilisation de DomPDF via `barryvdh/laravel-dompdf`
- Template défini dans `resources/views/pdf/invoice.blade.php`

### Suivi des paiements
Le système permet de suivre l'état des paiements pour chaque facture.

**Fonctionnalités** :
- Enregistrement des paiements partiels
- Mise à jour automatique du statut
- Historique des transactions
- Relances automatiques (si configurées)

### Format des données
Le modèle Invoice contient les champs suivants :
- id
- number (numéro séquentiel unique)
- user_id (client)
- therapist_id (émetteur)
- amount_total
- amount_tax
- amount_paid
- due_date
- status (draft, sent, paid, cancelled)
- notes
- created_at, updated_at (timestamps)

## 8. Gestion des adresses

### Présentation
Le système de gestion d'adresses permet de stocker et gérer les coordonnées postales des utilisateurs et thérapeutes.

### Types d'adresses
L'application distingue différents types d'adresses:
- Adresses personnelles des utilisateurs
- Adresses professionnelles des thérapeutes
- Adresses de facturation

### Liste des adresses
Les adresses sont accessibles via les profils des utilisateurs ou thérapeutes.

**Fonctionnalités** :
- Affichage contextuel (dans le profil utilisateur)
- Options de filtre par type
- Marquage d'adresse par défaut

**Code impliqué** :
- `app/Models/Address.php` : Modèle principal
- `app/Models/UserAddress.php` : Association utilisateur-adresse
- `app/Models/TherapistAddress.php` : Association thérapeute-adresse

### Ajout d'une adresse
L'ajout se fait depuis le profil utilisateur ou thérapeute.

**Processus** :
1. Accès à la section Adresses du profil
2. Cliquer sur "Ajouter une adresse"
3. Remplir le formulaire:
   - Libellé (domicile, bureau, etc.)
   - Nom du destinataire
   - Rue, numéro
   - Code postal, ville
   - Pays
   - Type d'adresse
4. Option pour définir comme adresse par défaut
5. Soumission du formulaire

**Validations** :
- Champs obligatoires: rue, code postal, ville, pays
- Format de code postal valide selon le pays
- Limitation du nombre d'adresses par utilisateur (si applicable)

### Modification d'une adresse
La modification se fait depuis le profil.

**Processus** :
1. Accès à la liste des adresses
2. Sélection de l'adresse à modifier
3. Modification des champs
4. Soumission du formulaire

### Suppression d'une adresse
La suppression est possible si l'adresse n'est pas utilisée dans des documents existants.

**Processus** :
1. Accès à la liste des adresses
2. Sélection de l'action de suppression
3. Confirmation

**Précautions** :
- Vérification des dépendances (factures utilisant cette adresse)
- Empêcher la suppression de la dernière adresse ou de l'adresse par défaut

### Format des données
Le modèle Address contient les champs suivants :
- id
- label (libellé personnalisé)
- recipient_name
- street_line1
- street_line2 (optionnel)
- postal_code
- city
- country
- type (shipping, billing, professional)
- is_default
- created_at, updated_at (timestamps)

### APIs utilisées
- `GET /api/patient/{user}/address` : Récupération des adresses d'un patient
- `GET /api/therapist/{therapist}/address` : Récupération des adresses d'un thérapeute

## 9. Gestion des tags

### Présentation
Les tags permettent de catégoriser et filtrer différents éléments du système, notamment les articles.

### Liste des tags
La liste des tags est accessible dans l'interface d'administration.

**Fonctionnalités** :
- Affichage avec code couleur
- Information sur le nombre d'utilisations
- Filtrage et recherche

**Code impliqué** :
- `app/Models/Tag.php` : Modèle du tag

### Ajout d'un tag
L'ajout peut se faire directement lors de la création d'un article ou via l'interface dédiée.

**Processus** :
1. Accès à la section Tags ou au formulaire d'article
2. Création du tag avec:
   - Nom
   - Couleur associée
3. Soumission du formulaire

**Validations** :
- Nom unique et obligatoire
- Couleur valide

### Modification d'un tag
La modification se fait via l'interface d'administration.

**Processus** :
1. Accès à la liste des tags
2. Sélection du tag à modifier
3. Modification du nom ou de la couleur
4. Soumission du formulaire

### Suppression d'un tag
La suppression est possible si le tag n'est pas utilisé.

**Processus** :
1. Accès à la liste des tags
2. Sélection de l'action de suppression
3. Confirmation

**Précautions** :
- Vérification des associations avant suppression
- Option pour dissocier automatiquement le tag des éléments associés

### Format des données
Le modèle Tag contient les champs suivants :
- id
- name
- color

## 10. Installation et configuration

### Prérequis
- PHP 8.1 ou supérieur
- Composer
- Node.js et NPM
- MySQL 8.0 ou supérieur
- Extensions PHP : BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

### Installation
1. Cloner le dépôt : `git clone <repository-url>`
2. Installer les dépendances PHP : `composer install`
3. Installer les dépendances JS : `npm install`
4. Copier `.env.example` vers `.env` et configurer les paramètres de base de données
5. Générer la clé d'application : `php artisan key:generate`
6. Exécuter les migrations : `php artisan migrate`
7. Compiler les assets : `npm run dev` (développement) ou `npm run build` (production)
8. Lancer le serveur : `php artisan serve`

### Docker
Le projet inclut une configuration Docker pour le développement local :
1. Assurez-vous que Docker et Docker Compose sont installés
2. Exécutez `docker-compose up -d`
3. L'application sera disponible sur http://localhost

## 11. Exemples et scénarios d'utilisation

### Flux utilisateur : Création et publication d'un article
1. L'administrateur se connecte à l'interface d'administration
2. Il navigue vers la section Articles et clique sur "Create Article"
3. Il remplit les champs obligatoires :
   - Titre : "Les bienfaits de la somatopathie"
   - Contenu détaillé avec mise en forme
   - Sélection de tags : "Bien-être", "Santé"
   - Ajout d'une image principale et miniature
   - Date de publication : immédiate ou future
4. Il soumet le formulaire
5. L'article est créé en base de données
6. L'article devient visible sur le site public une fois la date de publication atteinte

### Flux utilisateur : Gestion d'un patient par un thérapeute
1. Le thérapeute se connecte à son espace
2. Il accède à la liste de ses patients
3. Il sélectionne un patient ou en crée un nouveau
4. Il consulte l'historique des soins
5. Il peut programmer un nouveau rendez-vous
6. Il peut générer une facture pour une ou plusieurs sessions

### Flux utilisateur : Génération d'une facture
1. Le thérapeute accède à l'espace facturation
2. Il sélectionne le patient concerné
3. Il ajoute les traitements effectués avec leurs tarifs
4. Il configure les modalités de paiement
5. Il génère la facture en PDF
6. Il envoie la facture par email ou l'imprime directement

### Cas d'utilisation spécifiques
- **Articles programmés** : Possibilité de créer des articles qui seront publiés automatiquement à une date future
- **Articles épinglés** : Certains articles peuvent être épinglés pour apparaître en haut de la liste
- **Gestion des tags** : Les tags peuvent être ajoutés directement lors de la création d'un article
- **Tarification personnalisée** : Un thérapeute peut définir des tarifs spécifiques pour certains patients

## 12. Bonnes pratiques et recommandations

### Contribution au projet
Pour contribuer au projet :
1. Créer une branche à partir de `main` pour chaque fonctionnalité ou correctif
2. Suivre les conventions de codage (PSR-12 pour PHP)
3. Écrire des tests pour les nouvelles fonctionnalités
4. Soumettre une pull request avec une description claire des changements

### Stratégies de tests
- **Tests unitaires** : Utilisation de PHPUnit pour tester les composants individuels
- **Tests d'intégration** : Vérification des interactions entre les différents modules
- **Tests de navigateur** : Utilisation de Laravel Dusk pour les tests end-to-end

### Optimisations et performances
- Mise en cache des requêtes fréquentes
- Compression des assets (CSS/JS)
- Utilisation de lazy loading pour les images
- Pagination et chargement à la demande pour les listes longues 