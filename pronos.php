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

<? include('menu.php');?>

<!-- Debut Contenu -->
<div id="maincontent">
<?include('log.html');?>

<div id="onecolum">
<img src="images/icons/constr1.jpg" style="float:right;" />
<p style="font-size:1.2em; margin-top : 40px; padding-left : 40px;padding-right : 40px;">Les pronos seront disponibles sur ce site d&egrave;s la saison 2008-2009 pour tous les membres inscrits sur le forum.<padding-left : 40px;padding-right : 40px;/p>
<p style="font-size:1.2em; padding-left : 40px;padding-right : 40px;">En attendant, rendez-vous sur le <a href="http://www.video-volley.org/pronoforum/">forum de Mike</a>.</p>
<p style="font-size:1.2em;padding-left : 40px;padding-right : 40px; margin-bottom : 200px;">Bons pronostics.</p>

</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
