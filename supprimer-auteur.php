<!-- afficher-auteur.php -->
<!DOCTYPE html>
<html>

<head>
  <title>Supprimer un Auteur</title>
  <link rel="icon" href="anime-and-manga-svgrepo-com.svg" type="image/svg+xml">
  <style>
    h2 {
      text-align: center;
      padding-top: 150px;
    }

    body {
      background-color: burlywood;
    }

    .login-box {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 400px;
      padding: 40px;
      transform: translate(-50%, -50%);
      background: rgba(24, 20, 20, 0.987);
      box-sizing: border-box;
      box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
      border-radius: 10px;
    }

    .login-box .user-box {
      position: relative;
    }

    .login-box .user-box input {
      width: 100%;
      padding: 10px 0;
      font-size: 16px;
      color: #fff;
      margin-bottom: 30px;
      border: none;
      border-bottom: 1px solid #fff;
      outline: none;
      background: transparent;
    }

    .login-box .user-box label {
      position: absolute;
      top: 0;
      left: 0;
      padding: 10px 0;
      font-size: 16px;
      color: #fff;
      pointer-events: none;
      transition: .5s;
    }

    .login-box .user-box input:focus~label,
    .login-box .user-box input:valid~label {
      top: -20px;
      left: 0;
      color: #bdb8b8;
      font-size: 12px;
    }

    .tkt {
      --color: #560bad;
      font-family: inherit;
      display: inline-block;
      width: 8em;
      height: 2.6em;
      line-height: 2.5em;
      margin: 20px;
      position: relative;
      overflow: hidden;
      border: 2px solid var(--color);
      transition: color .5s;
      z-index: 1;
      font-size: 17px;
      border-radius: 6px;
      font-weight: 500;
      color: var(--color);
    }

    .tkt:hover {
      color: purple;
      background-color: Aqua;
    }
  </style>
</head>

<body>

  <h2>Supprimer un Auteur</h2>



<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('database.php');

$id_auteur = isset($_GET['id_auteur']);

if (isset($id_auteur)) {
 

  try {
    // Requête SQL pour récupérer les détails de l'auteur
    $requete = "SELECT id_auteur, nom_auteur, prenom_auteur FROM auteur WHERE id_auteur = :id_auteur";
    // Préparation de la requête
    $stmt = $connexion->prepare($requete);
    // Liaison des paramètres
    $stmt->bindParam(':id_auteur', $_GET['id_auteur'], PDO::PARAM_INT);
    // Exécution de la requête préparée
    $stmt->execute();

    // Récupération des résultats
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo "<h2>Voulez-vous vraiment supprimer l'auteur : \"" . $row['nom_auteur'] . " " . $row['prenom_auteur'] . "\" ?</h2>";
        echo "<form method='post' action='confirmer-suppression-auteur.php'>";
        echo "<input type='hidden' name='id_auteur' value='" . $row['id_auteur'] . "'>";
        echo "<input type='checkbox' name='confirmation' required> Oui, je suis sûr de vouloir supprimer cet auteur<br>";
        echo "<input type='submit' value='Supprimer'>";
        echo "</form>";
    } else {
        echo "Auteur non trouvé.";
    }
  } catch (PDOException $erreur) {
    die("Erreur lors de la récupération des données : " . $erreur->getMessage());
  }
} else {
  echo "Paramètres manquants ou non confirmés.";
}
?>
</body>
</html>
