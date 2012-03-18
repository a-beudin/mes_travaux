<?php
define('USE_PROXY', true);
define('URL_PROXY', "http://proxy.unicaen.fr:3128");

require("../classes/RecherchePersonnage.php");

$nom = $_GET['nom'];
$serveur = $_GET['serveur'];

$rech= new RecherchePersonnage();

$res = $rech->rechercheParNom($serveur, $nom);
//var_dump($photoset);

echo $res;



?>
