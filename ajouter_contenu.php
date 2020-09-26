<?php
session_start();
?>

<!DOCTYPE HTML>  
<html>
    <head>
        <title>Formulaire</title>
    </head>
    <body>

        <h2> Formulaire d'ajout de contenu au blog </h2>
        <form action="insertion_contenu.php" method="post" enctype="multipart/form-data">
            <div>
                <label>Titre : </label>
                <input type="text" name="titre">
            </div>
            <br/>
            <div>
                <label>Commentaire : </label>
                <br/>
                <textarea name="commentaire" rows="5" cols="50"></textarea>
            </div>
            <br/>
            <div>
                <label>Choisissez une photo avec une taille inférieure à 2 Mo : </label>
                <br/>
                <br/>
                <input type="file" name="image" id="image"/>
            </div>
            <br/>
            <br/>
            <button type="submit">Envoyer</button>
            <br/>
            <br/>
            <a href='affichage_blog.php'>page d'affichage du blog</a>
            <br/>
            
            <?php
            if (isset($_GET["message"]) && $_GET["message"] == "1"){
                echo "<span style='color:#ff0000'>Les champs titre et commentaire doivent être remplis.</span><br/>";
            }

            if (isset($_GET["message"]) && $_GET["message"] == "2"){
                echo "<span style='color:#ff0000'>Seuls les formats JPG et PNG sont autorisés.</span><br/>";
            }

            if (isset($_GET["message"]) && $_GET["message"] == "3"){
                echo "<span style='color:#ff0000'>La taille de l'image est supérieure à 2 Mo.</span><br/>";
            }
            ?>

        </form>
    </body>
</html>