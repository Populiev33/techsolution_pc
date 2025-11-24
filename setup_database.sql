-- Table actualites
CREATE TABLE IF NOT EXISTS `actualites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `date_publication` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table contacts
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_envoi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insérer des actualités de test
INSERT INTO `actualites` (`titre`, `contenu`, `auteur`, `date_publication`) VALUES 
('Nouvelle gamme de postes développement', 'Nous sommes fiers de présenter notre nouvelle gamme de postes de travail dédiés au développement et à l\'intelligence artificielle.', 'Admin TechSolutions', '2025-01-15'),
('Partenariat avec Microsoft', 'Nous sommes heureux d\'annoncer notre nouveau partenariat avec Microsoft.', 'Marketing', '2025-01-10');
