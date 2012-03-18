<?php


class Bookmark_Ui {

 /* Données membres de la classe */
  protected $bookmark;

 /* Fonctions membres de la classe */


  /* Constructeur   */

  public function __construct(Bookmark $bookmark) {
    $this->bookmark = $bookmark;

  }


  /* Méthode afficher : afficher le bookmark avec les liens modifier/supprimer */
  public function makeHtml($CSSclass="") {
 	$htmlCode = "<div class=\"bookmark\">
		<a href=\"{$this->bookmark->getUrl()}\">
			{$this->bookmark->getNomSite()}
		</a>		
		<br />
		<span>
			{$this->bookmark->getDescription()}<br />
			{$this->bookmark->getDateIns()}<br />
		
		<a href=\"../public/index.php?a=modifier&amp;id={$this->bookmark->getId()}\">Modifier</a>
		<a href=\"../public/index.php?a=supprimer&amp;id={$this->bookmark->getId()}\">Supprimer</a>
		</span>
	</div>";

	return $htmlCode;
  }

}
?>
