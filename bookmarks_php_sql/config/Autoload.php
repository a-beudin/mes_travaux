<?php

  /**
   * fonction autoload pour charger les classes automatiquement.
   * Les fichiers PHP de classes sont dans le répertoire LIB_FILE
   *
   * Schéma de nommage des classes :
   * classe Toto => fichier Toto/Toto.php
   * classe Toto_Titi => fichier Toto/Toto_Titi.php
   */


function __autoload($className) {
  /**
   * extraire le répertoire à partir du nom de la classe
   */
  $tclass = explode('_', $className);
  $repertoire = $tclass[0];
  
  $file = LIB_FILE . $repertoire . "/{$className}.php";
  
  if (is_file($file)) {
    require_once($file);
  } else {
    throw new Exception("Erreur Autoload : le fichier {$file} n'existe pas");
  }
} // fin de l'autoload

?>