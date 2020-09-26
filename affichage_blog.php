<?php

include('Connexion.class.php');
include('BlogManager.class.php');
include('BlogPost.class.php');

echo "<h1 style='text-align:center'> Blog </h1><hr>";
    
try {
    
    // Connexion à la base
    $base = Connexion::createPDOConnexion();

    // Instanciation de la classe BlogManager 
    $manager = new BlogManager($base);

    // Affichage des articles, du plus récent au plus ancien
    foreach ($manager->showAll() as $post){
      // Centrage des articles sur la page
      echo "<div style='text-align:center;padding:20px'>";
      // Affichage du titre
      echo "<h4>" . $post->getTitre() . "</h4>";
      // Affichage de la date de création de l'article
      echo "<h4> Le " . $post->getDateCreation() . "</h4>";
      // Affichage du commentaire
      echo "<p>" . $post->getCommentaire() . "</p>";
      // Affichage de l'image avec un format fixe
      echo "<img src='". $post->getCheminImg() . "' width='300' height='200'>";
      echo "</div><hr/>";

    }
    // Lien pour retourner au formulaire
    echo "<hr>";
    echo "<a href='ajouter_contenu.php'>retour à la page d'insertion</a>";

} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
} finally{
    $base = null;
}

?>
