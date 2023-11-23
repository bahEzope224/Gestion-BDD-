<!DOCTYPE html>
<html>

<head>
  <title>Modifier un Auteur</title>
  <link rel="icon" href="anime-and-manga-svgrepo-com.svg" type="image/svg+xml">
</head>
<style>
  h2 {
    text-align: center;
    padding-top: 120px;
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


  .login-box a span:nth-child(1) {
    bottom: 2px;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #03f40f);
    animation: btn-anim1 2s linear infinite;
  }
</style>
</head>

<body>

  <h2>Modifier un Auteur</h2>

  <?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  require_once('database.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_auteur = $_POST["id_auteur"];
    $nom_auteur = $_POST["nom_auteur"];
    $prenom_auteur = $_POST["prenom_auteur"];

    try {
      // Requête SQL pour mettre à jour les informations de l'auteur
      $requete = "UPDATE auteur SET nom_auteur = '$nom_auteur', prenom_auteur = '$prenom_auteur' WHERE id_auteur = $id_auteur";
      // Exécution de la requête SQL
      $resultat = $connexion->exec($requete);

      if ($resultat !== false) {
        echo "Les informations de l'auteur ont été mises à jour avec succès.";
      } else {
        echo "Une erreur s'est produite lors de la mise à jour des informations de l'auteur.";
      }
    } catch (PDOException $erreur) {
      die("Erreur lors de la mise à jour des informations de l'auteur : " . $erreur->getMessage());
    }
  } else {
    // header("Location: modifier-auteur.php");
  
  }
  ?>
  <div class="login-box">

    <form method="post" action="">
      <div class="user-box">
        <input type="text" name="id_auteur" required="">
        <label>ID Auteur:</label>
      </div>
      <div class="user-box">
        <input type="text" name="nom_auteur" required="">
        <label>Nouveau nom de l'auteur:</label>
      </div>
      <div class="user-box">
        <input type="text" name="prenom_auteur" required="">
        <label>Nouveau prenom de l'auteur:</label>
      </div>
      <center>

        <input class="tkt" type="submit" value="Modifier">
        <span></span>
      </center>
    </form>
</body>

</html>
