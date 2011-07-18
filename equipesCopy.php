<?php
include('session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Site du Volley Club Walhain</title>
       <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=iso-8859-1" />
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="style/style.css"  />  
		<script type="text/javascript" src="scriptaculous/prototype.js"></script>
	   	<script type="text/javascript" src="scriptaculous/scriptaculous.js"></script>
	   	<script type="text/javascript" src="scriptaculous/effects.js"></script>
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


<div id="rightcol">
<? if ($admin==1) { ?>
<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>
	<h1>Admin</h1>
	<ul>
	<li><a href="equipes.php" onClick="Effect.divSwap('default','admin_content');return false;">Cacher tout</a></li>
	<li><a href="equipes.php" onClick="Effect.divSwap('addteam','admin_content');return false;">Ajouter une &eacute;quipe</a></li>
	<li><a href="equipes.php" onClick="Effect.divSwap('delteam','admin_content');return false;">Supprimer une &eacute;quipe</a></li>
	<li><a href="equipes.php" onClick="Effect.divSwap('adduser','admin_content');return false;">Ajouter un membre</a></li>
	<li><a href="equipes.php" onClick="Effect.divSwap('deluser','admin_content');return false;">Supprimer un membre</a></li>
	<li><a href="equipes.php" onClick="Effect.divSwap('edituser','admin_content');return false;">Editer un membre</a></li>
	<li><a href="equipes.php" onClick="Effect.divSwap('perm','admin_content');return false;">Editer les permissions</a></li>
	<li><a href="equipes.php" onClick="Effect.divSwap('orphans','admin_content');return false;">G&eacute;rer les orphelins</a></li>
	<li><a href="equipes.php" onClick="Effect.divSwap('addmatches','admin_content');return false;">Ajouter des matches</a></li>
	<li><a href="equipes.php" onClick="Effect.divSwap('addmatchesfromfile','admin_content');return false;">Copier/coller matches</a></li>
	</ul> 
	<span class="corners-bottom"><span></span></span></div>
	</div>
<? } ?>
	
	<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>
	<h1>Equipes</h1>
	<ul>
<?
include('connection.php');
$sql = "SELECT division, nom_complet FROM `equipes` WHERE `afficher`=1 ORDER BY `importance` ASC";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) {
	echo '<li><a href="equipes.php?eq='.$data['division'].'">'.$data['nom_complet'].'</a></li>';
}
?>

	</ul>
	<span class="corners-bottom"><span></span></span></div>
	</div>
<?if($admin==0){?>
<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>
			<div id="dujour">
			<?
			$re = mysql_query('SELECT MAX(id) as max from membres');          // 3
			$data = mysql_fetch_assoc($re);
			$idx = rand(1,$data['max']);

			$sql = "SELECT * FROM `membres` WHERE `id`='".$idx."' AND `nom`!=''";
			$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
			$num_rows = mysql_num_rows($req);

			while($num_rows != 1){
				$idx = rand(1,$data['max']);
				$sql = "SELECT * FROM `membres` WHERE `id`='".$idx."' AND `nom`!=''";
				$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
				$num_rows = mysql_num_rows($req);
			}

			$data = mysql_fetch_assoc($req);

			if($data['nom']=='') {}
			else {

			if($data['photo']==1){
				echo '<h1>Membre au hasard</h1><p><a href="membre.php?id='.$idx.'"><img src="photos/'.$idx.'.jpg" alt="photo membre" /></a></p>';
			}
			else {
				echo '<h1>Membre au hasard</h1><p><a href="membre.php?id='.$idx.'"><img src="photos/null.jpg" alt="no photo" /></a></p>';
			}
			echo '<p><a href="membre.php?id='.$idx.'">'.$data['prenom'].' '.$data['nom'].'</a></p>';
			}
			?>
			</div>
	<span class="corners-bottom"><span></span></span></div>
	</div>
<?}?>


</div> <!-- Fin Rightcol -->

