<?php

class BlogPost {

    private $id;
    private $titre;
    private $date_creation;
    private $commentaire;
    private $chemin_img;

    // Constructeur
    
    function __construct($titre, $commentaire, $chemin_img){
        $this->titre = $titre;
        $this->commentaire = $commentaire;
        $this->chemin_img = $chemin_img;
    }

    // Getters et setters

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTitre(){
        return $this->titre;
    }

    public function setTitre($titre){
        $this->titre = $titre;
    }

    public function getDateCreation(){
        return $this->date_creation;
    }

    public function setDateCreation($date_creation){
        $this->date_creation = $date_creation;
    }

    public function getCommentaire(){
        return $this->commentaire;
    }

    public function setCommentaire($commentaire){
        $this->commentaire = $commentaire;
    }

    public function getCheminImg(){
        return $this->chemin_img;
    }

    public function setCheminImg($chemin_img){
        $this->chemin_img = $chemin_img;
    }

}


    /* Méthode pour sauvegarder un post
    * @param1 : titre de l'article saisi dans le formulaire
    * @param2 : commentaire saisi dans le formulaire
    * @param3 : emplacement de l'image sur le serveur
    */

    /*
    public function save($titre, $com, $target_file){

        try {
    
            // Connexion à la base
            $base = new PDO("mysql:host=127.0.0.1;port=3308;dbname=blog", "root", "");
        
            // Récupération d'erreurs
            $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
            // Définition du fuseau horaire (pour récupération ultérieure de la date)
            date_default_timezone_set("Europe/Paris");

            // Requête pour entrer en base les données saisies par l'utilisateur
            $sql = "INSERT INTO article(titre, date_creation, commentaire, chemin_img)
            VALUES(:titre, :date_creation, :commentaire, :chemin_img)";

            // Préparation puis exécution de la requête
            $resultat = $base->prepare($sql);
            if ($resultat->execute(array("titre" => $titre,
            // Récupération de la date et de l'heure courante sur un format identique à celui utilisé en base
            "date_creation" => date("Y/m/d h:i:s"),
            "commentaire" => $com,
            // Récupération du chemin vers l'emplacement de stockage de l'image
            "chemin_img" => $target_file))){
                echo "Aucune erreur dans le transfert des données. <br/>";
            } else {
                echo "Erreur dans l'enregistrement des données en base. <br/>";
            }

        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        
        // Déconnexion
        } finally {
            $base = null; 
        }
    }

}
*/

?>