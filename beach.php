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
</div>

<? include('menu.php'); 
?>

<!-- Debut Contenu -->
<div id="maincontent">
<?include('log.html');?>

<div id="onecolumn">
<h1>Beach</h1>
<p>Le VC Walhain met, pendant toute la saison d'&eacute;t&eacute;, deux terrains de beach-volley &agrave; la disposition de ses membres.</p>
<p>Des manches du championnat provincial namurois ainsi que du championnat pro B y sont organis&eacute;es chaque ann&eacute;e, ainsi que de nombreux tournois non officiels.</p>

	<h1>Photos</h1>
<p>Vous pouvez retrouver les photos du Volley Club Walhain dans la section photos (y'a moyen de deviner...).</p>
</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
