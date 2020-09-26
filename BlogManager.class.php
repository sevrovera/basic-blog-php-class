<?php

class BlogManager {

  // Attribut contenant l'instance représentant la base.

  private $base;

  // Constructeur

  public function __construct(PDO $base){
    $this->base = $base;
  }

  // Méthode permettant d'ajouter un post.

  public function add(BlogPost $post){

    // Définition du fuseau horaire (pour récupération ultérieure de la date)
    date_default_timezone_set("Europe/Paris");
    
    // Requête d'insertion d'un nouvel article
    $sql = 'INSERT INTO article(titre, date_creation, commentaire, chemin_img) VALUES(:titre, NOW(), :commentaire, :chemin_img)';

    // Préparation et exécution de la requête
    $requete = $this->base->prepare($sql);
    $requete->bindValue(':titre', $post->getTitre());
    $requete->bindValue(':commentaire', $post->getCommentaire());
    $requete->bindValue(':chemin_img', $post->getCheminImg());
    $requete->execute();

  }

  // Méthode retournant l'ensemble des posts.

  public function showAll(){

    // Requête de sélection de tous les articles en base
    $sql = 'SELECT * FROM article ORDER BY date_creation DESC';
    $requete = $this->base->query($sql);

    // Tableau contenant les arguments du constructeur de la classe BlogPost
    $ctorargs = ['titre', 'commentaire', 'chemin_img'];

    // On indique que le résultat de la requête contiendra des objets de la classe BlogPost
    // et qu'on exécutera le constructeur avant que PDO n'assigne les propriétés de l'objet
    $requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'BlogPost', $ctorargs);
    
    // Variable contenant l'ensemble des posts
    $listePosts = $requete->fetchAll();
    
    $requete->closeCursor();
    
    return $listePosts;

  }
  
    
}

?>