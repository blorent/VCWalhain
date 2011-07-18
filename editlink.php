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
<li><a href="liens.php" id="liens" class="current_liens"></a></li>
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

<div id="onecolumn">

<?if($admin==0) echo '<div class="centered"><p>Vous n\'avez pas le droit d\'acc&eacute;der &agrave; cette page.</p></div>';
else {

echo '<h1>Editer un lien</h1>';
include("connection.php");
if($_POST['attente']=='non'){
$sql = "SELECT * FROM `liens` WHERE `id`='".$_POST['id']."'";
$req = mysql_query($sql) or die('<div id="alert">Erreur SQL !<br>'.$sql.'<br>'.mysql_error().'</div>');
$data = mysql_fetch_assoc($req);
if($data['subcat'] == 0) $sum = $data['categorie']; else $sum = 1000*$data['categorie'] + $data['subcat'];
?>
<p><form action="liens.php" method='post'>
	<input type="hidden" name="id" value="<?echo $data['id'];?>">
	<p>Nom : <input type="text" name="nom" maxlength="100" size="50" value="<?echo $data['nom'];?>"></p>
	<p>Description : <input type="text" name="description" maxlength="200" size="50" value="<?echo $data['description'];?>"></p>
	<p>Adresse compl&egrave;te : <input type="text" name="url" maxlength="250" size="50" value="<?echo $data['url'];?>"></p>
	<p>Cat&eacute;gorie : <select name="categorie">
	<?
	include("connection.php");
	$sqlb = "SELECT * FROM `liens_categories`";
	$reqb = mysql_query($sqlb) or die('Erreur SQL !<br>'.$sqbl.'<br>'.mysql_error());
	while($datab = mysql_fetch_assoc($reqb)) {
			if ($datab['id'] == $sum) echo '<option value="'.$datab['id'].'" selected>'.$datab['cat'].'</option>';
			else echo '<option value="'.$datab['id'].'">'.$datab['cat'].'</option>';
				if ( $datab['num_subcats'] != 0 ){
				$sqlc = "SELECT * FROM `liens_subcat` WHERE `parent_id`=".$datab['id']."";
				$reqc = mysql_query($sqlc) or die('Erreur SQL !<br>'.$sqlc.'<br>'.mysql_error());
				while($datac = mysql_fetch_assoc($reqc)) {
					$value = (1000*$datab['id']) + $datac['id'];
					if (1000*$datab['id'] + $datac['id'] == $sum) echo '<option value="'.$value.'" selected>'.$datab['cat'].' > '.$datac['subcat'].'</option>';
					else echo '<option value="'.$value.'">'.$datab['cat'].' > '.$datac['subcat'].'</option>';
				}
				}
	}
	?>
	</select></p>
	<p><input type="submit" value="Ok" name="editlink"></p>
	</form>
	</p>

<?} else {
$sql = "SELECT * FROM `liens_attente` WHERE `id`='".$_POST['id']."'";
$req = mysql_query($sql) or die('<div id="alert">Erreur SQL !<br>'.$sql.'<br>'.mysql_error().'</div>');
$data = mysql_fetch_assoc($req);
?>
<p>En poussant sur Ok la proposition sera effac&eacute;e et les donn&eacute;es modifi&eacute;es ici seront enregistr&eacute;es dans les "vrais" liens.</p>
<p><form action="liens.php" method='post'>
	<input type="hidden" name="id" value="<?echo $data['id'];?>">
	<p>Nom : <input type="text" name="nom" maxlength="100" size="50" value="<?echo $data['nom'];?>"></p>
	<p>Description : <input type="text" name="description" maxlength="200" size="50" value="<?echo $data['desc'];?>"></p>
	<p>Adresse compl&egrave;te : <input type="text" name="url" maxlength="250" size="50" value="<?echo $data['url'];?>"></p>
	<p>Cat&eacute;gorie : <select name="categorie">
	<?
	include("connection.php");
	$sqlb = "SELECT * FROM `liens_categories`";
	$reqb = mysql_query($sqlb) or die('Erreur SQL !<br>'.$sqbl.'<br>'.mysql_error());
	while($datab = mysql_fetch_assoc($reqb)) {
		if($datab['id']==$data['categorie']) echo '<option value="'.$datab['id'].'" selected>'.$datab['cat'].'</option>';
                else echo '<option value="'.$datab['id'].'">'.$datab['nom'].'</option>';
	}
	?>
	</select></p>
	<p><input type="submit" value="Ok" name="transfer"></p>
	</form>
	</p>

<?}}?>
</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
