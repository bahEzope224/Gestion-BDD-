<!DOCTYPE html>
<html>
<head>
    <title>Modifier un Manga</title>
    <link rel="icon" href="anime-and-manga-svgrepo-com.svg" type="image/svg+xml">

    
<style>
            h2{
            text-align: center;
            padding-top: 150px;
        }
body{
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

<h2>Modifier un Manga</h2>

<?php
error_reporting(E_ALL); ini_set("display_errors", 1); 
require_once('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_manga = $_POST["id_manga"];
    $titre_manga = $_POST["nom_livres"]; 

    try {
        // Requête SQL pour mettre à jour les informations du manga
        $requete = "UPDATE livres SET nom_livres = '$titre_manga' WHERE id_livres = $id_manga";
        // Exécution de la requête SQL
        $resultat = $connexion->exec($requete);

        if ($resultat !== false) {
            echo "Les informations du manga ont été mises à jour avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la mise à jour des informations du manga.";
        }
    } catch (PDOException $erreur) {
        die("Erreur lors de la mise à jour des informations du manga : " . $erreur->getMessage());
    }
} else {
    // Si la requête n'est pas de type POST, cela signifie que l'utilisateur a accédé à cette page sans passer par le formulaire.
    // Vous pouvez ajouter ici un message d'erreur ou rediriger l'utilisateur vers la page appropriée.
}
?>

<!-- <form method="post" action="">
    ID du manga: <input type="text" name="id_manga"><br>
    Nouveau titre du manga: <input type="text" name="nom_livres"><br>
    <input type="submit" value="Modifier">
</form> -->



<div class="login-box">
 
  <form  method="post" action="">
    <div class="user-box">
      <input type="text" name="id_manga" required="">
      <label>ID Manga:</label>
    </div>
    <div class="user-box">
      <input type="text" name="nom_livres" required="">
      <label>Nouveau titre du manga:</label>
    </div><center>
    <a href="#">
    <input class="tkt" type="submit" value="Ajouter">
       <span></span>
    </a></center>
  </form>
</div>

</body>
</html>
