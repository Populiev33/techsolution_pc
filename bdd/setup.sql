-- Tables pour compléter le site TechSolutions

-- Table actualités
CREATE TABLE IF NOT EXISTS actualites (
  id INT PRIMARY KEY AUTO_INCREMENT,
  titre VARCHAR(200) NOT NULL,
  contenu TEXT NOT NULL,
  date_publication DATE NOT NULL,
  auteur VARCHAR(100)
);

-- Table administrateurs
CREATE TABLE IF NOT EXISTS admins (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- Table clients
CREATE TABLE IF NOT EXISTS clients (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(100) NOT NULL,
  prenom VARCHAR(100) NOT NULL,
  email VARCHAR(150) UNIQUE NOT NULL,
  telephone VARCHAR(20),
  password VARCHAR(255) NOT NULL,
  date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table messages de contact
CREATE TABLE IF NOT EXISTS contacts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  sujet VARCHAR(200) NOT NULL,
  message TEXT NOT NULL,
  date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP,
  traite BOOLEAN DEFAULT FALSE
);

-- Insérer un admin par défaut (mot de passe: admin123)
INSERT INTO admins (username, password) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insérer quelques actualités
INSERT INTO actualites (titre, contenu, date_publication, auteur) VALUES
('Lancement de notre nouveau service Cloud', 'TechSolutions est fière d''annoncer le lancement de son service de cloud computing sécurisé. Cette solution permet à nos clients de stocker et gérer leurs données en toute sécurité avec une disponibilité 24/7.', '2025-01-15', 'Direction'),
('Partenariat avec Microsoft', 'Nous sommes heureux d''annoncer notre nouveau partenariat avec Microsoft, renforçant notre expertise en solutions Azure et Microsoft 365 pour mieux servir nos clients.', '2025-01-10', 'Marketing'),
('Formation cybersécurité pour nos équipes', 'L''ensemble de nos équipes a suivi une formation avancée en cybersécurité pour garantir la protection optimale des données de nos clients.', '2025-01-05', 'RH');
