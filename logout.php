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
<body onload="new Effect.Appear('slogan',{delay:2, duration:3.5});">

<div id="topheader"></div>
<div id="container">

<div id="header">
<div id="slogan" style="display:none;"><img src="images/slogan.png" /></div>
</div>

<? include('menu.php'); 
?>

<!-- Debut Contenu -->
<div id="maincontent">
<div id="onecolumn">
<h1>Log out</h1>
<?php
if($connected==0) {
	echo '<div class="centered"><p>Vous n\'&ecirc;tes pas connect&eacute;</p><p>Cliquez <a href="index.php">ici</a> pour revenir &agrave; la page d\'accueil.</p></div>';
	exit;
	}
	
	else { ?>   

		<?php    
		session_unset();
		session_destroy();
        ?>
	<div class="centered">
	<p>D&eacute;connection effectu&eacute;e.</p>
	<p>Cliquez <a href="index.php" alt="Accueil">ici</a> pour revenir &agrave; la page d'index.</p>
	</div>
	<? } ?>
</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
