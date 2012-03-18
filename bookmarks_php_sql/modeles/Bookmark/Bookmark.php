<?php


class Bookmark {

 /* Données membres de la classe */
  private $id;
  private $nomSite;
  private $url;
  private $description;
  private $dateIns;


 /* Fonctions membres de la classe */

  /* Constructeur : initialiser à partir d'un tableau $map construit les méthodes appropriées)
   */
  protected function __construct($map) {
    /* affectation des valeurs contenues dans le $map */
	$this->id = $map['id'];
	$this->nomSite = $map['nomSite'];
	$this->url = $map['url'];
    $this->description = $map['description'];
    $this->dateIns = $map['dateIns'];
  }

  /* initialisation de l'objet avec les valeurs passées en paramètre ou les valeurs par défaut */
  public static function initialize($data = array()) {
    $map = array();
    // remplir le tableau $map avec les "bonnes" infos
	
	/* id présent dans $data on non ? */
    if (isset($data['id'])) {
      $map['id'] = $data['id'];
    } else {
      /* créer un identifiant */
      $map['id'] = md5(microtime());
    }

    /* titre présent dans $data ? */
    if (isset($data['nomSite'])) {
      $map['nomSite'] = $data['nomSite'];
    } else {
      $map['nomSite'] = "";
    }

    /* url présent dans $data ? */
    if (isset($data['url'])) {
      $map['url'] = $data['url'];
    } else {
      $map['url'] = "";
    }

    /* description présent dans $data ? */
    if (isset($data['description'])) {
      $map['description'] = $data['description'];
    } else {
      $map['description'] = "";
    }

    /* dateIns présent dans $data ? */
    if (isset($data['dateIns'])) {
      $map['dateIns'] = $data['dateIns'];
    } else {
      /* créer une date */
      $map['dateIns'] = date('Y-m-d H:i:s');
    }

    /*retourner une instance de Bookmark*/  
    return new self($map);
  }

 
  /**
   * Retourne le code d'identification du bookmark
   */
  public function getId() { return $this->id; }


  /**
   * Retourne le nom du site
   */
  public function getNomSite() { return $this->nomSite; }


  /**
   * Retourne l'url
   */
  public function getUrl() { return $this->url; }


  /**
   * Retourne la description
   */
  public function getDescription() { return $this->description; }


  /**
   * Retourne la date de création
   */

  public function getDateIns() { return $this->dateIns; }




  /**
   * Modifie le code d'identification du bookmark
   */
  public function setId($id) { 
    $this->id = $id; 
  }


  /**
   * Modifie le nom du site
   */
  public function setNomSite($nomSite) { 
    $this->nomSite = $nomSite;
  }


  /**
   * Modifie l'url
   */
  public function setUrl($url) { 
    $this->url = $url; 
  }


  /**
   * Modifie la description du bookmark
   */
  public function setDescription($description) { 
    $this->description = $description;
  }


  /**
   * Modifie la date 
   */
  public function setDateIns($dateIns) { 
    $this->dateIns = $dateIns; 
  }

  public function update($data) {
    /* titre présent dans $data ? */
    if (isset($data['nomSite'])) {
      $this->setNomSite($data['nomSite']);
    }

    /* url présent dans $data ? */
    if (isset($data['url'])) {
      $this->setUrl($data['url']);
    } 

    /* description présent dans $data ? */
    if (isset($data['description'])) {
      $this->setDescription($data['description']);
    } 
  } 

}
?>
