<?php
session_start();

// Connexion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $conn = mysqli_connect("127.0.0.1", "root", "", "techsolutions");
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    $result = mysqli_query($conn, "SELECT * FROM admins WHERE username = '$username'");
    $admin = mysqli_fetch_assoc($result);
    
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        header('Location: index.php');
        exit;
    } else {
        $error = "Identifiants incorrects";
    }
    mysqli_close($conn);
}

// Déconnexion
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Vérifier si connecté
if (!isset($_SESSION['admin_id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Connexion Admin - TechSolutions</title>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: Arial, sans-serif; background: #f5f5f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
            .login-box { background: white; padding: 40px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
            h1 { color: #1a1a1a; margin-bottom: 30px; text-align: center; }
            .form-group { margin-bottom: 20px; }
            label { display: block; margin-bottom: 8px; color: #333; font-weight: 500; }
            input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 3px; font-size: 14px; }
            button { width: 100%; padding: 12px; background: #0066cc; color: white; border: none; border-radius: 3px; font-size: 14px; cursor: pointer; }
            button:hover { background: #0052a3; }
            .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 3px; margin-bottom: 20px; }
            .back { text-align: center; margin-top: 20px; }
            .back a { color: #0066cc; text-decoration: none; }
        </style>
    </head>
    <body>
        <div class="login-box">
            <h1>Connexion Admin</h1>
            <?php if (isset($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" name="login">Se connecter</button>
            </form>
            <div class="back">
                <a href="../">← Retour au site</a>
            </div>
            <p style="margin-top: 20px; text-align: center; color: #999; font-size: 12px;">Par défaut: admin / admin123</p>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Interface admin
$conn = mysqli_connect("127.0.0.1", "root", "", "techsolutions");
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Ajouter une actualité
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_article'])) {
    $titre = mysqli_real_escape_string($conn, $_POST['titre']);
    $contenu = mysqli_real_escape_string($conn, $_POST['contenu']);
    $auteur = mysqli_real_escape_string($conn, $_POST['auteur']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    
    mysqli_query($conn, "INSERT INTO actualites (titre, contenu, date_publication, auteur) VALUES ('$titre', '$contenu', '$date', '$auteur')");
    $success = "Actualité ajoutée avec succès";
}

// Supprimer une actualité
if (isset($_GET['delete_article'])) {
    $id = (int)$_GET['delete_article'];
    mysqli_query($conn, "DELETE FROM actualites WHERE id = $id");
    header('Location: ?page=actualites');
    exit;
}

// Supprimer un message
if (isset($_GET['delete_contact'])) {
    $id = (int)$_GET['delete_contact'];
    mysqli_query($conn, "DELETE FROM contacts WHERE id = $id");
    header('Location: ?page=contacts');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration - TechSolutions</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #1a1a1a; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 20px; }
        .header a { color: white; text-decoration: none; padding: 8px 15px; background: #dc3545; border-radius: 3px; }
        .sidebar { position: fixed; left: 0; top: 60px; width: 250px; background: #2c2c2c; height: calc(100vh - 60px); padding: 20px 0; }
        .sidebar a { display: block; color: #ccc; text-decoration: none; padding: 15px 25px; transition: 0.2s; }
        .sidebar a:hover, .sidebar a.active { background: #0066cc; color: white; }
        .content { margin-left: 250px; padding: 40px; }
        .card { background: white; padding: 30px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        .card h2 { color: #1a1a1a; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; font-weight: 600; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #333; font-weight: 500; }
        input, textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 3px; font-size: 14px; font-family: inherit; }
        textarea { min-height: 150px; resize: vertical; }
        .btn { padding: 10px 20px; background: #0066cc; color: white; border: none; border-radius: 3px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #0052a3; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .alert-success { background: #d4edda; color: #155724; padding: 15px; border-radius: 3px; margin-bottom: 20px; }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; }
        .stat-card h3 { color: #0066cc; font-size: 36px; margin-bottom: 10px; }
        .stat-card p { color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Administration TechSolutions</h1>
        <div>
            <span style="margin-right: 20px;">Connecté: <?= $_SESSION['admin_username'] ?></span>
            <a href="?logout">Déconnexion</a>
        </div>
    </div>
    
    <div class="sidebar">
        <a href="?page=dashboard" class="<?= $page=='dashboard'?'active':'' ?>">📊 Tableau de bord</a>
        <a href="?page=actualites" class="<?= $page=='actualites'?'active':'' ?>">📰 Actualités</a>
        <a href="?page=contacts" class="<?= $page=='contacts'?'active':'' ?>">✉️ Messages</a>
        <a href="../" target="_blank">🌐 Voir le site</a>
    </div>
    
    <div class="content">
        <?php if ($page == 'dashboard'): ?>
            <?php
            $nb_articles = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as nb FROM actualites"))['nb'];
            $nb_contacts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as nb FROM contacts"))['nb'];
            $nb_composants = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as nb FROM composants"))['nb'];
            ?>
            <h2 style="margin-bottom: 30px;">Tableau de bord</h2>
            <div class="stats">
                <div class="stat-card">
                    <h3><?= $nb_articles ?></h3>
                    <p>Actualités publiées</p>
                </div>
                <div class="stat-card">
                    <h3><?= $nb_contacts ?></h3>
                    <p>Messages reçus</p>
                </div>
                <div class="stat-card">
                    <h3><?= $nb_composants ?></h3>
                    <p>Composants en catalogue</p>
                </div>
            </div>
            
            <div class="card">
                <h2>Derniers messages</h2>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Sujet</th>
                    </tr>
                    <?php
                    $messages = mysqli_query($conn, "SELECT * FROM contacts ORDER BY date_envoi DESC LIMIT 5");
                    while ($msg = mysqli_fetch_assoc($messages)):
                    ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($msg['date_envoi'])) ?></td>
                        <td><?= htmlspecialchars($msg['nom']) ?></td>
                        <td><?= htmlspecialchars($msg['email']) ?></td>
                        <td><?= htmlspecialchars($msg['sujet']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        
        <?php elseif ($page == 'actualites'): ?>
            <h2 style="margin-bottom: 30px;">Gestion des actualités</h2>
            
            <div class="card">
                <h2>Ajouter une actualité</h2>
                <?php if (isset($success)): ?>
                    <div class="alert-success"><?= $success ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text" name="titre" required>
                    </div>
                    <div class="form-group">
                        <label>Contenu</label>
                        <textarea name="contenu" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Auteur</label>
                        <input type="text" name="auteur" required>
                    </div>
                    <div class="form-group">
                        <label>Date de publication</label>
                        <input type="date" name="date" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <button type="submit" name="add_article" class="btn">Publier l'actualité</button>
                </form>
            </div>
            
            <div class="card">
                <h2>Actualités publiées</h2>
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $articles = mysqli_query($conn, "SELECT * FROM actualites ORDER BY date_publication DESC");
                    while ($article = mysqli_fetch_assoc($articles)):
                    ?>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($article['date_publication'])) ?></td>
                        <td><?= htmlspecialchars($article['titre']) ?></td>
                        <td><?= htmlspecialchars($article['auteur']) ?></td>
                        <td><a href="?page=actualites&delete_article=<?= $article['id'] ?>" class="btn btn-danger" onclick="return confirm('Supprimer cette actualité ?')">Supprimer</a></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        
        <?php elseif ($page == 'contacts'): ?>
            <h2 style="margin-bottom: 30px;">Messages de contact</h2>
            <div class="card">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Sujet</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $contacts = mysqli_query($conn, "SELECT * FROM contacts ORDER BY date_envoi DESC");
                    while ($contact = mysqli_fetch_assoc($contacts)):
                    ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($contact['date_envoi'])) ?></td>
                        <td><?= htmlspecialchars($contact['nom']) ?></td>
                        <td><?= htmlspecialchars($contact['email']) ?></td>
                        <td><?= htmlspecialchars($contact['sujet']) ?></td>
                        <td><?= htmlspecialchars(substr($contact['message'], 0, 50)) ?>...</td>
                        <td><a href="?page=contacts&delete_contact=<?= $contact['id'] ?>" class="btn btn-danger" onclick="return confirm('Supprimer ce message ?')">Supprimer</a></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>