<div id="leftcol">
<?php
if($admin==1){

if (isset($_POST['addmatchFromFile'])){
$fp = fopen("cal.txt",'w');
fwrite($fp, $_POST['text']);
fclose($fp);
$rf = fopen("cal.txt", 'r');
$sam = 0;
$dim = 0;
while (!feof($rf)){
	$line = fgets($rf);
	$men = 0;
	if (substr($line, 0, 4) == "Week")
	{
		$substring = strpbrk($line, "0123456789");
		$sam = substr($substring, 0, 2);
		$dim = substr($substring, 3, 2);
		$month = substr($substring, 6, 3);
		switch ($month){
		case 'Janv':
			$m = 1;
		case 'F&eacute;vr':
			$m = 2;
		case 'Mars':
			$m = 3;
		case 'Avri':
			$m = 4;
		case 'Mai ':
			$m = 5;
		case 'Juin':
			$m = 6;
		case 'Juil':
			$m = 7;
		case 'Aout':
			$m = 8;
		case 'Septe':
			$m = 9;
		case 'Octo':
			$m = 10;
		case 'Nove':
			$m = 11;
		case 'D&eacute;ce':
			$m = 12;		
		}
		$y = substr($substring, -6, 4);
	}
	else if (substr($line, 0, 1) == 0 ||substr($line, 0, 1) == 1 || substr($line, 0, 1) == 2)
	{
		if(substr(trim(substr($line, 3, 4)), -1, 0) == M) $men = 1;		
		if (substr($line, 12, 2) == 'SA') $day = $sam; else $day = $dim;
		$hour = substr($line, 16, 2);
		$min = substr($line, 19, 2);
		$teams = substr($line, 23);
		$locVis = explode("\t- \t", $teams);
		$local = $locVis[0];
		$visitor = $locVis[1];
		echo "$day/$m/$y"; 
}


}
fclose($rf);
}

if (isset($_POST['addManyMatch'])){
include("connection.php");
for ($i=1; $i<$_POST['numMatches']+1; $i++) {

$date = $_POST['annee'.$i.'']."-".$_POST['mois'.$i.'']."-".$_POST['jour'.$i.''];
$d = date("w",mktime(0, 0, 0, $_POST['mois'.$i.''] , $_POST['jour'.$i.''], $_POST['annee'.$i.'']));

$hour = $_POST['hour'.$i.'']."h".$_POST['min'.$i.''];

switch ($d) {
case 0:
        $day = 'Di';
        break;
case 1:
        $day = 'Lu';
        break;
case 2:
        $day = 'Ma';
        break;
case 3:
        $day = 'Me';
        break;
case 4:
        $day = 'Je';
        break;
case 5:
        $day = 'Ve';
        break;
case 6:
        $day = 'Sa';
        break;
}
if($_POST['local'.$i.'']=='' && $_POST['visiteur'.$i.'']!='') $_POST['local'.$i.''] = 'Walhain';
if($_POST['visiteur'.$i.'']=='' && $_POST['local'.$i.'']!='') $_POST['visiteur'.$i.''] = 'Walhain';

	
$sql = "INSERT INTO matches VALUES ('','".$_POST['div'.$i.'']."','".$day."','".$hour."','".$_POST['local'.$i.'']."','".$_POST['visiteur'.$i.'']."','0','0','".$date."','','0')";
$req = mysql_query($sql) or die("<div id=\"alert\">Erreur SQL !<br>".$sql."<br>".mysql_error()."</div>");
    

}
	mysql_close();
    if ($_POST['numMatches'] == 1) echo '<div id="info"><p>Match ajout&eacute; &agrave; la base de donn&eacute;es</p></div>';
	else echo '<div id="info"><p>Matches ajout&eacute;s &agrave; la base de donn&eacute;es</p></div>';

}




if (isset($_POST['adduser'])){
include("connection.php");
if(empty($_POST['nom']) || empty($_POST['prenom'])){
echo '<div id="alert"><p>Les champs <b>nom</b> et <b>pr&eacute;nom</b> doivent &ecirc;tre remplis</p></div>';
}
else {
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
if(!empty($_POST['surnom'])) {
	        $surnom=$_POST['surnom'];
}
else {
	        $surnom='NC';
}

if(!empty($_POST['equipe'])) {
	        $equipe=$_POST['equipe'];
}
else {
	        $equipe='NC';
}

if(!empty($_POST['jour'])) {
	        $jour=$_POST['jour'];
}
else {
	        $jour=00;
}

if(!empty($_POST['mois'])) {
	        $mois=$_POST['mois'];
}
else {
	        $mois=00;
}

if(!empty($_POST['annee'])) {
	        $annee=$_POST['annee'];
}
else {
	        $annee=00;
}

if(!empty($_POST['arrivee'])) {
	        $arrivee=$_POST['arrivee'];
}
else {
	        $arrivee=0;
}

if(!empty($_POST['taille'])) {
	        $taille=$_POST['taille'];
}
else {
	        $taille=0;
}

if(!empty($_POST['poste'])) {
	        $poste=$_POST['poste'];
}
else {
	        $poste='NC';
}

if(!empty($_POST['numero'])) {
	        $numero=$_POST['numero'];
}
else {
	        $numero=0;
}

if(!empty($_POST['hobbies'])) {
	        $hobbies=$_POST['hobbies'];
}
else {
	        $hobbies='NC';
}

if(!empty($_POST['profession'])) {
	        $profession=$_POST['profession'];
}
else {
	        $profession='NC';
}

if(!empty($_POST['login'])) {
	        $login=$_POST['login'];
}
else {
	        $login='';
}

if($_POST['photo']) {
	        $photo=1;
}
else {
	        $photo=0;
}

$naissance = $annee.'-'.$mois.'-'.$jour;
$sql = "INSERT INTO `membres` VALUES ('','".$nom."','".$prenom."','".$surnom."','".$naissance."','".$arrivee."','".$equipe."','".$taille."','".$poste."','".$numero."','".$login."','".$hobbies."','".$profession."','".$photo."')";

$req = mysql_query($sql) or die('<div id="error">Erreur SQL !<br>'.$sql.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Membre ajout&eacute; &agrave; la base de donn&eacute;es</p></div>';
}}

if(isset($_POST['deluser'])){
if($_POST['id']==1) {echo '<div id="error"><p>Ce membre ne peut pas &ecirc;tre supprim&eacute;.  Bien essay&eacute; ;-)</p></div>';}
else {
include("connection.php");
$sql = "DELETE FROM `membres` WHERE `id`='".$_POST['id']."'";
$req = mysql_query($sql) or die('<div id="error">Erreur SQL !<br>'.$sql.'<br>'.mysql_error().'</div>');
echo '<div id="info"><p>Membre n&deg; '.$_POST['id'].' supprim&eacute; de la base de donn&eacute;es</p></div>';
mysql_close();
}
}

if(isset($_POST['transfer'])){
include("connection.php");
$sqlb = "UPDATE membres SET `equipe`='".$_POST['div']."' WHERE `equipe`='SE'";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Les membres ont &eacute;t&eacute; transf&eacute;r&eacute;s de SE &agrave; '.$_POST['div'].'</p></div>';
}

if(isset($_POST['delorphans'])){
include("connection.php");
$sqlb = "DELETE FROM `membres` WHERE `equipe`='SE'";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Les membres SE ont &eacute;t&eacute; effac&eacute;s de la base de donn&eacute;es</p></div>';
}

if(isset($_POST['edituser'])){
include("connection.php");
if($_POST['photo']){$photo=1;} else {$photo=0;}
if(empty($_POST['nom']) || empty($_POST['prenom'])){
echo '<div id="error"><p>Les champs <b>nom</b> et <b>pr&eacute;nom</b> doivent &ecirc;tre remplis</p></div>';
}
else {
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
if(!empty($_POST['surnom'])) {
	        $surnom=$_POST['surnom'];
}
else {
	        $surnom='NC';
}

if(!empty($_POST['equipe'])) {
	        $equipe=$_POST['equipe'];
}
else {
	        $equipe='NC';
}

if(!empty($_POST['jour'])) {
	        $jour=$_POST['jour'];
}
else {
	        $jour=00;
}

if(!empty($_POST['mois'])) {
	        $mois=$_POST['mois'];
}
else {
	        $mois=00;
}

if(!empty($_POST['annee'])) {
	        $annee=$_POST['annee'];
}
else {
	        $annee=00;
}

if(!empty($_POST['arrivee'])) {
	        $arrivee=$_POST['arrivee'];
}
else {
	        $arrivee=0;
}

if(!empty($_POST['taille'])) {
	        $taille=$_POST['taille'];
}
else {
	        $taille=0;
}

if(!empty($_POST['poste'])) {
	        $poste=$_POST['poste'];
}
else {
	        $poste='NC';
}

if(!empty($_POST['numero'])) {
	        $numero=$_POST['numero'];
}
else {
	        $numero=0;
}

if(!empty($_POST['hobbies'])) {
	        $hobbies=$_POST['hobbies'];
}
else {
	        $hobbies='NC';
}

if(!empty($_POST['profession'])) {
	        $profession=$_POST['profession'];
}
else {
	        $profession='NC';
}

if(!empty($_POST['login'])) {
	        $login=$_POST['login'];
}
else {
	        $login='';
}

if($_POST['photo']) {
	        $photo=1;
}
else {
	        $photo=0;
}

$naissance = $annee.'-'.$mois.'-'.$jour;
$sql = "UPDATE `membres` SET `nom`='".$nom."',`prenom`='".$prenom."',`surnom`='".$surnom."',`naissance`='".$naissance."',`arrivee`='".$arrivee."',`taille`='".$taille."',`poste`='".$poste."',`numero`='".$numero."',`profession`='".$profession."',`hobbies`='".$hobbies."',`photo`='".$photo."',`equipe`='".$equipe."',`login`='".$login."'  WHERE `id`='".$_POST['id']."'";

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
echo '<div id="info"><p>Les caract&eacute;ristiques du membre n&deg;'.$_POST['id'].' ont &eacute;t&eacute; &eacute;dit&eacute;es</p></div>';
mysql_close();
}
}



if(isset($_POST['addteam'])){
	include("connection.php");
	if(empty($_POST['importance']) || empty($_POST['division']) || empty($_POST['complet'])) { 
	echo '<div id="error"><p>Les champs <b>niveau</b>, <b>division</b> et <b>nom complet</b> doivent &ecirc;tre remplis</p></div>';
	}
	else {
	if(!empty($_POST['entraineur'])){$entraineur=$_POST['entraineur'];}else{$entraineur='NC';}
	if(!empty($_POST['entrainement1'])){$entrainement1=$_POST['entrainement1'];}else{$entrainement1='NC';}
	if(!empty($_POST['entrainement2'])){$entrainement2=$_POST['entrainement2'];}else{$entrainement2='NC';}
	if(!empty($_POST['url_classement'])){$url_classement=$_POST['url_classement'];}else{$url_classement='NC';}
	if(!empty($_POST['url_photo'])){$url_photo=$_POST['url_photo'];}else{$url_photo='NC';}
	if($_POST['afficher']){$afficher=1;}else{$afficher=0;}
	
	$sql = "INSERT INTO equipes (importance,division, entraineur, entrainement1, entrainement2, url_classement,nom_complet, url_photo, afficher) VALUES ('".$_POST['importance']."','".$_POST['division']."', '".$entraineur."','".$entrainement1."','".$entrainement2."','".$url_classement."','".$_POST['complet']."','".$url_photo."','".$afficher."')";
	$req = mysql_query($sql) or die("<div id=\"alert\">Erreur SQL !<br>".$sql."<br>".mysql_error()."</div>"); 
	mysql_close();
	echo '<div id="info"><p>Equipe ajout&eacute;e &agrave; la base de donn&eacute;es</p></div>';
	}
}
if(isset($_POST['delteam'])){
	include("connection.php");
	if($_POST['division']=='SE') { echo '<div id="error"><p>L\'&eacute;quipe SE ne peut pas &ecirc;tre supprim&eacute;e</div>';}
	else {
	$sql = "DELETE FROM `equipes` WHERE `division`='".$_POST['division']."'";
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	$sqlb = "UPDATE `membres` SET `equipe`='SE' WHERE `equipe`='".$_POST['division']."'";
	$reqb = mysql_query($sqlb) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	$sqlc = "UPDATE matches SET `div`='SE' WHERE `div`='".$_POST['division']."'";
	$reqc = mysql_query($sqlc) or die('Erreur SQL !<br>'.$sqlc.'<br>'.mysql_error());
	mysql_close();
	echo '<div id="info"><p>L\'&eacute;quipe '.$_POST['division'].' a &eacute;t&eacute; supprim&eacute;e</div>';
	}
}

if(isset($_POST['editteam'])){
include("connection.php");
if($_POST['afficher']){$afficher=1;} else {$afficher=0;}
$sql = "UPDATE equipes SET `division`='".$_POST['division']."',`importance`='".$_POST['importance']."',`entraineur`='".$_POST['entraineur']."',`entrainement1`='".$_POST['entrainement1']."',`entrainement2`='".$_POST['entrainement2']."',`url_classement`='".$_POST['url_classement']."',`nom_complet`='".$_POST['complet']."',`url_photo`='".$_POST['url_photo']."',`afficher`='".$afficher."' WHERE id='".$_POST['id']."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
if($_POST['oldteam']!=$_POST['division']){
$sqlb = "UPDATE membres SET `equipe`='".$_POST['division']."' WHERE `equipe`='".$_POST['oldteam']."'";
$reqb = mysql_query($sqlb) or die('Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error());
$sqlc = "UPDATE matches SET `div`='".$_POST['division']."' WHERE `div`='".$_POST['oldteam']."'";
$reqc = mysql_query($sqlc) or die('Erreur SQL !<br>'.$sqlc.'<br>'.mysql_error());
echo '<div id="info"><p>Equipe mise &agrave; jour, sigle '.$_POST['oldteam'].' devenu '.$_POST['division'].' et infos &eacute;dit&eacute;es</p></div>';
}
else {echo '<div id="info"><p>Les informations de l\'&eacute;quipe '.$_POST['division'].' ont &eacute;t&eacute; &eacute;dit&eacute;es</p></div>';
}
}


if(isset($_POST['edit'])){
$proceed=1;
if(empty($_POST['hour']) || empty($_POST['min'])){
	echo '<div id="alert"><p>Les champs <b>heure</b> et <b>minutes</b> doivent &ecirc;tre remplis</p></div>';
	$proceed=0;
}
if(empty($_POST['local']) || empty($_POST['visiteur'])){
	echo '<div id="alert"><p>Les champs <b>local</b> et <b>visiteur</b> doivent &ecirc;tre remplis</p></div>';
	$proceed=0;
}
if(!is_numeric($_POST['hour']) || !is_numeric($_POST['min'])){
	echo '<div id="alert"><p>Les champs <b>heure</b> et <b>minutes</b> doivent &ecirc;tre des nombres entiers</p></div>';
	$proceed=0;
}
if($_POST['hour']>24 || $_POST['hour']<0){
	echo '<div id="alert"><p>Le champ <b>heure</b> doit &ecirc;tre compris entre 0 et 24</p></div>';
	$proceed=0;
}
if($_POST['min']>59 || $_POST['hour']<0){
	echo '<div id="alert"><p>Le champ <b>minute</b> doit &ecirc;tre compris entre 0 et 59</p></div>';
	$proceed=0;
}
if(!is_numeric($_POST['score_local']) || !is_numeric($_POST['score_visiteur'])){
	echo '<div id="alert"><p>Les champs <b>score local</b> et <b>score visiteur</b> doivent &ecirc;tre des nombres entiers</p></div>';
	$proceed=0;
}
if($_POST['score_local']>3 || $_POST['score_local']<0){
	echo '<div id="alert"><p>Le champ <b>score local</b> doit &ecirc;tre compris entre 0 et 3</p></div>';
	$proceed=0;
}
if($_POST['score_visiteur']>3 || $_POST['score_visiteur']<0){
	echo '<div id="alert"><p>Le champ <b>score visiteur</b> doit &ecirc;tre compris entre 0 et 3</p></div>';
	$proceed=0;
}
if($_POST['local']==$_POST['visiteur']){
	echo '<div id="alert"><p>Les champs <b>local</b> et <b>visiteur</b> doivent &ecirc;tre diff&eacute;rents</p></div>';
	$proceed=0;
}
if($proceed==1){
include("connection.php");
$date = $_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour'];
$hour = $_POST['hour']."h".$_POST['min'];
$i = date("w",$_POST['date']);

switch ($i) {
case 0:
        $day = 'Di';
        break;
case 1:
        $day = 'Lu';
        break;
case 2:
        $day = 'Ma';
        break;
case 3:
        $day = 'Me';
        break;
case 4:
        $day = 'Je';
        break;
case 5:
        $day = 'Ve';
        break;
case 6:
        $day = 'Sa';
        break;
}


$sql = "UPDATE matches SET `div`='".$_POST['div']."',`day`='".$day."',`date`='".$date."',`hour`='".$hour."',`local`='".$_POST['local']."',`visiteur`='".$_POST['visiteur']."',`score_local`='".$_POST['score_local']."',`score_visiteur`='".$_POST['score_visiteur']."' WHERE id='".$_POST['id']."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 
mysql_close();
echo '<div id="info"><p>Le matche a &eacute;t&eacute; &eacute;dit&eacute;</p></div>';
}}
?>

<div id="admin_content">

<div id="default"><div></div></div>

<div id="addmatches" style="display:none;"><div><h1>Ajouter des matches</h1>
<form method="post" action="addmatch.php">
<p>Ajouter combien de matches ?
<select name="nombreMatches">
<?
for ($i=1; $i<25; $i++) {
	echo '<option value='.$i.'>'.$i.'</option>';
}
?>
</select></p>
<p>Pour quelle équipe ?
<select name="division">
<? include("connection.php");
$sql = "SELECT * FROM `equipes` ORDER BY `division`";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) {
	if($data['division']!='SE'){
                echo '<option value="'.$data['division'].'">'.$data['division'].'</option>';
}
}
?>
</select></p>
<p><input type="submit" name="addmatch" value="Go" /></p>
</form>
</div></div>

<div id="addmatchesfromfile" style="display:none;"><div><h1>Ajouter des matches par copier/coller</h1>
<form method="post" action="equipes.php">
<p>Pour quelle équipe ?
<select name="division">
<? include("connection.php");
$sql = "SELECT * FROM `equipes` ORDER BY `division`";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) {
	if($data['division']!='SE'){
                echo '<option value="'.$data['division'].'">'.$data['division'].'</option>';
}
}
?>
</select></p>
<p><textarea cols="50" rows="50" name="text"></textarea></p>
<p><input type="submit" name="addmatchFromFile" value="Go" /></p>
</form>
</div></div>

<div id="adduser" style="display:none;"><div><h1>Ajouter un membre</h1>
<p>Remplir les champs pour ajouter un utilisateur.</p>
<p><table><tr><td><form method="post" action="equipes.php"><input type="hidden" name="id">Nom : <input type="text" size=15 name="nom"  maxlength=25></td></tr><tr><td>Pr&eacute;nom : <input type="text" size=15 name="prenom" maxlength=20></td></tr><tr><td>Surnom : <input type="text" size=15 name="surnom" maxlength=15></td></tr><tr><td>Equipe : <select name="equipe">
<?
include("connection.php");
$sql2 = "SELECT `division` FROM `equipes`";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while($data2 = mysql_fetch_assoc($req2)) {
                echo '<option value="'.$data2['division'].'">'.$data2['division'].'</option>';
}
?>
</select></td></tr><tr><td>Date de naissance : <? include('date.php'); ?></td></tr><tr><td>Ann&eacute;es &agrave; Walhain : <input type="text" size=2 name="arrivee" maxlength=2></td></tr><tr><td>Taille (cm) : <input type="text" size=3 name="taille" maxlength=3></td></tr><tr><td>Poste : <input type="text" size=15 name="poste" maxlength=15></td></tr><tr><td>Numero : <input type="text" size=2 name="numero" maxlength=2></td></tr><tr><td>Profession : <input type="text" size=20 name="profession" maxlength=20></td></tr><tr><td>Hobbies : <input type="textarea"  rows=4 cols=50 name="hobbies" maxlength=200></td></tr><tr><td>Photo : <input type="checkbox" name="photo"></td></tr><tr><td>Login du forum : <select name="login"><option value="" selected></option><?
include("connectionforum.php");
$sql = "SELECT username FROM `phpbb3_users`";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) {
                echo '<option value="'.$data['username'].'">'.$data['username'].'</option>';
}
?>
</select><tr><td><input type="submit" name="adduser" value="Ajouter"></form></td></tr></table></p>
</div></div>


