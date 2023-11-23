<?php
require_once('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_livres"]) && isset($_POST["confirmation"])) {
    $id_livres = $_POST["id_livres"];

    try {
        // Requête SQL pour supprimer le manga
        $requete = "DELETE FROM livres WHERE id_livres = :id_livres";
        // Préparation de la requête
        $stmt = $connexion->prepare($requete);
        // Liaison des paramètres
        $stmt->bindParam(':id_livres', $id_livres, PDO::PARAM_INT);
        // Exécution de la requête préparée
        $resultat = $stmt->execute();

        if ($resultat !== false) {
            echo "Le manga a été supprimé avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la suppression du manga.";
        }
    } catch (PDOException $erreur) {
        die("Erreur lors de la suppression du manga : " . $erreur->getMessage());
    }

    // Redirection vers la page afficher-manga.php
    header("Location: afficher-manga.php");
    exit();
} else {
    echo "Paramètres manquants ou non confirmés.";
}
?>
