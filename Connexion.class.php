<?php

class Connexion {
  
  public static function createPDOConnexion() {
    
    // Connexion à la base
    $base = new PDO("mysql:host=127.0.0.1;port=3308;dbname=blog", "root", "");

    // Récupération d'erreurs
    $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    return $base;

  }

}