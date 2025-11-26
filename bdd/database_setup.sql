-- Database setup for TechSolutions
-- Run this script in phpMyAdmin or MySQL command line

USE techsolutions;

-- Create actualites table
CREATE TABLE IF NOT EXISTS actualites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NOT NULL,
    auteur VARCHAR(100) NOT NULL,
    date_publication DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create contacts table (if not exists)
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    sujet VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create composants table (if not exists)
CREATE TABLE IF NOT EXISTS composants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    poste VARCHAR(100) NOT NULL,
    categorie VARCHAR(100) NOT NULL,
    composant VARCHAR(255) NOT NULL
);

-- Insert sample data for actualites
INSERT INTO actualites (titre, contenu, auteur) VALUES
('Nouvelle gamme de postes développement', 'Nous sommes fiers de présenter notre nouvelle gamme de postes de travail dédiés au développement et à l''intelligence artificielle. Équipés des derniers processeurs AMD Ryzen 7 et de cartes graphiques RTX 4070 SUPER, ces configurations offrent des performances exceptionnelles pour vos projets les plus exigeants.', 'Admin TechSolutions'),
('Mise à jour de nos services', 'TechSolutions étend ses services avec de nouvelles solutions d''infrastructure IT. Notre équipe technique est désormais en mesure de vous accompagner dans la mise en place de solutions complètes pour équiper vos équipes.', 'Équipe Technique'),
('Support client renforcé', 'Pour mieux vous servir, nous avons renforcé notre service client avec une assistance technique dédiée disponible du lundi au vendredi de 9h à 18h. N''hésitez pas à nous contacter pour toute question.', 'Service Client');

-- Insert sample data for composants (if table is empty)
INSERT INTO composants (poste, categorie, composant) VALUES
('Développement & IA', 'Processeur', 'AMD Ryzen 7 7700X'),
('Développement & IA', 'Carte graphique', 'RTX 4070 SUPER 12GB'),
('Développement & IA', 'Mémoire', '32 Go DDR5-5600'),
('Développement & IA', 'Stockage', 'SSD NVMe 1TB'),
('UX / UI Design', 'Processeur', 'Intel Core i7-13700K'),
('UX / UI Design', 'Carte graphique', 'RTX 4080 SUPER 16GB'),
('UX / UI Design', 'Mémoire', '32 Go DDR5-5600'),
('UX / UI Design', 'Stockage', 'SSD NVMe 2TB');