<div id="addteam" style="display:none;"><div>
<h1>Ajouter une &eacute;quipe</h1>
<form method="post" action="equipes.php">
<p>Division : <input type="text"  name="division" maxlength=4></p>
<p>Niveau dans le club (DH -> P4, ladies first, on d&eacute;marre &agrave; 1) : <input type="text"  name="importance" maxlength=2></p>
<p>Nom complet : <input type="text"  name="complet" maxlength=30></p>
<p>Entraineur : <input type="text"  name="entraineur" maxlength=50></p>
<p>Premier entrainement (jour heure_d&eacute;but - heure_fin) : <input type="text"  name="entrainement1" maxlength=25></p>
<p>Deuxi&egrave;me entrainement : <input type="text"  name="entrainement2" maxlength=25></p>
<p>Lien vers les classements : <input type="text"  name="url_classement" maxlength=100></p>
<p>URL de la photo d'&eacute;quipe : <input type="text"  name="url_photo" maxlength=200></p>
<p>Afficher sur la page &eacute;quipes? : <input type="checkbox"  name="afficher"></p>
<p><input type="submit" name="addteam" value="Ajouter" />
</p>
</form>
</div></div>

<div id="delteam" style="display:none;"><div>
<h1>Supprimer une &eacute;quipe</h1>
<p>S&eacute;lectionnez une &eacute;quipe dans la liste pour la supprimer.</p>
<p>Attention, tous les matches et les membres associ&eacute; &agrave; cette division seront transf&eacute;r&eacute;s vers l'&eacute;quipe SE (Sans Equipe).  Ils pourront &ecirc;tre modifi&eacute;s ou effac&eacute; via l'option "g&eacute;rer les orphelins".</p>
<form method="post" action="equipes.php">
<p><select name="division">
<? include("connection.php");
$sql = "SELECT * FROM `equipes` ORDER BY `division`";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) {
	if($data['division']!='SE'){
                echo '<option value="'.$data['division'].'">'.$data['division'].'</option>';
}
}
?>
</select></p>
<p><input type="submit" name="delteam" value="Supprimer" />
</p>
</form>
</div></div>


