<?php

Class Flickr {

    private $ApiKey;
    private $rest = "";
    private $options = array();

    /**
     * constructeur
     */    
    public function __construct() {
      /* clé de développement */
      $this->ApiKey = "d708902f66e4e5ccc4fb8567b8765450";

      /* URL du service */
      $this->rest = "http://api.flickr.com/services/rest/?";

      /* options diverses de requête */
      /* cf. doc http://www.flickr.com/services/api/flickr.photos.search.html */
      $this->options['content_type'] = 1;
      $this->options['sort'] = "relevance";
      /* on ne prendra que les images avec licence CC by-nc-sa :
       * voir http://creativecommons.org/licenses/by-nc-sa/2.0/
       */
      $this->options['license'] = 1;
    }
    
    
    private function getApiKey() {
      return $this->ApiKey;
    }
    


    /**
     * effectue une recherche avec une liste de mots clés
     * @param la liste des mots clés
     * @param le nombre de résultats voulus, optionnel (10 par défaut)
     *
     * @return le code XHTML à utiliser pour afficher les vignettes carrées
     */
    public function rechercheParTags($tagliste, $nb=10) {
      /* construire l'URL */
      $url = $this->rest . "api_key=" . $this->getApiKey() . "&method=flickr.photos.search&tags=" . urlencode($tagliste) . "&sort=" . $this->options['sort'] . "&license=" . $this->options['license'] . "&per_page=" . $nb;

      /* utilisation de CURL, avec proxy si besoin */
      $curl = curl_init();
      if (USE_PROXY) {
	curl_setopt($curl, CURLOPT_PROXY, URL_PROXY);
      }
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $data = curl_exec($curl);     


      /* parser la réponse XML avec simpleXML */      
      $sx = simplexml_load_string($data);

      /* obtenir tous les éléments <photo> */
      $tab = $sx->xpath("//photo");

      $photoset = "<div>";

      /* pour chaque photo, créer son affichage */      
      foreach ($tab as $photo)  {
	$values = $photo->attributes();
	/**
	 * le tableau $values a les données :
	 * $values = array(
	 * 	"farm" =>  $att,
	 *	"server" => ,
	 *	"id" => ,
	 *	"secret" => 
	 *	);
	 */
	$photoset .= "<div class=\"photo\"><img src=\"{$this->imgSrc($values, "_s")}\" alt=\"{$values['title']}\"  /><br/><a href=\"\">Sélectionner</a></div>\n";
      }

      $photoset .= "</div>\n";

      /* Créer le bouton pour fermer la zone de sélection */ 
      $photoset .= "<h3 style=\"clear: both\"><a href=\"\" id=\"finirSelection\" >Terminer la sélection et revenir au formulaire</h3>";

      return $photoset;      
    }


    /**
     * fabrique l'URL d'une image en fonction des infos données en paramètres 
     * cf doc API Flickr : http://www.flickr.com/services/api/misc.urls.html
     */
    private function imgSrc($values, $size="") {
      $r="";
      $r = "http://farm{$values['farm']}.static.flickr.com/{$values['server']}/{$values['id']}_{$values['secret']}{$size}.jpg";
      return $r;
    }

} // fin de la classe Flickr

?>