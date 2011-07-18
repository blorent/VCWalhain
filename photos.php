<?php
include('functions.php');
include('session.php');
$photoset = '72157603990114606';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Site du Volley Club Walhain</title>
<link rel="stylesheet" media="screen" type="text/css" title="Design" href="style/style.css"  />
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/slimbox2.js"></script>
	<script type="text/javascript" src="scriptaculous/prototype.js"></script>
	<script type="text/javascript" src="scriptaculous/scriptaculous.js"></script>
	<script type="text/javascript" src="scriptaculous/effects.js"></script>
	<link rel="stylesheet" href="style/slimbox2.css" type="text/css" media="screen" />
</head>
<body onload="new Effect.Fade('info',{delay:5,duration:2});">

<div id="topheader"></div>
<div id="container">

<div id="header">
</div>

<? include('menu.php');?>

<!-- Debut Contenu -->
<div id="maincontent">
<?include('log.html');?>

<div id="rightcol">

<? if ($admin==1) { ?>
<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>
	<h1>Admin</h1>
	<ul>
	<li><a href="photos.php" onClick="Effect.divSwap('default','admin_content');return false;">Cacher tout</a></li>
	<li><a href="photos.php" onClick="Effect.divSwap('addalbum','admin_content');return false;">Ajouter album</a></li>
	<li><a href="photos.php" onClick="Effect.divSwap('genthumbs','admin_content');return false;">G&eacute;n&eacute;rer thumbs</a></li>
	</ul> 
	<span class="corners-bottom"><span></span></span></div>
	</div>
<? } ?>
<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>
	<h1>Albums</h1>
	<ul>
<? include("connection.php");
$sql = "SELECT * FROM `PhotoAlbums` ORDER BY `id`";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) {
    echo '<li><a href="photos.php?album='.$data['id'].'">'.$data['name'].'</a></li>';
}
?>
	</ul> 
	<span class="corners-bottom"><span></span></span></div>
	</div>
</div>
<div id="leftcol">
<? if ($admin == 1) {


if(isset($_POST['addAlbum'])){
include("connection.php");
if(empty($_POST['name']) || empty($_POST['name'])) echo '<div id="error"><p>Aucun champ ne peut être laiss&eacute; vide pour ajouter un album.</p></div>';
$sql = "INSERT INTO `PhotoAlbums`(id,name,dir) VALUES('','".$_POST['name']."','".$_POST['dir']."')";
$req = mysql_query($sql) or die('<div id="error">Erreur SQL !<br>'.$sql.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Album '.$_POST['name'].' ajout&eacute;.</p></div>';
}

if(isset($_POST['genThumbs'])) {
$album_id = $_POST['album_id'];
$sql = "SELECT dir FROM `PhotoAlbums` WHERE `id`=".$album_id."";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_assoc($req);

$imagefolder='photoAlbum/'.$data['dir'].'';
$thumbsfolder='photoAlbum/'.$data['dir'].'';
$pics=directory($imagefolder,"jpg,JPG,png,PNG,jpeg,JPG");
$pics=ditchtn($pics,"tn_");
chdir($imagefolder);
if ($pics[0]!="")
{
	foreach ($pics as $p)
	{
		createthumb($p,"tn_".$p,100,100);
	}
}
echo '<div id="info"><p>Miniatures g&eacute;n&eacute;r&eacute;es.</p></div>';
}
?>
<div id="admin_content">

<div id="default"><div></div></div>

<div id="addalbum" style="display:none;"><div><h1>Ajouter un album</h1>
<p><form action="photos.php" method='post'>
	<p>Nom : <input type="text" name="name" maxlength="150" size="50"></p>
	<p>Dossier (dans photoAlbum/) :<input type="text" name="dir" maxlength="150" size="50"></p>
	<p><input type="submit" value="Ajouter" name="addAlbum"></p></form>
	</p>
</div></div>

<div id="genthumbs" style="display:none;"><div><h1>G&eacute;n&eacute;rer les miniatures</h1>
<p>Choisissez l'album pour lequel g&eacute;n&eacute;rer les miniatures.</p>
<p><form action="photos.php" method='post'>
<p><select name="album_id">
<? include("connection.php");
$sql = "SELECT * FROM `PhotoAlbums` ORDER BY `id`";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) {
    echo '<option value="'.$data['id'].'">'.$data['name'].'</option>';
}
?>
</select></p>
	<p><input type="submit" value="G&eacute;n&eacute;rer" name="genThumbs"></p></form>
	</p>
</div></div>

</div>

<? }?>

<?
if($_GET['album']=='') {
echo '<h1>Photos</h1>';
echo '<p>S&eacute;lectionnez un album dans la liste de droite pour afficher ses photos.</p>';
echo '<p>Si vous poss&eacute;dez des photos susceptibles d\'&ecirc;tre incluses &agrave; ces galleries veuillez prendre';
echo ' contact avec un administrateur du site.</p>';
}

else {

echo '<div id="photoAlbum">';

$album_id = $_GET['album'];
$sql = "SELECT name, dir FROM `PhotoAlbums` WHERE `id`=".$album_id."";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_assoc($req);
?>

<h1><? echo $data[name]; ?></h1>
<?php
$imagefolder="photoAlbum/".$data['dir'];
$pics=directory($imagefolder,"jpg,JPG,png,PNG,jpeg,JPG");
$pics=ditchtn($pics,"tn_");
if ($pics[0]!="")
{
	foreach ($pics as $p)
	{
		echo "<a href=\"".$imagefolder."/".$p."\" rel=\"lightbox-".$data['dir']."\" title=\"".$data['name']."\"><img src=\"".$imagefolder."/tn_".$p."\" /></a>\n";
	}
}

echo '</div>';
?>

<?}?>
</div>

</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain <? echo date('Y'); ?></p></div>
</body>
</html>