<div id="deluser" style="display:none;"><div>
<h1>Supprimer une &eacute;quipe</h1>
<p>Choisir une personne dans la liste pour la supprimer</p>
<form method="post" action="equipes.php">
<p><select name="id">
<?
include("connection.php");
$sql = "SELECT * FROM `membres`";
$req = mysql_query($sql) or die('<div id="error">Erreur SQL !<br>'.$sql.'<br>'.mysql_error().'</div>');
while($data = mysql_fetch_assoc($req)) {
                echo '<option value="'.$data['id'].'">'.$data['prenom'].' '.$data['nom'].'</option>';
	}
?>
</select>
<input type="submit" name="deluser" value="OK" />
</p>
</form>
</div></div>


<div id="perm" style="display:none;"><div>
<h1>Accorder les permissions</h1>
<p>Description des niveaux d'acc&egrave;s :</p>
<p><u>Niveau 0</u> : inscrits sur le forum mais sans aucun droit sur le site, &agrave; part se connecter, ce qui ne sert &agrave; rien...</p>
<p><u>Niveau 1</u> : joueurs/joueuses/entraineurs, poss&egrave;dent une fiche et peuvent l'&eacute;diter</p>
<p><u>Niveau 2</u> : membres avec plus de privil&egrave;ges, pas encore utilis&eacute;</p>
<p><u>Niveau 3</u> : Administrateurs</p>

