<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Auteur</title>
    <link rel="icon" href="anime-and-manga-svgrepo-com.svg" type="image/svg+xml">
    <style>
         /* form{
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            flex-direction: column;
            align-items: flex-start;
        } */
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

.login-box form a {
  position: relative;
  display: inline-block;
  padding: 10px 20px;
  color: #ffffff;
  font-size: 16px;
  text-decoration: none;
  text-transform: uppercase;
  overflow: hidden;
  transition: .5s;
  margin-top: 40px;
  letter-spacing: 4px
}

.login-box a:hover {
  background: #03f40f;
  color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 5px #03f40f,
              0 0 25px #03f40f,
              0 0 50px #03f40f,
              0 0 100px #03f40f;
}

.login-box a span {
  position: absolute;
  display: block;
}

@keyframes btn-anim1 {
  0% {
    left: -100%;
  }

  50%,100% {
    left: 100%;
  }
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
    <a href="#">
    <input class="tkt" type="submit" value="Ajouter">
       <span></span>
    </a></center>
  </form>
</div>