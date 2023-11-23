<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Auteur</title>
    <link rel="icon" href="anime-and-manga-svgrepo-com.svg" type="image/svg+xml">
    <style>

body{
  background-color: burlywood;
}
   
h2{
  text-align: center;
  padding-top: 150px;
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
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
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

.login-box .user-box input:focus ~ label,
.login-box .user-box input:valid ~ label {
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

<h2>Ajouter un Auteur</h2>

<?php
error_reporting(E_ALL); ini_set("display_errors", 1); 
session_start();
require_once('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_auteur = $_POST["nom_auteur"];
    $prenom_auteur = $_POST["prenom_auteur"];

    try {
        // Vérification si l'auteur existe déjà
        $check_table= "SELECT COUNT(*) FROM auteur WHERE nom_auteur = '$nom_auteur' AND prenom_auteur = '$prenom_auteur'";
        $resultat_verification = $connexion->query($check_table);
        $count = $resultat_verification->fetchColumn();

        if ($count == 0) {
            // L'auteur n'existe pas, on peut l'ajouter
            $requete = "INSERT INTO auteur (nom_auteur, prenom_auteur) VALUES ('$nom_auteur', '$prenom_auteur')";
            $resultat = $connexion->exec($requete);

            if ($resultat !== false) {
                echo "<p style>L'auteur a été ajouté avec succès.</p>";
            } else {
                echo "Une erreur s'est produite lors de l'ajout de l'auteur.";
            }
        } else { 
            echo "<p>Cet auteur existe déjà.</p>";
        }

    } catch (PDOException $erreur) {
        die("Erreur lors de l'ajout de l'auteur : " . $erreur->getMessage());
    }
    if(isset($_SESSION['username'])) {
        // Supprime toutes les variables de session
        session_unset();
        
    }
}
?>



<div class="login-box">
 
  <form  method="post" action="">
    <div class="user-box">
      <input type="text" name="nom_auteur" required="">
      <label>Nom de l'auteur:</label>
    </div>
    <div class="user-box">
      <input type="text" name="prenom_auteur" required="">
      <label>Prénom de l'auteur:</label>
    </div><center>
    
    <input class="tkt" type="submit" value="Ajouter">
       <span></span>
    </center>
  </form>
</div>
  
</body>
</html>