<form method="post" action="equipes.php">
<p><select name="login">
<?
include("connectionforum.php");
$sql = "SELECT user_id,username,user_access FROM `phpbb3_users` ORDER BY `user_id` DESC";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) {
	        echo '<option value="'.$data['username'].'">'.$data['username'].' ('.$data['user_access'].')</option>';
}
?>
</select>
<select name="level"><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option>
</select>
<input type="submit" value="OK" name="perm"/>
</p>
</form>

</div></div>

<div id="edituser" style="display:none;"><div>
<h1>Editer un membre</h1>
<h4>Rechercher dans la liste</h4>
<p>Choisir une personne dans la liste pour &eacute;diter sa fiche</p>
<p>Les membres dont l'&eacute;quipe a &eacute;t&eacute; supprim&eacute;e apparaissent en rouge dans la liste.</p>
<form method="get" action="edituser.php">
<p><select name="id">
<?
include("connection.php");
$sql = "SELECT * FROM `membres`";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) {
		if($data['equipe']=='SE') {echo '<option value="'.$data['id'].'"><div id="orphan">'.$data['prenom'].' '.$data['nom'].'</div></option>';}	
	        else {echo '<option value="'.$data['id'].'">'.$data['prenom'].' '.$data['nom'].'</option>';}
}
?>
</select>
<input type="submit" value="OK" name="edituser"/>
</p>
</form>
</div></div>

