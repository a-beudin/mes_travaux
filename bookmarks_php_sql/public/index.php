<?php 
require_once("../config/config.php");

$data = is_array($_POST) ? $_POST : array();

$action = isset($_GET['a']) ? $_GET['a'] : "";

// initialisation des variables
$titre="";
$c="";
$menuDroit = file_get_contents("../ui/fragments/menuDroitDefaut.frg.html");
$squelette = "../ui/pages/bookmarks.html.php";


  /* contrôleur : 
   * indique que faire en fonction de l'action demandée 
   * par l'utilisateur
   */
switch($action) {
  
/* ajouter un nouveau bookmark */
 case "ajouter" : 
    $titre = "Ajouter un nouveau bookmark";   
    $book = Bookmark::initialize();
    $form = new Bookmark_Form($book);
    $c = $form->makeForm(PUBLIC_URL."index.php?a=enregistrernouveau", "Ajouter");
    break;

/* modifier un bookmark */
 case "modifier" : 
   $titre = "Modifier un bookmark";
   /* on vérifie que l'URL nous a bien transmis l'identifiant */
   if (isset($_GET['id'])) {
	$id = $_GET['id'];
	/* créer un bookmark à partir des infos de la BD */
     	$book = Bookmark_Bd::lire($id);
	/* afficher le formulaire */
     	$form = new Bookmark_Form($book);
     	$c = $form->makeForm(PUBLIC_URL."index.php?a=enregistrermodif", "Modifier");
   }
   else {
	$c = "Identifiant du bookmark manquant pour la modification.";
   }
   break;
   
 case "enregistrernouveau":
   /* encoder les données */
   Outils_Chaines::htmlEncodeArray($data);
   /* créer un bookmark à partir des infos du formulaire */
   $book = Bookmark::initialize($data);

   /* instancier un formulaire pour vérifier */
   $form = new Bookmark_Form($book);
   /* vérifier les données */   
   if ($form->verifier()) {
	Bookmark_Bd::enregistrerNouveau($book);   	
	$titre = "Site enregistr&eacute;";
	/* afficher le bookmark saisi */
     	$ui = new Bookmark_Ui($book);
     	$c = $ui->makeHtml();
   }
   else {
	/* bookmark non valide alors afficher le formulaire (cf. cas ajouter) */
	$titre = "Erreurs dans les données entrées.";
	$c = $form->makeForm(PUBLIC_URL . "index.php?a=enregistrernouveau", "Ajouter");
   }
   break;

 case "enregistrermodif":

   Outils_Chaines::htmlEncodeArray($data);
   $book = Bookmark_Bd::lire($data['id']);
   $book->update($data);
   $form = new Bookmark_Form($book);

   if ($form->verifier()) {
	$titre = "Site enregistr&eacute;";
	Bookmark_Bd::enregistrerModif($book);
	$ui = new Bookmark_Ui($book);
     	$c = $ui->makeHtml("pair");
   }
   else {
	$titre = "Erreurs dans les données entrées.";
	$c = $form->makeForm(PUBLIC_URL . "index.php?a=enregistrermodif", "modifier");
   }
   break;

 case "supprimer":
   if (isset($_GET['id'])) {
	$titre = "Site supprim&eacute;";
	$c = Bookmark_Bd::supprimer($_GET['id']);
   } 
   else {
   	$titre = "Pas d'identifiant - suppression impossible";
   }
   break;
 

   // cas default => page d'accueil : afficher tous les bookmarks de la BD
 default :
	$i=0;
	$style = array("pair", "impair");
	$titre = "Mes bookmarks";
	$tableau = Bookmark_Bd::lireDixDerniers();
   	foreach ($tableau as $book) {
    		/* Afficher le bookmark */
       		$ui = new Bookmark_Ui($book);
       		$c .= $ui->makeHtml($style[$i++%2]);
    	}
}

ob_start();
  require_once($squelette);
  $html = ob_get_contents();
ob_end_clean();
echo $html;
?>
