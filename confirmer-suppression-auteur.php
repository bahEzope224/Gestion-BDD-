<?php
require_once('database.php');

echo var_dump($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_auteur"]) && isset($_POST["confirmation"])) {
    $id_auteur = $_POST["id_auteur"];

    try {
        // Requête SQL pour supprimer l'auteur
        $requete = "DELETE FROM auteur WHERE id_auteur = :id_auteur";
        // Préparation de la requête
        $stmt = $connexion->prepare($requete);
        // Liaison des paramètres
        $stmt->bindParam(':id_auteur', $id_auteur, PDO::PARAM_INT);
        // Exécution de la requête préparée
        $resultat = $stmt->execute();

        if ($resultat !== false) {
            echo "L'auteur a été supprimé avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la suppression de l'auteur.";
        }
    } catch (PDOException $erreur) {
        die("Erreur lors de la suppression de l'auteur : " . $erreur->getMessage());
    }

    // Redirection vers la page afficher-auteur.php
    header("Location: affiche-auteur.php");
    exit();
} else {
    echo "Paramètres manquants ou non confirmés.";
}
?>