<div id="orphans" style="display:none;"><div>
<h1>G&eacute;rer les orphelins</h1>
<p>Vous pouvez soit transf&eacute;rer tous les membres ne se r&eacute;f&eacute;rant plus &agrave; aucune &eacute;quipe vers une autre &eacute;quipe, soit les supprimer tous.</p><p>Pour les &eacute;diter un par un utilisez la fonction au-dessus.</p>
<form method="post" action="equipes.php">
<select name="div">
<?
$sql = "SELECT `division` FROM `equipes`";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) {
	if($data['division']!='SE'){
	echo '<option value="'.$data['division'].'">'.$data['division'].'</option>';}
}
?>
</select>
<p><input type="submit" name="transfer" value="Transf&eacute;rer" /></p></form>
<form method="post" action="equipess.php">
<p><input type="submit" name="delorphans" value="Supprimer tous" /></p>
</form>
</div></div>



</div>
<?
}
?>
<div id="equipes_content">
<?
include("connection.php");
$i=0;
if($_GET['eq']=='') $eq = 'N2DA'; else $eq = $_GET['eq'];
$sql = "SELECT * FROM `equipes` WHERE `division`='".$eq."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_assoc($req);

	echo '<div>';
	echo '<h1>'.$data['nom_complet'];
	echo '</h1>';	
	if ($data['url_photo'] != '' && $data['url_photo'] != 'NC') echo '<img src="'.$data['url_photo'].'" />';
	echo '<table><tr><td><p>Entraineur : '.$data['entraineur'].'</p>';
	echo '<p><u>Composition</u></p><ul>';

	$sql2 = "SELECT nom,prenom,id,equipe FROM `membres` WHERE `equipe`='".$data['division']."' ORDER BY `nom`";

	$req2 = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());

	$res2 = mysql_num_rows($req2);

	while($data2 = mysql_fetch_assoc($req2)) {

		echo '<li><a href="membre.php?id='.$data2['id'].'">'.$data2['nom'].' '.$data2['prenom'].'</a></li>' ;

	}

	if($data['entrainement1']!='NC') {
		echo '</ul></td><td><p><u>Entrainements</u></p><ul>';
		echo '<li>'.$data['entrainement1'].'</li>';
		echo '<li>'.$data['entrainement2'].'</li></ul>';
	}
	else { echo '</ul></td><td>'; }
	
	echo '<p style="margin-top : 40px;"><a href="calendrier.php?eq='.$data['division'].'">Calendrier</a></p>';
	echo '<p><a href="'.$data['url_classement'].'">Classements</a></p></td></tr></table>';
	echo '</div>';

mysql_close();
?>
</div>
</div> <!-- Fin leftcol -->

</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
