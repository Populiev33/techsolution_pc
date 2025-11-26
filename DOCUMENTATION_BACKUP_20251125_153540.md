# Documentation Technique - TechSolutions

## 📋 Table des matières
1. [Installation](#installation)
2. [Structure du projet](#structure)
3. [Fonctionnalités](#fonctionnalités)
4. [Base de données](#base-de-données)
5. [Interface Administrateur](#interface-administrateur)
6. [Espace Client RGPD](#espace-client-rgpd)
7. [Spécifications techniques](#spécifications-techniques)
8. [Planification et maintenance](#planification-et-maintenance)
9. [Annexes](#annexes)

---

## 🚀 Installation

### Prérequis
- XAMPP (Apache + MySQL + PHP 7.4+)
- Navigateur web moderne (Chrome, Firefox, Edge)
- Compte administrateur MySQL

### Procédure d'installation

1. **Configuration de l'environnement**
   - Installer XAMPP
   - Lancer les services Apache et MySQL via le panneau de contrôle XAMPP

2. **Base de données**
   ```sql
   # Créer la base de données
   CREATE DATABASE techsolutions;
   USE techsolutions;
   
   # Importer la structure et les données
   SOURCE C:/xampp/htdocs/techsolutions/techsolution.sql;
   ```

3. **Configuration du site**
   - Vérifier les paramètres de connexion à la base de données dans les fichiers PHP
   - S'assurer que le serveur a les permissions d'écriture sur les dossiers nécessaires

4. **Accès**
   - Site principal : `http://localhost/techsolutions/`
   - Admin : `http://localhost/techsolutions/admin/` (admin/admin123)
   - Client : `http://localhost/techsolutions/client/`

---

## 📁 Structure du projet

```
techsolutions/
├── index.php              # Point d'entrée principal
├── admin/                 # Interface d'administration
│   └── index.php         
├── client/               # Espace client RGPD
│   └── index.php         
├── images/               # Ressources graphiques
│   └── iconetechsolutions.png
├── database/             # Scripts de base de données
│   ├── techsolution.sql  # Structure et données
│   └── migrations/       # Scripts de migration
├── includes/             # Fichiers d'inclusion
│   ├── config.php        # Configuration
│   ├── db.php           # Connexion base de données
│   └── functions.php     # Fonctions utilitaires
└── assets/               # Ressources statiques
    ├── css/
    ├── js/
    └── img/
```

---

## ⚙️ Fonctionnalités

### Pour les visiteurs
- Consultation des services et solutions
- Visualisation du catalogue produits
- Formulaire de contact
- Blog d'actualités

### Pour les clients
- Espace personnel sécurisé
- Gestion des données personnelles (RGPD)
- Historique des interactions

### Pour les administrateurs
- Gestion du contenu
- Administration des utilisateurs
- Gestion des messages
- Suivi des demandes

---

## 💾 Base de données

### Schéma principal

#### Table `composants`
- `id` : Identifiant unique
- `categorie` : Type de composant (Processeur, RAM, etc.)
- `composant` : Nom du composant
- `poste` : Type de poste concerné
- `prix_ttc` : Prix TTC

#### Table `actualites`
- `id` : Identifiant unique
- `titre` : Titre de l'article
- `contenu` : Contenu de l'article
- `date_publication` : Date de publication
- `auteur` : Auteur de l'article

#### Table `admins`
- `id` : Identifiant unique
- `username` : Nom d'utilisateur
- `password` : Mot de passe hashé (bcrypt)

#### Table `clients`
- `id` : Identifiant unique
- `nom` : Nom du client
- `prenom` : Prénom du client
- `email` : Email (unique)
- `telephone` : Téléphone
- `password` : Mot de passe hashé (bcrypt)
- `date_inscription` : Date de création du compte

#### Table `contacts`
- `id` : Identifiant unique
- `nom` : Nom de l'expéditeur
- `email` : Email de l'expéditeur
- `sujet` : Sujet du message
- `message` : Contenu du message
- `date_envoi` : Date d'envoi
- `traite` : Statut de traitement

---

## 👨‍💼 Interface Administrateur

### Connexion
- URL : `/admin/`
- Identifiants par défaut :
  - **Utilisateur** : `admin`
  - **Mot de passe** : `admin123`

### Tableau de bord
- Vue d'ensemble des statistiques
- Dernières actualités
- Messages non lus
- Alertes système

### Gestion du contenu
- Actualités (CRUD)
- Catalogue produits
- Pages du site

### Utilisateurs
- Gestion des administrateurs
- Gestion des clients
- Droits d'accès

---

## 👤 Espace Client RGPD

### Inscription
- Formulaire d'inscription sécurisé
- Validation par email (à implémenter)
- Conditions générales

### Gestion des données
- Consultation des données personnelles
- Mise à jour des informations
- Droit à l'oubli
- Export des données

### Sécurité
- Authentification à deux facteurs (2FA)
- Historique des connexions
- Réinitialisation sécurisée du mot de passe

---

## 💻 Spécifications techniques

### Configuration requise
- **Serveur** : Apache 2.4+
- **PHP** : 7.4 ou supérieur
- **MySQL** : 5.7 ou MariaDB 10.3+
- **Espace disque** : 100 Mo minimum

### Sécurité
- Protection contre les injections SQL
- Validation des entrées utilisateur
- Protection CSRF
- Mots de passe hashés (bcrypt)
- Headers de sécurité HTTP

### Performance
- Mise en cache
- Optimisation des requêtes SQL
- Compression GZIP
- Minification des assets

---

## 📅 Planification et maintenance

### Maintenance préventive
- Sauvegardes quotidiennes
- Mises à jour de sécurité
- Vérification des logs

### Évolutions prévues
- Module de facturation
- Intégration de paiement
- API RESTful
- Application mobile

---

## 📎 Annexes

### Liens utiles
- [Documentation PHP](https://www.php.net/docs.php)
- [Documentation MySQL](https://dev.mysql.com/doc/)
- [Guide Apache](https://httpd.apache.org/docs/)

### Contact support
- Email : support@techsolutions.fr
- Téléphone : +33 1 23 45 67 89
- Heures d'ouverture : 9h-18h du lundi au vendredi

---

*Dernière mise à jour : 25/11/2025*
