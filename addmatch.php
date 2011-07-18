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
<body onload="new Effect.Fade('info',{delay:5,duration:2})">

<div id="topheader"></div>
<div id="container">

<div id="header">
</div>

<? include('menu.php');?>

<!-- Debut Contenu -->
<div id="maincontent">
<?
include('log.html');
?>
<div id="onecolumn">
<?if($admin!=1) { ?>
<div class="center"><p>Vous n'avez pas le droit d'acc&eacute;der &agrave; cette page.  Cliquez <a href="index.php">ici</a>
pour revenir &agrave; la page d'accueil.</p></div>
<?
}
else { ?>
<h1>Ajouter des matches en <?= $_POST['division'] ?></h1>
<form method="post" action="equipes.php">
<input type="hidden" value="<?= $_POST['nombreMatches'] ?>" name="numMatches" />

<table cellspacing="5" cellpadding="3" width="100%">
<?
for ($i=1; $i<$_POST['nombreMatches']+1; $i++) {
	echo '<input type="hidden" value="'.$_POST['division'].'" name="div'.$i.'" />';
	echo '<tr>';
	echo '<td>'.$i.')</td>';
	echo '<td><label for="jour'.$i.'">Date :</label>';
	echo '<select name="jour'.$i.'">';
		for($j=1; $j < 32; $j++) {
			echo '<option value='.$j.'>'.$j.'</option>';
		}
		echo '</select>';
		echo '<select name="mois'.$i.'">';
		for($j=1; $j < 13; $j++) {
			echo '<option value='.$j.'>'.$j.'</option>';
		}	
	echo '</select>';
	echo '<select name="annee'.$i.'">';
		for($j= date('Y'); $j < date('Y')+3; $j++) {
	        echo '<option value='.$j.'>'.$j.'</option>';
		}
	echo '</select></td>';
	echo '<td><label for="local'.$i.'">Local &nbsp; :</local><input type="text" size="35" maxlength="60" name="local'.$i.'" /></td></tr><tr>';
	echo '<td></td><td><label for="hour'.$i.'">Heure :</label><input type="text" size="2" maxlength="2" name="hour'.$i.'" />
	h<input type="text" size="2" maxlength="2" name="min'.$i.'" /></td>';
	echo '<td><label for="visiteur'.$i.'">Visiteur :</label><input type="text" size="35" maxlength="60" name="visiteur'.$i.'" /></td>';
	echo '</tr><tr><td>&nbsp;</td></tr>';
}
echo '<tr><td></td></tr><tr><td colspan="3" align="center"><input type="submit" name="addManyMatch" value="Go"/></td></tr>';
echo '</table></form>';

} ?>
</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
