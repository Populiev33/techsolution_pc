<?php
$conn = mysqli_connect("127.0.0.1", "root", "", "techsolutions");
if (!$conn) die("Erreur : " . mysqli_connect_error());

// Vider la table et insérer un nouveau compte
mysqli_query($conn, "DELETE FROM admins");
$password = password_hash('admin123', PASSWORD_DEFAULT);
mysqli_query($conn, "INSERT INTO admins (username, password) VALUES ('admin', '$password')");

echo "Compte admin créé avec succès !<br>";
echo "Identifiant : admin<br>";
echo "Mot de passe : admin123<br><br>";
echo "<a href='index.php'>Aller à la page de connexion</a>";
mysqli_close($conn);
?>
