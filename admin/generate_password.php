<?php
// Générer un mot de passe hashé
$password = 'admin123'; // Changez ce mot de passe
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Mot de passe : $password\n";
echo "Hash : $hash\n\n";
echo "Requête SQL :\n";
echo "INSERT INTO admins (username, password) VALUES ('admin', '$hash');\n";
?>
