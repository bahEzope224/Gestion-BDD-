<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manga Worldo</title>
    <link rel="icon" href="anime-and-manga-svgrepo-com.svg" type="image/svg+xml">

    <style>
body {
            font-family: Arial, sans-serif;
            background-color: burlywood;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .button-group {
            display: flex;
            gap: 20px;
        }

        .button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: rgba(24, 20, 20, 0.987);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #03f40f;
        }    </style>
</head>
<body>

<h2>Bienvenue dans la Gestion de Livres</h2>

<div class="button-container">
    <div class="button-group">
        <button class="button" onclick="window.location.href='affiche-auteur.php'" onmouseover="hoverButton(this)" onmouseout="unhoverButton(this)">Afficher les auteurs</button>
        <button class="button" onclick="window.location.href='afficher-manga.php'" onmouseover="hoverButton(this)" onmouseout="unhoverButton(this)">Afficher les mangas</button>
    </div>
    <div class="button-group">
        <button class="button" onclick="window.location.href='ajouter-auteur.php'" onmouseover="hoverButton(this)" onmouseout="unhoverButton(this)">Ajouter un Auteur</button>
        <button class="button" onclick="window.location.href='ajouter-manga.php'" onmouseover="hoverButton(this)" onmouseout="unhoverButton(this)">Ajouter un Manga</button>
    </div>
</div>

<script>
    function hoverButton(button) {
        button.style.backgroundColor = "#03f40f";
    }

    function unhoverButton(button) {
        button.style.backgroundColor = "rgba(24, 20, 20, 0.987)";
    }
</script>

</body>
</html>
