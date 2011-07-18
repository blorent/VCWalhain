<?php
include('session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Site du Volley Club Walhain</title>
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

<!-- Debut Menu -->
<div id="cache" style="display:none;">
<img src="style/images/menu/accueil_hover.gif" />
<img src="style/images/menu/equipes_hover.gif" />
<img src="style/images/menu/pronos_hover.gif" />
<img src="style/images/menu/beach_hover.gif" />
<img src="style/images/menu/liens_hover.gif" />
<img src="style/images/menu/photos_hover.gif" />
<img src="style/images/menu/contact_hover.gif" />
<img src="style/images/menu/forum_hover.gif" />
</div>

<div id="menu">
<ul>
<li><a href="index.php" id="index"></a></li>
<li><a href="equipes.php" id="equipes"></a></li>
<li><a href="pronos.php" id="pronos"></a></li>
<li><a href="beach.php" id="beach"></a></li>
<li><a href="liens.php" id="liens"></a></li>
<li><a href="photos.php" id="photos"></a></li>
<li><a href="contact.php" id="contact"></a></li>
<li><a href="../forum/index.php" id="forum"></a></li>
</ul>

<fieldset>
<form method="get" action="/search/">
<p><input name="q" id="q" type="text" size="4" value="" /></p>
</form>
</fieldset>

</div>
<!-- Fin Menu -->

<!-- Debut Contenu -->
<div id="maincontent">
<?
include('log.html');
?>

<div id="rightcol">
<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>
	<h1>Le reste de l'&eacute;quipe</h1>
	<ul>
	<?
	include('connection.php');
	$sqla = "SELECT equipe FROM `membres` WHERE id=".$_GET['id']."";
	$reqa = mysql_query($sqla) or die('<div id="error">Erreur SQL !<br>'.$sqla.'<br>'.mysql_error().'</div>');
	$dat = mysql_fetch_assoc($reqa);
	$sql = "SELECT * FROM `membres` WHERE equipe='".$dat['equipe']."'";
	$req = mysql_query($sql) or die('<div id="error">Erreur SQL !<br>'.$sql.'<br>'.mysql_error().'</div>');
	while($data = mysql_fetch_assoc($req)) {
                echo '<li><a href="membre.php?id='.$data['id'].'">'.$data['prenom'].' '.$data['nom'].'</a></li>';
	}
	?>
	</ul> 
	<span class="corners-bottom"><span></span></span></div>
	</div>
</div>
<div id="leftcol">
<?php	

include("connection.php");

$sql = "SELECT *,DATE_FORMAT(naissance, '%d-%m-%Y') as datefr FROM `membres` WHERE `id`='".$_GET['id']."'";

        $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

$res = mysql_num_rows($req);

$data = mysql_fetch_assoc($req);

		
	if ($res==0) {
		echo '<div class="centered">Pas de fiche personnelle trouv&eacute;e</div>';
		}
		
	else {

		echo '<h1>'.$data['prenom'].' '. $data['nom'].'</h1>'; 
	echo '<div id="fiche" style="height : 400px;">';
		if($data['photo']==1) {echo '<img src="photos/'.$data['id'].'.jpg" alt="'.$data['nom'].'" />';}
		else {
		echo '<img src="photos/null.jpg" alt="No photo" />';
		}
	
echo '<p>Nom : '.$data['nom'].'</p><p>Pr&eacute;nom : '.$data['prenom'].'</p>';
if($data['surnom']!='NC'){echo '<p>Surnom : '.$data['surnom'].'</p>';}
if($data['datefr']!='00-00-0000' && $data['datefr']!='01-01-1950'){echo '<p>Date de naissance : '.$data['datefr'].'</p>';}
if($data['equipe']!='NC'){echo '<p>Equipe : '.$data['equipe'].'</p>';}
if($data['poste']!='NC'){echo '<p>Poste : '.$data['poste'].'</p>';}
if($data['numero']!=0){echo '<p>Num&eacute;ro : '.$data['numero'].'</p>';}
if($data['arrivee']!=0){echo '<p>Ann&eacute;es dans le club : '.$data['arrivee'].'</p>';}
if($data['taille']!=0){echo '<p>Taille : '.$data['taille'].'</p>';}
if($data['profession']!='NC'){echo '<p>Profession : '.$data['profession'].'</p>';}
if($data['hobbies']!='NC'){echo '<p>Hobbies : '.$data['hobbies'].'</p>';}
		
		}

	mysql_close();
		?> 
</div>
</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
