<?php


class Bookmark_Form {
 

 /* Données membres de la classe */
  protected $bookmark;
  protected $erreurs; // tableau contenant les erreurs du formulaire 

 /* Fonctions membres de la classe */

  /* Constructeur   */
  public function __construct($bookmark) {
	/* initialisation du tableau des erreurs */
	$this->erreurs = array(
		'nomSite' => "",
		'url' => ""
		);	

	/* initialisation du bookmark */
	$this->bookmark = $bookmark;
  }


  public function makeForm($actionUrl,$invite) {
	$nomSite = Outils_Chaines::quotes2entity($this->bookmark->getNomSite());
    	$url = Outils_Chaines::quotes2entity($this->bookmark->getUrl());
    	$description = $this->bookmark->getDescription();
    	$id = $this->bookmark->getId();

	$text = <<<EOT
<form action="{$actionUrl}" method="post" >

<div>{$this->erreurs['nomSite']}</div>
<div><span>Nom du site :</span>
     <span><input type="text" name="nomSite" value="{$nomSite}" /></span>
</div>

<div>{$this->erreurs['url']}</div>
<div><span>Adresse :</span>
     <span><input type="text" name="url" value="{$url}" /></span>
</div>

<div><span>Description :</span>
     <span><textarea name="description" cols="30" rows="3">
             {$description}</textarea></span>
</div>

<div class="submit">
     <input type="hidden" name="id" value="{$id}" />
     <input type="submit" name="go" value="{$invite}" />
</div>
</form>
EOT;
	return $text; 
  }

   /* vérification du formulaire : les champs site, url et description
   * sont obligatoires
   * la méthode renvoie un booléen, on pourrait imaginer le faire avec 
   * une exception mais ce n'est pas mieux
   */
  public function verifier() {
  	$flag = true;
	
	/* Le nom est-il vide ? */
	if(trim($this->bookmark->getNomSite()) == "") {
		$this->erreurs['nomSite'] = "Nom du site manquant.";
		$flag = false;
	}
	/* url est-il vide ? */
 	 if (trim($this->bookmark->getUrl()) == "") {
    		$this->erreurs['url'] = "Adresse du site manquante.";
    		$flag = false;
  	}
	else {
		/* url commence-t-il par http:// */
		$formatUrl="/^http:\/\//";
		if (preg_match($formatUrl,$this->bookmark->getUrl()) !=1) {
       			$this->erreurs['url'] = "L'adresse du site doit commencer par http://";
       			$flag = false;
    		}
	}
	return $flag;
   }
}
?>
