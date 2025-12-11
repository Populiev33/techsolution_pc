<?php
session_start();
$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';
$is_admin = isset($_SESSION['admin_id']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TechSolutions - Solutions Informatiques Professionnelles</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f8f9fa; }
        
        header { background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%); color: white; padding: 0; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }
        .header-top { padding: 20px 50px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #333; }
        .logo { font-size: 24px; font-weight: 600; letter-spacing: 1px; }
        nav { background: #222; }
        nav ul { list-style: none; display: flex; justify-content: center; }
        nav a { color: #ccc; text-decoration: none; padding: 18px 35px; display: block; transition: 0.2s; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; }
        nav a:hover, nav a.active { background: #333; color: white; }
        
        .hero { background: #2c2c2c; color: white; padding: 100px 50px; text-align: center; border-bottom: 3px solid #0066cc; }
        .hero h1 { font-size: 42px; margin-bottom: 20px; font-weight: 300; letter-spacing: 2px; }
        .hero p { font-size: 18px; color: #bbb; font-weight: 300; }
        
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }
        .services { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin: 40px 0; }
        .service-card { background: white; padding: 35px; border-radius: 2px; border-left: 4px solid #0066cc; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: 0.2s; }
        .service-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.12); border-left-color: #004999; }
        .service-card h3 { color: #1a1a1a; margin-bottom: 15px; font-size: 18px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .service-card p { color: #666; line-height: 1.6; font-size: 14px; }
        
        .filters { background: white; padding: 25px; border-radius: 2px; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-left: 4px solid #0066cc; }
        select { padding: 12px 20px; border: 1px solid #ddd; border-radius: 0; margin-right: 15px; font-size: 14px; background: white; }
        
        table { width: 100%; background: white; border-radius: 2px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        th, td { padding: 18px; text-align: left; border-bottom: 1px solid #e0e0e0; }
        th { background: #1a1a1a; color: white; font-weight: 500; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; }
        tr:hover { background: #f5f5f5; }
        td { font-size: 14px; color: #333; }
        
        footer { background: #1a1a1a; color: #999; text-align: center; padding: 40px; margin-top: 80px; font-size: 13px; letter-spacing: 0.5px; }
        
        .article { background: white; padding: 30px; margin-bottom: 25px; border-radius: 2px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-left: 4px solid #0066cc; }
        .article h3 { color: #1a1a1a; margin-bottom: 10px; font-size: 20px; }
        .article .meta { color: #999; font-size: 13px; margin-bottom: 15px; }
        .article p { color: #666; line-height: 1.8; }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #333; font-weight: 500; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 2px; font-size: 14px; font-family: inherit; }
        .form-group textarea { min-height: 150px; resize: vertical; }
        .btn { padding: 12px 30px; background: #0066cc; color: white; border: none; border-radius: 2px; font-size: 14px; cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; }
        .btn:hover { background: #0052a3; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 2px; }
        .alert-success { background: #d4edda; color: #155724; border-left: 4px solid #28a745; }
        .alert-error { background: #f8d7da; color: #721c24; border-left: 4px solid #dc3545; }
    </style>
</head>
<body>
    <header>
        <div class="header-top">
            <div class="logo"><img src="images/iconetechsolutions.png" alt="TechSolutions" style="height: 60px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3)); transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'"></div>
            <div style="color: #999; font-size: 13px; letter-spacing: 1px;">PROFESSIONAL IT SOLUTIONS</div>
        </div>
        <nav>
            <ul>
                <li><a href="?page=accueil" class="<?= $page=='accueil'?'active':'' ?>">Accueil</a></li>
                <li><a href="?page=actualites" class="<?= $page=='actualites'?'active':'' ?>">Actualités</a></li>
                <?php if ($is_admin): ?>
                <li><a href="?page=parc" class="<?= $page=='parc'?'active':'' ?>">Parc Informatique</a></li>
                <?php endif; ?>
                <li><a href="?page=services" class="<?= $page=='services'?'active':'' ?>">Services</a></li>
                <li><a href="?page=contact" class="<?= $page=='contact'?'active':'' ?>">Contact</a></li>
                <li><a href="admin/" style="background: #0066cc;">Admin</a></li>
            </ul>
        </nav>
    </header>

    <?php if ($page == 'accueil'): ?>
        <div class="hero">
            <h1>TECHSOLUTIONS - SERVICES INFORMATIQUES</h1>
            <p>Votre partenaire pour la modernisation de votre système d'information</p>
        </div>
        <div class="container">
            <h2 style="margin-bottom: 30px; color: #1a1a1a; font-size: 28px; font-weight: 300; letter-spacing: 1px; text-transform: uppercase;">Qui sommes-nous ?</h2>
            <div style="background: white; padding: 40px; margin-bottom: 40px; border-radius: 2px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-left: 4px solid #0066cc;">
                <p style="color: #666; line-height: 1.8; margin-bottom: 20px;">TechSolutions est une entreprise de services informatiques basée à Brive-la-Gaillarde, organisée en plusieurs départements spécialisés pour répondre à tous vos besoins en matière de solutions informatiques.</p>
                <p style="color: #666; line-height: 1.8;">Nous sommes fiers de notre culture inclusive, mettant un point d'honneur à accueillir et à soutenir les personnes en situation de handicap, en adaptant les postes de travail pour répondre à leurs besoins.</p>
            </div>
            <h2 style="margin-bottom: 30px; color: #1a1a1a; font-size: 28px; font-weight: 300; letter-spacing: 1px; text-transform: uppercase;">Nos Départements</h2>
            <div class="services">
                <div class="service-card">
                    <h3>Développement Logiciel</h3>
                    <p>15 personnes dédiées à la création et la maintenance de logiciels sur mesure pour nos clients.</p>
                </div>
                <div class="service-card">
                    <h3>Infrastructures Systèmes et Réseau</h3>
                    <p>5 experts chargés de la mise en place et de l'entretien des infrastructures informatiques, incluant les réseaux et les serveurs.</p>
                </div>
                <div class="service-card">
                    <h3>Design UX/UI</h3>
                    <p>5 designers spécialisés dans la conception d'interfaces utilisateur attrayantes et fonctionnelles.</p>
                </div>
                <div class="service-card">
                    <h3>Marketing et Vente</h3>
                    <p>10 collaborateurs s'occupant de la stratégie commerciale, de la promotion des services et de la relation client.</p>
                </div>
                <div class="service-card">
                    <h3>Support Client</h3>
                    <p>5 techniciens fournissant l'assistance technique et le support nécessaire à nos clients.</p>
                </div>
                <div class="service-card">
                    <h3>Ressources Humaines et Administration</h3>
                    <p>5 personnes gérant le personnel, le recrutement et les aspects administratifs de l'entreprise.</p>
                </div>
            </div>
        </div>
    
    <?php elseif ($page == 'parc'): ?>
        <?php
        if (!$is_admin) {
            echo '<div class="container"><div class="alert alert-error">Accès réservé aux administrateurs.</div></div>';
        } else {
        $conn = mysqli_connect("127.0.0.1", "root", "", "techsolutions");
        if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());
        
        $poste = isset($_GET['poste']) ? $_GET['poste'] : '';
        
        // Test
        $test = mysqli_query($conn, "SELECT COUNT(*) as nb FROM composants");
        $count = mysqli_fetch_assoc($test);
        ?>
        <div class="container">
            <h2 style="margin-bottom: 30px; color: #1a1a1a; font-size: 28px; font-weight: 300; letter-spacing: 1px; text-transform: uppercase;">Parc Informatique</h2>
            <p style="color: #999; margin-bottom: 20px;">Composants en base : <?= $count['nb'] ?></p>
            
            <div class="filters">
                <form method="GET">
                    <input type="hidden" name="page" value="parc">
                    <select name="poste" onchange="this.form.submit()">
                        <option value="">Choisir un type de poste</option>
                        <?php
                        $postes = mysqli_query($conn, "SELECT DISTINCT poste FROM composants ORDER BY poste");
                        $nb_postes = 0;
                        while ($p = mysqli_fetch_assoc($postes)) {
                            $nb_postes++;
                            $sel = ($poste == $p['poste']) ? 'selected' : '';
                            echo "<option value='{$p['poste']}' $sel>{$p['poste']}</option>";
                        }
                        ?>
                    </select>
                </form>
                <p style="color: #999; margin-top: 10px;">Postes trouvés : <?= $nb_postes ?></p>
            </div>

            <?php if ($poste): ?>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM composants WHERE poste = '" . mysqli_real_escape_string($conn, $poste) . "' ORDER BY categorie");
                $total = 0;
                ?>
                <h3 style="margin: 30px 0 20px; color: #0066cc; font-size: 22px; font-weight: 500;">Configuration : <?= htmlspecialchars($poste) ?></h3>
                <table>
                    <tr>
                        <th>Catégorie</th>
                        <th>Composant</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['categorie']) ?></td>
                        <td><?= htmlspecialchars($row['composant']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p style="text-align: center; color: #999; padding: 60px; background: white; border-radius: 2px;">Sélectionnez un type de poste pour voir sa configuration complète</p>
            <?php endif; ?>
        </div>
        <?php mysqli_close($conn); } ?>
    
    <?php elseif ($page == 'services'): ?>
        <div class="container">
            <h2 style="margin-bottom: 30px; color: #1a1a1a; font-size: 28px; font-weight: 300; letter-spacing: 1px; text-transform: uppercase;">Nos Services</h2>
            <div style="background: white; padding: 40px; margin-bottom: 40px; border-radius: 2px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-left: 4px solid #0066cc;">
                <p style="color: #666; line-height: 1.8; margin-bottom: 20px;">TechSolutions vous accompagne dans la modernisation de votre système d'information avec des solutions complètes et sur mesure.</p>
            </div>
            <div class="services">
                <div class="service-card">
                    <h3>Infrastructure Informatique</h3>
                    <p>Solutions complètes pour chaque poste de travail : composants PC fixes assemblés sur mesure, périphériques adaptés, logiciels professionnels, mise en réseau et cybersécurité.</p>
                </div>
                <div class="service-card">
                    <h3>Développement Web</h3>
                    <p>Conception de sites internet vitrines dynamiques avec interface administrateur pour la gestion de contenu, en conformité RGPD.</p>
                </div>
                <div class="service-card">
                    <h3>Accessibilité</h3>
                    <p>Adaptation de postes de travail pour employés en situation de handicap visuel, avec équipements d'accessibilité spécialisés et périphériques ergonomiques.</p>
                </div>
                <div class="service-card">
                    <h3>Conseil et Accompagnement</h3>
                    <p>Analyse de vos besoins, recommandations personnalisées et accompagnement dans le choix de vos solutions informatiques.</p>
                </div>
                <div class="service-card">
                    <h3>Support Technique</h3>
                    <p>Assistance technique dédiée, maintenance préventive et support pour garantir la continuité de votre activité.</p>
                </div>
                <div class="service-card">
                    <h3>Sécurité Informatique</h3>
                    <p>Mise en place de stratégies de cybersécurité adaptées à votre entreprise pour protéger vos données et vos systèmes.</p>
                </div>
            </div>
        </div>
    
    <?php elseif ($page == 'actualites'): ?>
        <?php
        // Actualités codées en dur
        $actualites = [
            [
                'titre' => 'Modernisation de notre système d\'information',
                'contenu' => 'TechSolutions a entrepris un projet ambitieux de modernisation de son système d\'information. Ce projet inclut le renouvellement complet de notre parc informatique avec des PC fixes assemblés sur mesure pour chaque département, adaptés aux besoins spécifiques de nos collaborateurs.',
                'auteur' => 'Direction',
                'date_publication' => '2025-01-15'
            ],
            [
                'titre' => 'Lancement de notre nouveau site vitrine',
                'contenu' => 'Nous sommes fiers de vous présenter notre nouveau site internet vitrine, développé en interne. Ce site dynamique permet à nos clients de découvrir nos services et de nous contacter facilement. Une interface administrateur permet la gestion du contenu en toute simplicité.',
                'auteur' => 'Département Développement',
                'date_publication' => '2025-01-10'
            ],
            [
                'titre' => 'Engagement pour l\'accessibilité',
                'contenu' => 'Dans le cadre de notre culture inclusive, nous avons équipé notre département Support Client avec des postes de travail adaptés pour nos collaborateurs en situation de handicap visuel. Ces équipements spécialisés garantissent un environnement de travail accessible à tous.',
                'auteur' => 'Ressources Humaines',
                'date_publication' => '2025-01-05'
            ]
        ];
        ?>
        <div class="container">
            <h2 style="margin-bottom: 30px; color: #1a1a1a; font-size: 28px; font-weight: 300; letter-spacing: 1px; text-transform: uppercase;">Actualités</h2>
            <?php foreach ($actualites as $article): ?>
            <div class="article">
                <h3><?= htmlspecialchars($article['titre']) ?></h3>
                <div class="meta"><?= date('d/m/Y', strtotime($article['date_publication'])) ?> - Par <?= htmlspecialchars($article['auteur']) ?></div>
                <p><?= htmlspecialchars($article['contenu']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    
    <?php elseif ($page == 'contact'): ?>
        <?php
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $conn = mysqli_connect("127.0.0.1", "root", "", "techsolutions");
            if ($conn) {
                $nom = mysqli_real_escape_string($conn, $_POST['nom']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $sujet = mysqli_real_escape_string($conn, $_POST['sujet']);
                $msg = mysqli_real_escape_string($conn, $_POST['message']);
                
                $sql = "INSERT INTO contacts (nom, email, sujet, message) VALUES ('$nom', '$email', '$sujet', '$msg')";
                if (mysqli_query($conn, $sql)) {
                    $message = '<div class="alert alert-success">Votre message a été envoyé avec succès !</div>';
                } else {
                    $message = '<div class="alert alert-error">Erreur lors de l\'envoi du message.</div>';
                }
                mysqli_close($conn);
            }
        }
        ?>
        <div class="container">
            <div style="background: white; padding: 60px; border-radius: 2px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); max-width: 700px; margin: 0 auto; border-left: 4px solid #0066cc;">
                <h2 style="color: #1a1a1a; margin-bottom: 40px; text-align: center; font-weight: 300; letter-spacing: 1px; text-transform: uppercase;">Contact</h2>
                
                <div style="line-height: 2.5; color: #333; margin-bottom: 40px;">
                    <p><strong style="display: inline-block; width: 120px; color: #666;">Email</strong> contact@techsolutions.fr</p>
                    <p><strong style="display: inline-block; width: 120px; color: #666;">Téléphone</strong> +33 1 23 45 67 89</p>
                    <p><strong style="display: inline-block; width: 120px; color: #666;">Adresse</strong> 12 rue des Innovateurs, 19100 Brive-la-Gaillarde</p>
                    <p><strong style="display: inline-block; width: 120px; color: #666;">Horaires</strong> Lundi - Vendredi : 9h00 - 18h00</p>
                </div>
                
                <h3 style="color: #0066cc; margin-bottom: 20px; font-size: 18px;">Formulaire de contact</h3>
                <?= $message ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Nom complet *</label>
                        <input type="text" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Sujet *</label>
                        <input type="text" name="sujet" required>
                    </div>
                    <div class="form-group">
                        <label>Message *</label>
                        <textarea name="message" required></textarea>
                    </div>
                    <button type="submit" class="btn">Envoyer le message</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <footer>
        <p>© 2024 TECHSOLUTIONS - TOUS DROITS RÉSERVÉS</p>
    </footer>
</body>
</html>
