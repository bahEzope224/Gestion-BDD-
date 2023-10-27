<!DOCTYPE html>
<html>
<head>
    <title>Liste des Auteurs</title>
    <link rel="icon" href="anime-and-manga-svgrepo-com.svg" type="image/svg+xml">
    <style>
        body {
            background-color: burlywood;
            text-align: center;
        }

        table {
            margin: auto;
            background-color: black;
            color: white;
            border-collapse: collapse;
            width: 80%;
        }

        table, th, td {
            border: 1px solid white;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: rgba(24, 20, 20, 0.987);
        }

        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Liste des Auteurs</h2>

<?php
error_reporting(E_ALL); ini_set("display_errors", 1); 

require_once('database.php');
try {
    // Requête SQL pour récupérer les champs de la table 'auteurs'
    $requete = "SELECT id_auteur, nom_auteur, prenom_auteur FROM auteur";
    // Exécution de la requête SQL
    $resultat = $connexion->query($requete);
    // Vérification de la réussite de la requête
    if ($resultat) {
        // Affichage du début du tableau
        echo "<table border='1'>
                <tr>
                    <th>ID de l'auteur</th>
                    <th>Nom de l'auteur</th>
                    <th>Prenom de l'auteur</th>
                    <th>Actions</th>
                    <th>Actions</th>

                </tr>";
        // Boucle pour afficher les données
        while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . $row['id_auteur'] . "</td>
                    <td>" . $row['nom_auteur'] . "</td>
                    <td>" . $row['prenom_auteur'] . "</td>
                    <td><a href='modifier-auteur.php?id=" . $row['id_auteur'] . "'>Modifier</a></td>
                    <td><a href='supprimer-auteur.php?id=" . $row['id_auteur'] . "'>Supprimer</a></td>
                  </tr> ";
        }
        // Affichage de la fin du tableau
        echo "</table>";
    } else {
        echo "La requête a échoué.";
    }
    // Fermer le curseur 
    $resultat->closeCursor();
    // Fermer la connexion à la base de données
    $connexion = null;
} catch (PDOException $erreur) {
    die("Erreur lors de la récupération des données : " .
        $erreur->getMessage());
}
?>

</body>
</html>
