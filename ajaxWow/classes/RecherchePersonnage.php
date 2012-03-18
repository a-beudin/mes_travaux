<?php

// exemple : http://eu.battle.net/api/wow/character/chants-eternels/lumendril

Class RecherchePersonnage {

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
      $this->rest = "http://eu.battle.net/api/wow/character/";
      $this->options['license'] = 1;
    }
    
    
    private function getApiKey() {
      return $this->ApiKey;
    }
    

	public function rechercheParNom($serveur, $nom) {
		$url = $this->rest.$serveur."/".$nom."?locale=fr_FR&fields=guild,items,progression";
		$curl = curl_init();
		if(USE_PROXY) {
			curl_setopt($curl, CURLOPT_PROXY, URL_PROXY);
		}
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($curl); 

		return $data;
	}

} // fin de la classe Flickr

?>
