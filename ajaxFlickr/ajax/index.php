<?php
define('USE_PROXY', true);
define('URL_PROXY', "http://proxy.unicaen.fr:3128");

require("../classes/Flickr.php");

$listeMots = $_GET['mots'];


$tagliste=explode(' ', $listeMots);
$lesTags= "";
foreach ($tagliste as $tag) {
  if (strlen($tag) > 2) {
    $lesTags .= $tag . ",";
  }
}


$lesTags = substr($lesTags,0, -1);


// requete des images flickr

$flickr= new Flickr();

$photoset = $flickr->rechercheParTags($lesTags, 30);
//var_dump($photoset);

echo $photoset;



?>