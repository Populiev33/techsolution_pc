# TechSolutions - Site Web Vitrine

Site web vitrine

## 🚀 Installation rapide

### Prérequis
- XAMPP (Apache + MySQL + PHP)
- Navigateur web moderne

### Installation
```bash
# 1. Cloner/copier le projet dans htdocs
C:\xampp\htdocs\techsolutions\

# 2. Démarrer XAMPP
- Apache
- MySQL

# 3. Créer la base de données
http://localhost/techsolutions/setup_database.php

# 4. Créer le compte admin
http://localhost/techsolutions/admin/setup_admin.php

# 5. Accéder au site
http://localhost/techsolutions/
```

## 📁 Structure du projet

```
techsolutions/
├── admin/                  # Interface d'administration
│   ├── index.php          # Panneau admin principal
│   ├── setup_admin.php    # Création compte admin
│   └── generate_password.php
├── bdd/                   # Scripts base de données
│   ├── techsolutions.sql  # Structure complète
│   └── setup_database.sql # Installation
├── client/                # Interface client
├── devis/                 # Système de devis
├── images/                # Assets graphiques
├── Catalogue/             # Catalogue produits
├── index.php             # Page d'accueil
├── setup_database.php    # Installation BDD
└── README.md             # Ce fichier
```

## 🌐 Fonctionnalités du site

### Pages publiques
- **Accueil** : Présentation de l'entreprise et départements
- **Actualités** : News et annonces
- **Services** : Catalogue des services proposés
- **Contact** : Formulaire de contact et informations
- **Parc informatique** : Configurations matérielles (admin uniquement)

### Interface d'administration
- **Tableau de bord** : Statistiques et aperçu
- **Gestion actualités** : Ajout/suppression d'articles
- **Messages** : Consultation des demandes de contact
- **Authentification** : Système de connexion sécurisé

## 🔧 Commandes principales

### Installation initiale
```bash
# Créer la base de données
http://localhost/techsolutions/setup_database.php

# Créer le compte administrateur
http://localhost/techsolutions/admin/setup_admin.php
```

### Accès administrateur
```
URL : http://localhost/techsolutions/admin/
Identifiant par défaut : admin
Mot de passe par défaut : admin123
```

### Base de données
```sql
-- Connexion MySQL
mysql -u root -p

-- Utiliser la base
USE techsolutions;

-- Voir les tables
SHOW TABLES;

-- Vérifier les données
SELECT * FROM actualites;
SELECT * FROM contacts;
SELECT * FROM composants;
```

## 📊 Base de données

### Tables principales
- `actualites` : Articles et news
- `contacts` : Messages de contact
- `composants` : Catalogue matériel informatique
- `admins` : Comptes administrateurs

### Connexion BDD
```php
$conn = mysqli_connect("127.0.0.1", "root", "", "techsolutions");
```

## 🛠️ Configuration

### Apache (httpd.conf)
```apache
# Activer mod_rewrite
LoadModule rewrite_module modules/mod_rewrite.so

# Headers de sécurité
Header always set X-Frame-Options "SAMEORIGIN"
Header always set X-Content-Type-Options "nosniff"
```

### PHP (php.ini)
```ini
# Paramètres recommandés
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
```

### MySQL
```sql
-- Créer utilisateur dédié (optionnel)
CREATE USER 'techsolutions'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON techsolutions.* TO 'techsolutions'@'localhost';
```

## 🔒 Sécurité

### Mesures implémentées
- Mots de passe hashés (bcrypt)
- Protection injection SQL (mysqli_real_escape_string)
- Validation des entrées utilisateur
- Sessions sécurisées
- Headers de sécurité HTTP

### Recommandations production
```apache
# .htaccess pour sécuriser
Options -Indexes
<Files "*.sql">
    Deny from all
</Files>
<Files "*.log">
    Deny from all
</Files>
```

## 📱 Utilisation

### Ajouter une actualité
1. Se connecter à l'admin
2. Aller dans "Actualités"
3. Remplir le formulaire
4. Cliquer "Publier l'actualité"

### Consulter les messages
1. Interface admin → "Messages"
2. Voir tous les contacts reçus
3. Supprimer si nécessaire

### Gérer le parc informatique
1. Se connecter en tant qu'admin
2. Menu "Parc Informatique"
3. Filtrer par type de poste
4. Voir les configurations complètes

## 🐛 Dépannage

### Erreurs courantes
```bash
# Erreur connexion BDD
- Vérifier que MySQL est démarré
- Contrôler les paramètres de connexion

# Page blanche
- Activer l'affichage des erreurs PHP
- Vérifier les logs Apache

# Problème d'accès admin
- Recréer le compte via setup_admin.php
- Vérifier la table 'admins'
```

### Logs utiles
```bash
# Logs Apache
C:\xampp\apache\logs\error.log

# Logs MySQL
C:\xampp\mysql\data\mysql_error.log

# Logs PHP
C:\xampp\php\logs\php_error_log
```

## 🔄 Maintenance

### Sauvegardes
```bash
# Exporter la base
mysqldump -u root -p techsolutions > backup.sql

# Sauvegarder les fichiers
xcopy C:\xampp\htdocs\techsolutions\ backup\ /E /I
```

### Mises à jour
```bash
# Mettre à jour le catalogue
- Modifier Catalogue/catalogue.txt
- Réimporter en base si nécessaire

# Ajouter des fonctionnalités
- Développer dans des branches séparées
- Tester avant mise en production
```

## 📞 Support

### Contact technique
- **Email** : support@techsolutions.fr
- **Téléphone** : +33 1 23 45 67 89
- **Horaires** : 9h-18h (Lun-Ven)

### Ressources
- [Documentation PHP](https://www.php.net/docs.php)
- [Guide MySQL](https://dev.mysql.com/doc/)
- [Apache HTTP Server](https://httpd.apache.org/docs/)

---

**Version** : 1.0  
**Dernière mise à jour** : 25/11/2025  
**Développé par** : TechSolutions - Département Développement