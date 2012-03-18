<?xml version="1.0" encoding="utf-8" ?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<title>Mes d&eacute;licieux bookmarks</title>
<link rel="stylesheet" type="text/css"  href="../ui/css/base.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../ui/css/screen.css" />
<link rel="stylesheet" type="text/css" media="print" href="../ui/css/print.css" />
</head>
<body>

<!-- header -->
<div id="header">Mes d&eacute;licieux bookmarks</div>

<!-- outerWrapper -->
<div id="outerWrapper">

<!-- innerWrapper -->
<div id="innerWrapper">

<!-- content -->
<div id="content">
<h1><?php echo $titre; ?></h1>
<?php echo $c; ?>
<!-- clearer -->
<div class="clearer">&nbsp;</div>
</div>
<!-- fin content -->

<!-- leftMenu -->
<div id="leftMenu" class="menu">
  <a href="../public/index.php">Accueil</a>
  <a href="../public/index.php?a=ajouter">Nouveau bookmark</a>
</div>
<!-- fin leftMenu -->

<!-- clearer -->
<div class="clearer">&nbsp;</div>
</div> 
<!-- fin innerWrapper -->


<!-- rightMenu -->
<div id="rightMenu" class="menu">
<?php echo $menuDroit;
?>
</div>
<!-- fin rightMenu -->

<!-- clearer -->
<div class="clearer">&nbsp;</div>
</div> 
<!-- fin outerWrapper -->

<!-- footer -->
<div id="footer">Architecture pr&eacute;sent&eacutee dans le cadre du <a href="http://www.info.unicaen.fr/DNR2I/">Master professionnel DNR-2i</a><br />
&copy; <a href="mailto:valerie@info.unicaen.fr">Valerie Cauchard</a></div> 
<!-- fin footer -->
</body>
</html>
