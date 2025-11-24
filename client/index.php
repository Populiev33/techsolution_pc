<?php
session_start();
$conn = mysqli_connect("127.0.0.1", "root", "", "techsolutions");

// Inscription
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $check = mysqli_query($conn, "SELECT * FROM clients WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Cet email est déjà utilisé";
    } else {
        mysqli_query($conn, "INSERT INTO clients (nom, prenom, email, telephone, password) VALUES ('$nom', '$prenom', '$email', '$telephone', '$password')");
        $success = "Compte créé avec succès ! Vous pouvez vous connecter.";
    }
}

// Connexion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    $result = mysqli_query($conn, "SELECT * FROM clients WHERE email = '$email'");
    $client = mysqli_fetch_assoc($result);
    
    if ($client && password_verify($password, $client['password'])) {
        $_SESSION['client_id'] = $client['id'];
        header('Location: index.php');
        exit;
    } else {
        $error = "Email ou mot de passe incorrect";
    }
}

// Déconnexion
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

// Mise à jour des données
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_SESSION['client_id'];
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    
    mysqli_query($conn, "UPDATE clients SET nom='$nom', prenom='$prenom', email='$email', telephone='$telephone' WHERE id=$id");
    $success = "Vos données ont été mises à jour";
}

// Suppression du compte (RGPD)
if (isset($_GET['delete_account'])) {
    $id = $_SESSION['client_id'];
    mysqli_query($conn, "DELETE FROM clients WHERE id=$id");
    session_destroy();
    header('Location: index.php?deleted=1');
    exit;
}

// Si non connecté
if (!isset($_SESSION['client_id'])) {
    $show_form = isset($_GET['form']) ? $_GET['form'] : 'login';
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Espace Client - TechSolutions</title>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: Arial, sans-serif; background: #f5f5f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
            .container { background: white; padding: 40px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
            h1 { color: #1a1a1a; margin-bottom: 30px; text-align: center; }
            .tabs { display: flex; margin-bottom: 30px; border-bottom: 2px solid #ddd; }
            .tab { flex: 1; padding: 15px; text-align: center; cursor: pointer; color: #666; border-bottom: 3px solid transparent; margin-bottom: -2px; }
            .tab.active { color: #0066cc; border-bottom-color: #0066cc; font-weight: 600; }
            .form-group { margin-bottom: 20px; }
            label { display: block; margin-bottom: 8px; color: #333; font-weight: 500; }
            input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 3px; font-size: 14px; }
            button { width: 100%; padding: 12px; background: #28a745; color: white; border: none; border-radius: 3px; font-size: 14px; cursor: pointer; }
            button:hover { background: #218838; }
            .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 3px; margin-bottom: 20px; }
            .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 3px; margin-bottom: 20px; }
            .back { text-align: center; margin-top: 20px; }
            .back a { color: #0066cc; text-decoration: none; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Espace Client</h1>
            
            <?php if (isset($_GET['deleted'])): ?>
                <div class="success">Votre compte a été supprimé conformément au RGPD</div>
            <?php endif; ?>
            
            <div class="tabs">
                <div class="tab <?= $show_form=='login'?'active':'' ?>" onclick="location.href='?form=login'">Connexion</div>
                <div class="tab <?= $show_form=='register'?'active':'' ?>" onclick="location.href='?form=register'">Inscription</div>
            </div>
            
            <?php if ($show_form == 'login'): ?>
                <?php if (isset($error)): ?>
                    <div class="error"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="password" required>
                    </div>
                    <button type="submit" name="login">Se connecter</button>
                </form>
            <?php else: ?>
                <?php if (isset($error)): ?>
                    <div class="error"><?= $error ?></div>
                <?php endif; ?>
                <?php if (isset($success)): ?>
                    <div class="success"><?= $success ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="tel" name="telephone">
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="password" required>
                    </div>
                    <button type="submit" name="register">Créer mon compte</button>
                </form>
            <?php endif; ?>
            
            <div class="back">
                <a href="../">← Retour au site</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    mysqli_close($conn);
    exit;
}

// Interface client connecté
$client = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM clients WHERE id = " . $_SESSION['client_id']));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Compte - TechSolutions</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #28a745; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 20px; }
        .header a { color: white; text-decoration: none; padding: 8px 15px; background: #dc3545; border-radius: 3px; }
        .container { max-width: 800px; margin: 40px auto; padding: 0 20px; }
        .card { background: white; padding: 30px; border-radius: 5px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        .card h2 { color: #1a1a1a; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #333; font-weight: 500; }
        input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 3px; font-size: 14px; }
        .btn { padding: 12px 25px; background: #28a745; color: white; border: none; border-radius: 3px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #218838; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 3px; margin-bottom: 20px; }
        .info-box { background: #e7f3ff; border-left: 4px solid #0066cc; padding: 20px; margin-bottom: 30px; }
        .info-box h3 { color: #0066cc; margin-bottom: 10px; }
        .info-box p { color: #666; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Mon Compte TechSolutions</h1>
        <div>
            <span style="margin-right: 20px;">Bonjour <?= htmlspecialchars($client['prenom']) ?></span>
            <a href="?logout">Déconnexion</a>
        </div>
    </div>
    
    <div class="container">
        <div class="info-box">
            <h3>🔒 Conformité RGPD</h3>
            <p>Conformément au Règlement Général sur la Protection des Données (RGPD), vous avez le droit de consulter, modifier et supprimer vos données personnelles à tout moment. Vos données sont stockées de manière sécurisée et ne sont jamais partagées avec des tiers.</p>
        </div>
        
        <?php if (isset($success)): ?>
            <div class="success"><?= $success ?></div>
        <?php endif; ?>
        
        <div class="card">
            <h2>Mes informations personnelles</h2>
            <form method="POST">
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="nom" value="<?= htmlspecialchars($client['nom']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" name="prenom" value="<?= htmlspecialchars($client['prenom']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="tel" name="telephone" value="<?= htmlspecialchars($client['telephone']) ?>">
                </div>
                <button type="submit" name="update" class="btn">Mettre à jour mes données</button>
            </form>
        </div>
        
        <div class="card">
            <h2>Informations du compte</h2>
            <p style="color: #666; margin-bottom: 10px;"><strong>Date d'inscription :</strong> <?= date('d/m/Y', strtotime($client['date_inscription'])) ?></p>
            <p style="color: #666;"><strong>Identifiant :</strong> #<?= $client['id'] ?></p>
        </div>
        
        <div class="card">
            <h2>⚠️ Zone dangereuse</h2>
            <p style="color: #666; margin-bottom: 20px;">La suppression de votre compte est définitive et irréversible. Toutes vos données seront supprimées conformément au RGPD.</p>
            <a href="?delete_account" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement votre compte ? Cette action est irréversible.')">Supprimer mon compte</a>
        </div>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="../" style="color: #0066cc; text-decoration: none;">← Retour au site</a>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>
