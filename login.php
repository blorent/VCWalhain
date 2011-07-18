<?php
include('session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Site du Volley Club Walhain</title>
		<script type="text/javascript" src="scriptaculous/prototype.js"></script>
	   	<script type="text/javascript" src="scriptaculous/scriptaculous.js"></script>
	   	<script type="text/javascript" src="scriptaculous/effects.js"></script>
       <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=iso-8859-1" />
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="style/style.css"  />  

<link rel="SHORTCUT ICON" href="mikasa.gif" type="image/gif" />
</head>
<body>

<div id="topheader"></div>
<div id="container">

<div id="header">
<div id="slogan"><img src="images/slogan.png" /></div>
</div>

<? include('menu.php'); 
?>

<!-- Debut Contenu -->
<div id="maincontent">
<? include('log.html');?>
<div id="onecolumn">
<h1>Log in</h1>
<div class="centered">
<p>Utilisez ici votre login du forum.  Cliquez <a href="../forum/index.php">ici</a> si vous n'en avez pas encore un.  Pour pouvoir acc&eacute;der &agrave; l'&eacute;dition de vos informations personnelles veuillez demander l'acc&egrave;s &agrave; un administrateur du forum (<a href="mailto:ber@vcwalhain.be">Ber</a> ou <a href="mike@vcwalhain.be">Mike</a>).</p>
<p></p>
</div>
<? include('login.html'); ?>
</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
