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
<body onload="new Effect.Fade('info',{delay:5,duration:2});">

<div id="topheader"></div>
<div id="container">

<div id="header">
<div id="slogan"><img src="images/slogan.png" /></div>
</div>

<? include('menu.php'); 
?>

<!-- Debut Contenu -->
<div id="maincontent">
<?
include('log.html');
?>

<div id="onecolumn">

<?if($admin==0) echo '<div class="centered"><p>Vous n\'avez pas le droit d\'acc&eacute;der &agrave; cette page.</p></div>';
else {

echo '<h1>Editer une news</h1>';
include("connection.php");

$sql = "SELECT texte FROM `news` WHERE `id`='".$_POST['id']."'";
$req = mysql_query($sql) or die('<div id="alert">Erreur SQL !<br>'.$sql.'<br>'.mysql_error().'</div>');
$data = mysql_fetch_assoc($req);
?>
<form method="post" action="index.php"> <textarea name="message" rows=5 cols=60><?echo $data['texte'];?></textarea><p><input type="submit" value="Editer" name="editnews"><input type="hidden" name="id" value="<?echo $_POST['id'];?>"><input type=reset value=effacer> </form></p>


<?}?>
</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
