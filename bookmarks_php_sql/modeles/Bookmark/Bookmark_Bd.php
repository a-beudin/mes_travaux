<?php


class Bookmark_Bd {

  /* Fonctions membres de la classe */

  /* Initialisation d'un bookmark à partir d'un code bookmark : on va chercher les données dans la BD pour afficher un bookmark ou pour le modifier */ 
  public static function lire($id) { 
	$db = Outils_Bd::getInstance()->getConnexion();
  	$sth=$db->prepare("SELECT * FROM tp_bookmarks WHERE id=:id");
	$data=array('id' => $id);
	$sth->execute($data);
	$ligne = $sth->fetch(PDO::FETCH_ASSOC);

	return Bookmark::initialize($ligne);
  }

  public static function lireDixDerniers() {
	$i = 0;
   	/* construire de la requête */
   	$req = "select * from tp_bookmarks order by dateIns DESC LIMIT 0,10";
   	$db = Outils_Bd::getInstance()->getConnexion();
  	$res = $db->query($req);
   	$tableau = $res->fetchAll(PDO::FETCH_ASSOC);
	$tableau_books = array();
   	/* Traiter les résultats de la requête */
   	/* Pour chaque ligne de résultat */
   	foreach ($tableau as $line) {
       		$book = Bookmark::initialize($line);
		$tableau_books[] = $book;
    	}
	return $tableau_books;
  }
  

  public static function enregistrerNouveau($bookmark) { 
  	$bookmark->setDateIns(date("Y-m-d H:i:s"));
	
	/* prendre la connexion BD */
    	$db = Outils_Bd::getInstance()->getConnexion();
    	/* préparer la requête */
    	$sth=$db->prepare("INSERT INTO tp_bookmarks SET id=:id,nomSite=:nomSite, url=:url, description=:description, dateIns=:dateIns");

	/* préparer  les données */
    	$data=array(
    	'id' => $bookmark->getId(),
    	'nomSite' => $bookmark->getNomSite(),
    	'url' => $bookmark->getUrl(),
    	'description' => $bookmark->getDescription(),
    	'dateIns' => $bookmark->getDateIns()
    	);

	/* executer la requete */
    	$sth->execute($data);
  }


  public static function enregistrerModif($bookmark) { 
	/* prendre la connexion BD */
    	$db = Outils_Bd::getInstance()->getConnexion();
    	/* préparer la requête */
    	$sth=$db->prepare("UPDATE tp_bookmarks SET nomSite=:nomSite, url=:url, description=:description WHERE id=:id");

	/* préparer  les données */
    	$data=array(
	'id' => $bookmark->getId(),
    	'nomSite' => $bookmark->getNomSite(),
    	'url' => $bookmark->getUrl(),
    	'description' => $bookmark->getDescription()
    	);

	/* executer la requete */
    	$sth->execute($data);
  }


  /* Méthode supprimer : faire la requête DELETE en BD 
   * même principe que précédement pour les exceptions
  */
  public static function supprimer($id) {
	$db = Outils_Bd::getInstance()->getConnexion();
	$sth = $db->prepare("delete from tp_bookmarks where id=:id");
	$data = array('id' => $id);
	$sth->execute($data);
  }
}
?>
