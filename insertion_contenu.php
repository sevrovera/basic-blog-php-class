<?php

include('Connexion.class.php');
include('BlogManager.class.php');
include('BlogPost.class.php');

try {
    
    // Connexion à la base
    $base = Connexion::createPDOConnexion();

    // Instanciation de la classe BlogManager 
    $manager = new BlogManager($base);

    // Vérification du remplissage des champs titre et commentaire
    if ($_POST["titre"] != null && $_POST["commentaire"] != null){

        echo "Ajout du titre et du commentaire réussi. <br/>";
        
        // Si l'image a une taille < 2 Mo, on entre dans le "if"
        if (is_uploaded_file($_FILES['image']['tmp_name'])){
            $name=$_FILES["image"]["name"];
            $size=$_FILES["image"]["size"];
            $temp=$_FILES["image"]["tmp_name"];
            // $type=$_FILES["image"]["type"];
            // $error=$_FILES["image"]["error"];
            
            // On créé le dossier "uploads" pour stocker les images (s'il n'existe pas déjà)
            if (!file_exists('photos/')) {
                mkdir('photos', 0777, true);
            }

            // On construit le chemin vers l'emplacement de stockage des images
            $target_dir = "photos/";
            $target_file = $target_dir . basename($name);

            // Variable indiquant si un problème est rencontré pendant l'upload
            $uploadStatus = 1;

            // Vérification de l'extension du fichier ajouté
            $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if($extension != "jpg" && $extension != "png" && $extension != "jpeg") {
                $uploadStatus = 2;
            }

            // Vérification de la taille de l'image (en cas de paramétrage différent du mien dans votre php.ini)
            if ($size > 2000000) {
                $uploadStatus = 3;
            }

            // Enregistrement de l'image sur le serveur
            if ($uploadStatus == 1) {
                move_uploaded_file($temp, $target_file);
                echo "Le fichier ". basename( $name). " a été copié dans le répertoire photos. <br/>";
            
            // Si l'image n'a pas la bonne extension, on ne l'enregistre pas et on affiche un message d'erreur sous le formulaire
            } else if ($uploadStatus == 2){
                header("location:ajouter_contenu.php?message=2");
            
            // Si l'image est trop lourde, on ne l'enregistre pas et on affiche un message d'erreur sous le formulaire
            } else if ($uploadStatus == 3){
                header("location:ajouter_contenu.php?message=3");
            }

            // Instanciation de la classe BlogPost
            $post = new BlogPost($_POST['titre'], $_POST['commentaire'], $target_file);

            // Sauvegarde du nouveau post
            $manager->add($post);
            echo "Création du nouveau post en base OK. <br/>";


        // Affichage d'un message d'erreur sous le formulaire en cas d'image trop lourde
        // Par défaut chez moi, upload_max_filesize dans php.ini est configuré pour n'autoriser que les uploads de moins de 2 Mo
        // Du coup, si l'image est trop lourde, on ne rentre pas dans le "if" ci-dessus 
        } else {
            header("location:ajouter_contenu.php?message=3");
        }

        // Lien pour retourner au formulaire
        echo "<a href='ajouter_contenu.php'>retour à la page d'insertion</a>";

    // Si le titre ou le commentaire n'est pas renseigné, on renvoie au formulaire en affichant un message d'erreur en dessous
    } else {
        header("location:ajouter_contenu.php?message=1");
    }

} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());

// Déconnexion
} finally {
    $base = null; 
}

    
?>