<?php
$servername = "localhost"; // Adresse du serveur MySQL
$username = "root"; // Nom d'utilisateur MySQL (root)
$password = "root"; // Mot de passe MySQL (PC : vide / Mac : root)
$dbname = "mangaworldo"; // Nom de la base de données
try {
    $connexion = new PDO(
    "mysql:host=$servername;dbname=$dbname",
    $username,
    $password
);

// echo "ok je suis connecté";
// Définir le mode d'erreur PDO à exception
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
} ?>

