# Documentation TechSolutions - Site Vitrine

## 📋 Table des matières
1. [Installation](#installation)
2. [Structure du site](#structure)
3. [Fonctionnalités](#fonctionnalités)
4. [Interface Administrateur](#admin)
5. [Espace Client RGPD](#client)
6. [Base de données](#database)

---

## 🚀 Installation

### Prérequis
- XAMPP (Apache + MySQL + PHP)
- Navigateur web moderne

### Étapes d'installation

1. **Démarrer XAMPP**
   - Lancer Apache
   - Lancer MySQL

2. **Importer la base de données**
   - Ouvrir phpMyAdmin : `http://localhost/phpmyadmin`
   - Créer une base de données nommée `techsolutions`
   - Importer le fichier `setup.sql` pour créer les tables

3. **Accéder au site**
   - Site principal : `http://localhost/techsolutions/`
   - Interface admin : `http://localhost/techsolutions/admin/`
   - Espace client : `http://localhost/techsolutions/client/`

---

## 📁 Structure du site

```
techsolutions/
├── index.php              # Page principale du site
├── setup.sql              # Script de création des tables
├── techsolution.sql       # Données des composants
├── DOCUMENTATION.md       # Ce fichier
├── images/
│   └── iconetechsolutions.png
├── admin/
│   └── index.php          # Interface administrateur
└── client/
    └── index.php          # Espace client RGPD
```

---

## ⚙️ Fonctionnalités

### Pages publiques

#### 🏠 Accueil
- Présentation de l'entreprise
- Services proposés
- Design professionnel

#### 📰 Actualités
- Articles sur les projets et tendances
- Affichage chronologique
- Gestion via l'interface admin

#### 💻 Parc Informatique
- Catalogue des configurations par type de poste
- Sélection dynamique
- Affichage des composants

#### 🛠️ Services
- Détail des services par département
- Développement & IA
- UX/UI Design
- Marketing
- Administration
- Support technique
- Accessibilité

#### 📧 Contact
- Formulaire de contact fonctionnel
- Stockage des messages en base de données
- Consultation via l'interface admin

---

## 👨‍💼 Interface Administrateur

### Accès
- URL : `http://localhost/techsolutions/admin/`
- Identifiants par défaut :
  - **Username** : `admin`
  - **Password** : `admin123`

### Fonctionnalités

#### 📊 Tableau de bord
- Statistiques en temps réel
- Nombre d'actualités publiées
- Nombre de messages reçus
- Nombre de composants en catalogue
- Aperçu des derniers messages

#### 📰 Gestion des actualités
- Ajouter une nouvelle actualité
- Supprimer une actualité
- Champs : titre, contenu, auteur, date

#### ✉️ Gestion des messages
- Consultation de tous les messages de contact
- Informations : date, nom, email, sujet, message
- Suppression des messages traités

### Sécurité
- Authentification par mot de passe hashé (bcrypt)
- Sessions sécurisées
- Protection contre les injections SQL

---

## 👤 Espace Client RGPD

### Accès
- URL : `http://localhost/techsolutions/client/`

### Fonctionnalités

#### Inscription
- Création de compte client
- Champs : nom, prénom, email, téléphone, mot de passe
- Validation de l'unicité de l'email

#### Connexion
- Authentification sécurisée
- Mot de passe hashé

#### Gestion des données personnelles (RGPD)
- **Consultation** : Voir toutes ses données
- **Modification** : Mettre à jour ses informations
- **Suppression** : Droit à l'oubli (suppression définitive du compte)

### Conformité RGPD
✅ Droit d'accès aux données  
✅ Droit de rectification  
✅ Droit à l'effacement (droit à l'oubli)  
✅ Information claire sur l'utilisation des données  
✅ Stockage sécurisé (mots de passe hashés)

---

## 🗄️ Base de données

### Tables

#### `composants`
Stocke tous les composants du parc informatique
- `id` : Identifiant unique
- `categorie` : Type de composant (Processeur, RAM, etc.)
- `composant` : Nom du composant
- `poste` : Type de poste concerné
- `prix_ttc` : Prix TTC

#### `actualites`
Stocke les articles d'actualité
- `id` : Identifiant unique
- `titre` : Titre de l'article
- `contenu` : Contenu de l'article
- `date_publication` : Date de publication
- `auteur` : Auteur de l'article

#### `admins`
Stocke les comptes administrateurs
- `id` : Identifiant unique
- `username` : Nom d'utilisateur
- `password` : Mot de passe hashé

#### `clients`
Stocke les comptes clients (RGPD)
- `id` : Identifiant unique
- `nom` : Nom du client
- `prenom` : Prénom du client
- `email` : Email (unique)
- `telephone` : Téléphone
- `password` : Mot de passe hashé
- `date_inscription` : Date de création du compte

#### `contacts`
Stocke les messages de contact
- `id` : Identifiant unique
- `nom` : Nom de l'expéditeur
- `email` : Email de l'expéditeur
- `sujet` : Sujet du message
- `message` : Contenu du message
- `date_envoi` : Date d'envoi
- `traite` : Statut de traitement

---

## 🔧 Technologies utilisées

- **Front-end** : HTML5, CSS3, JavaScript
- **Back-end** : PHP 7+
- **Base de données** : MySQL
- **Serveur** : Apache (XAMPP)
- **Sécurité** : Password hashing (bcrypt), Sessions PHP, Protection SQL injection

---

## 📝 Notes importantes

### Sécurité
- Changer le mot de passe admin par défaut en production
- Utiliser HTTPS en production
- Configurer les permissions de fichiers appropriées

### RGPD
- Le site est conforme aux exigences RGPD de base
- Les clients peuvent gérer leurs données personnelles
- Droit à l'oubli implémenté

### Maintenance
- Sauvegarder régulièrement la base de données
- Mettre à jour PHP et MySQL
- Vérifier les logs d'erreurs

---

## 📞 Support

Pour toute question ou problème :
- Email : contact@techsolutions.fr
- Téléphone : +33 1 23 45 67 89
- Adresse : 12 rue des Innovateurs, 19100 Brive-la-Gaillarde

---

**© 2025 TechSolutions - Tous droits réservés**
