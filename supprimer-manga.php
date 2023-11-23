
<!DOCTYPE html>
<html>

<head>
  <title>suppression</title>
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

  <?php
  require_once('database.php');

  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_livres"])) {
    $id_livres = $_GET["id_livres"];

    try {
      // Requête SQL pour récupérer les détails du manga
      $requete = "SELECT nom_livres, nom_auteur, prenom_auteur FROM livres INNER JOIN auteur ON livres.id_auteur = auteur.id_auteur WHERE id_livres = :id_livres";
      // Préparation de la requête
      $stmt = $connexion->prepare($requete);
      // Liaison des paramètres
      $stmt->bindParam(':id_livres', $id_livres, PDO::PARAM_INT);
      // Exécution de la requête préparée
      $stmt->execute();

      // Récupération des résultats
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($row) {
        echo "<h2>Voulez-vous vraiment supprimer le manga \"" . $row['nom_livres'] . "\" de l'auteur \"" . $row['nom_auteur'] . " " . $row['prenom_auteur'] . "\" ?</h2>";
        echo "<form method='post'action='confirmer-suppression-manga.php'>
                    <input type='hidden' name='id_livres' value='" . $id_livres . "'>
                    <input type='checkbox' name='confirmation' required> Oui, je suis sûr de vouloir supprimer ce manga<br>
                    <input type='submit' value='Confirmer la suppression'>
                  </form>";
      } else {
        echo "Manga non trouvé.";
      }
    } catch (PDOException $erreur) {
      die("Erreur lors de la récupération des données : " . $erreur->getMessage());
    }
  } else {
    echo "Paramètre manquant.";
  }
  ?>

</body>

</html>
