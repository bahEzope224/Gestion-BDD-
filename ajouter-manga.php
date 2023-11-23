<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un Manga</title>
    <link rel="icon" href="anime-and-manga-svgrepo-com.svg" type="image/svg+xml">
</head>
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

<body>
    <h2>Ajouter un Manga</h2>

    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ini_set("display_errors", 1);

    require_once('database.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titre_manga = $_POST["nom_livres"];
        $nom_auteur = $_POST["nom_auteur"];

        try {
            // Vérification si le manga existe déjà
            $verification_requete = "SELECT COUNT(*) FROM livres WHERE nom_livres = '$titre_manga'";
            $resultat_verification = $connexion->query($verification_requete);
            $count = $resultat_verification->fetchColumn();

            if ($count == 0) {
                // Le manga n'existe pas, on peut l'ajouter
                $requete = "INSERT INTO livres (nom_livres, id_auteur) VALUES ('$titre_manga', (SELECT id_auteur FROM auteur WHERE nom_auteur = '$nom_auteur'))";
                $resultat = $connexion->exec($requete);

                if ($resultat !== false) {
                    echo "Le manga a été ajouté avec succès.";
                } else {
                    echo "Une erreur s'est produite lors de l'ajout du manga.";
                }
            } else {
                echo "Ce manga existe déjà.";
            }
        } catch (PDOException $erreur) {
            die("Erreur lors de l'ajout du manga : " . $erreur->getMessage());
        }
    }
    ?>

    <div class="login-box">
        <form method="post" action="">
            <div class="user-box">
                <input type="text" name="nom_livres" required="">
                <label>Nom du livre:</label>
            </div>

            <div class="user-box">
                <!-- Utilisation d'une liste déroulante pour les noms des auteurs -->
                <select name="nom_auteur" required="">
                    <?php
                    // Récupération des noms d'auteurs depuis la base de données
                    $auteurs_requete = "SELECT nom_auteur  FROM auteur";
                    $resultat_auteurs = $connexion->query($auteurs_requete);

                    // Affichage des noms d'auteurs dans la liste déroulante
                    while ($row = $resultat_auteurs->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['nom_auteur'] . "'>" . $row['nom_auteur'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <center>
                <input class="tkt" type="submit" value="Ajouter">
                <!-- <span></span> -->
            </center>
        </form>
    </div>
</body>

</html>
