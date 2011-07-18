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
<script type="text/javascript">
<!--
    function toggle_visibility(cl) {
       var e = document.getElementById(cl);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
//-->
</script>
<div id="topheader"></div>
<div id="container">

<div id="header">
</div>

<? include('menu.php'); 
?>

<!-- Debut Contenu -->
<div id="maincontent">
<?
include('log.html');
?>

<div id="rightcol">


<?if($admin==1) {
?>
<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>	
	<h1>Admin</h1>
	<ul>
	<li><a href="#" onClick="Effect.divSwap('addcat','admin_content');return false;">Ajouter une cat&eacute;gorie</a></li>
	<li><a href="#" onClick="Effect.divSwap('addsubcat','admin_content');return false;">Ajouter une sous-cat&eacute;gorie</a></li>
	<li><a href="#" onClick="Effect.divSwap('addlink','admin_content');return false;">Ajouter un lien</a></li>
	</ul>
	<span class="corners-bottom"><span></span></span></div>
	</div>
	<?
	}
	?>

	<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>
	<h1>Aller &agrave;</h1>	
	<ul>
	<?
	include("connection.php");
	$sql = "SELECT * FROM `liens_categories`";
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	while($data = mysql_fetch_assoc($req)) {
                echo '<li><a href="liens.php#'.$data['id'].'">'.$data['cat'].'</a></li>';
	}
	?>
	</ul> 
	<span class="corners-bottom"><span></span></span></div>
	</div>
	<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>

	<?
	if($connected==1) {	
	?>
	<h1>Proposer un lien</h1>
	<form action="liens.php" method='post'>
	<p>Nom : <input type="text" name="nom" maxlength="100" size="10""></p>
	<p>Description : <input type="text" name="description" maxlength="200" size="10"></p>
	<p>Adresse : <input type="text" name="url" maxlength="250" size="10"></p>
	<p>Cat&eacute;gorie : <select name="categorie">
	<?
	include("connection.php");
	$sql = "SELECT * FROM `liens_categories`";
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	while($data = mysql_fetch_assoc($req)) {
                echo '<option value="'.$data['id'].'">'.$data['cat'].'</option>';
				if ( $data['num_subcats'] != 0 ){
				$sqlb = "SELECT * FROM `liens_subcat` WHERE `parent_id`=".$data['id']."";
				$reqb = mysql_query($sqlb) or die('Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error());
				while($datab = mysql_fetch_assoc($reqb)) {
					$value = (1000*$data['id']) + $datab['id'];
					echo '<option value="'.$value.'">'.$data['cat'].' > '.$datab['subcat'].'</option>';
				}
				}
	}
	?>
	</select></p>
	<p><input type="submit" value="Envoyer" name="submitlink"></p>
	</p>
	<?
	}
	else {
	?>
	<h1>Log in</h1>
	<p>Connectez-vous ci-dessus pour pouvoir proposer des liens vers des sites internet, forums, ... concernant le volley</p>
	<? } ?>
	<span class="corners-bottom"><span></span></span></div>
	</div>	

	

</div>


<div id="leftcol">
<?

if(isset($_POST['submitlink'])){
$error=array(); 
if(empty($_POST['nom'])){
	array_push($error, "<li>pas de nom pour le lien</li>");
}
if(empty($_POST['url'])){
	array_push($error, "<li>pas d'adresse vers laquelle pointer</li>");
}
if(ereg($_POST['url'],'http://'))$url = $_POST['url']; else $url='http://'.$_POST['url'];
if(empty($_POST['categorie'])){
	array_push($error, "<li>pas de cat&eacute;gorie choisie</li>");
}
if(count($error)){
 echo '<div id="error"><p>Les erreurs suivantes ont &eacute;t&eacute; rencontr&eacute;es :</p><p><ul>';
 while($error){
 echo array_shift($error);}
 echo '</ul></p></div>';
}
else {
if ($_POST['categorie'] > 1000){
$categorie = (int) ($_POST['categorie']/1000);
$subcategorie = $_POST['categorie'] - 1000*$categorie;
}
else {
$categorie = $_POST['categorie'];
$subcategorie = 0;
}
$date = date("Y-m-d");
$sqlb = "INSERT INTO `liens_attente` VALUES('',".$date.",'".$_SESSION['login']."','".$_POST['nom']."','".$_POST['description']."','".$_POST['url']."','".$categorie."','".$subcat."')";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Votre proposition de lien a bien &eacute;t&eacute; re&ccedil;ue.</p><p>Elle doit cependant encore &ecirc;tre accept&eacute;e par un administrateur du site pour &eacute;viter les abus.</p><p>Merci de votre contribution.</p></div>';
}
}

if($admin==1) {

if(isset($_POST['adminlink'])){
$error=array(); 
if(empty($_POST['nom'])){
	array_push($error, "<li>pas de nom pour le lien</li>");
}
if(empty($_POST['url'])){
	array_push($error, "<li>pas d'adresse vers laquelle pointer</li>");
}
if(ereg($_POST['url'],'http://'))$url = $_POST['url']; else $url='http://'.$_POST['url'];
if(empty($_POST['categorie'])){
	array_push($error, "<li>pas de cat&eacute;gorie choisie</li>");
}

if(count($error)){
 echo '<div id="error"><p>Les erreurs suivantes ont &eacute;t&eacute; rencontr&eacute;es :</p><p><ul>';
 while($error){
 echo array_shift($error);}
 echo '</ul></p></div>';
}
else {
include("connection.php");
if ($_POST['categorie'] > 1000){
$categorie = (int) ($_POST['categorie']/1000);
$subcategorie = $_POST['categorie'] - 1000*$categorie;
$sqlb = "INSERT INTO `liens`(id,nom,url,description,categorie,subcat) VALUES('','".$_POST['nom']."','".$url."','".$_POST['description']."','".$categorie."','".$subcategorie."')";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
}
else {
$sqlb = "INSERT INTO `liens`(id,nom,url,description,categorie) VALUES('','".$_POST['nom']."','".$url."','".$_POST['description']."','".$_POST['categorie']."')";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
}
mysql_close();
echo '<div id="info"><p>Lien ajout&eacute;</p></div>';
}
}

if(isset($_POST['editlink'])){
$error=array(); 
if(empty($_POST['nom'])){
	array_push($error, "<li>pas de nom pour le lien</li>");
}
if(empty($_POST['url'])){
	array_push($error, "<li>pas d'adresse vers laquelle pointer</li>");
}
if(ereg($_POST['url'],'http://'))$url = $_POST['url']; else $url='http://'.$_POST['url'];
if(count($error)){
 echo '<div id="error"><p>Les erreurs suivantes ont &eacute;t&eacute; rencontr&eacute;es :</p><p><ul>';
 while($error){
 echo array_shift($error);}
 echo '</ul></p></div>';
}
else {
include("connection.php");
if ($_POST['categorie'] > 1000){
$categorie = (int) ($_POST['categorie']/1000);
$subcategorie = $_POST['categorie'] - 1000*$categorie;
}
else {
$categorie = $_POST['categorie'];
$subcategorie = 0;
}
$sqlb = "UPDATE `liens`SET nom='".$_POST['nom']."',url='".$_POST['url']."',description='".$_POST['description']."',categorie='".$categorie."',subcat='".$subcategorie."' WHERE id=".$_POST['id']."";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Lien &eacute;dit&eacute;</p></div>';
}
}


if(isset($_POST['transfer'])){
$error=array(); 
if(empty($_POST['nom'])){
	array_push($error, "<li>pas de nom pour le lien</li>");
}
if(empty($_POST['url'])){
	array_push($error, "<li>pas d'adresse vers laquelle pointer</li>");
}
if(ereg($_POST['url'],'http://'))$url = $_POST['url']; else $url='http://'.$_POST['url'];
if(count($error)){
 echo '<div id="error"><p>Les erreurs suivantes ont &eacute;t&eacute; rencontr&eacute;es :</p><p><ul>';
 while($error){
 echo array_shift($error);}
 echo '</ul></p></div>';
}
else {
include("connection.php");
$sqlb = "INSERT INTO `liens`(id,nom,url,description,categorie) VALUES('','".$_POST['nom']."','".$_POST['url']."','".$_POST['description']."','".$_POST['categorie']."')";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
$sqlc = "DELETE FROM `liens_attente` WHERE id='".$_POST['id']."'";
$reqc = mysql_query($sqlc) or die('<div id="error">Erreur SQL !<br>'.$sqlc.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Lien &eacute;dit&eacute; et accept&eacute;</p></div>';
}
}

if(isset($_POST['accept'])){
include("connection.php");
$sqlb = "INSERT INTO `liens`(id,nom,url,description,categorie) VALUES('','".$_POST['nom']."','".$_POST['url']."','".$_POST['description']."','".$_POST['categorie']."')";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
$sqlc = "DELETE FROM `liens_attente` WHERE id='".$_POST['id']."'";
$reqc = mysql_query($sqlc) or die('<div id="error">Erreur SQL !<br>'.$sqlc.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Lien accept&eacute;</p></div>';
}



if(isset($_POST['admincat'])){ 
if(empty($_POST['categ'])){
	echo '<div id="error"><p>Tu as oubli&eacute; de donner un nom pour la cat&eacute;gorie.</p></div>';
}
else {
include("connection.php");
$sqlb = "INSERT INTO liens_categories(id,cat) VALUES('','".$_POST['categ']."')";
$reqb = mysql_query($sqlb) or die('<div id="alert">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Cat&eacute;gorie <b>'.$_POST['categ'].'</b> ajout&eacute;e</p></div>';
}
}

if(isset($_POST['adminsubcat'])){ 
if(empty($_POST['subcateg'])){
	echo '<div id="error"><p>Tu as oubli&eacute; de donner un nom pour la sous-cat&eacute;gorie.</p></div>';
}
else {
include("connection.php");
$sqlb = "INSERT INTO liens_subcat(id,parent_id,subcat) VALUES('','".$_POST['categ']."','".$_POST['subcateg']."')";
$reqb = mysql_query($sqlb) or die('<div id="alert">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
$sqlc = "UPDATE liens_categories SET num_subcats=num_subcats+1 Where id=".$_POST['categ']."";
$reqc = mysql_query($sqlc) or die('<div id="alert">Erreur SQL !<br>'.$sqlc.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Sous-cat&eacute;gorie <b>'.$_POST['subcateg'].'</b> ajout&eacute;e</p></div>';
}
}


if(isset($_POST['dellink'])){ 
include("connection.php");
$sqlb = "DELETE FROM liens WHERE id=".$_POST['id']."";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Lien effac&eacute;</p></div>';
}

if(isset($_POST['dellinkattente'])){ 
include("connection.php");
$sqlb = "DELETE FROM `liens_attente` WHERE id=".$_POST['id']."";
$reqb = mysql_query($sqlb) or die('<div id="alert">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Proposition de lien refus&eacute;e et effac&eacute;e</p></div>';
}
}

if($admin==1){
include("connection.php");
$sql = "SELECT liens_attente.*,liens_categories.cat FROM `liens_attente` LEFT JOIN liens_categories ON liens_attente.categorie=liens_categories.id ORDER BY liens_attente.categorie";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

if (mysql_num_rows($req)!=0) {
echo '<div id="adminalert"><p>Les liens suivants attendent d\'&ecirc;tre approuv&eacute;s :<ul>';
while($data = mysql_fetch_assoc($req)) echo '<li>Cat&eacute;gorie <b>'.$data['cat'].' :</b><a href="'.$data['url'].'" alt="'.$data['description'].'">'.$data['nom'].'</a></li><li class="form"><form action="liens.php" method="post"><input type="hidden" name="id" value="'.$data['id'].'"><input type="image" src="images/icons/del.png" value="Refuser" name="dellinkattente"></form><form action="editlink.php" method="post"><input type="hidden" name="id" value="'.$data['id'].'"><input type="hidden" name="attente" value="oui"><input type="image" src="images/icons/edit.png" value="Editer" name="editlink"></form><form action="liens.php" method="post"><input type="hidden" name="id" value="'.$data['id'].'"><input type="hidden" name="nom" value="'.$data['nom'].'"><input type="hidden" name="description" value="'.$data['desc'].'"><input type="hidden" name="url" value="'.$data['url'].'"><input type="hidden" name="categorie" value="'.$data['categorie'].'"><input type="image" src="images/icons/save.png" value="Accepter" name="accept"></form></li>';
echo '</ul></p>';
echo '</p></div>';
}
?>
<div id="admin_content">

<div id="default"><div></div></div>

<div id="addcat" style="display:none;"><div><h1>Ajouter une cat&eacute;gorie</h1>
<p><form action="liens.php" method='post'>
	<p>Cat&eacute;gorie : <input type="text" name="categ" maxlength="100" size="50"></p>
	<p><input type="submit" value="Ok" name="admincat"></p></form>
	</p>
</div></div>

<div id="addsubcat" style="display:none;"><div><h1>Ajouter une sous-cat&eacute;gorie</h1>
<p><form action="liens.php" method='post'>
	<p>Cat&eacute;gorie parente : <select name="categ" id="categ">
	<?
	include("connection.php");
	$sql = "SELECT * FROM `liens_categories`";
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	while($data = mysql_fetch_assoc($req)) {
                echo '<option value="'.$data['id'].'">'.$data['cat'].'</option>';
	}
	?>
	</select>
	</p>
	<p>Sous-cat&eacute;gorie : <input type="text" name="subcateg" maxlength="100" size="50"></p>
	<p><input type="submit" value="Ok" name="adminsubcat"></p></form>
	</p>
</div></div>

<div id="addlink" style="display:none;"><div><h1>Ajouter lien</h1>
<p>Les liens ajout&eacute;s ici seront directement ins&eacute;r&eacute;s dans la page sans approbation des admin.</p>
<p><form action="liens.php" method='post'>
	<p>Nom : <input type="text" name="nom" maxlength="100" size="50"></p>
	<p>Description : <input type="text" name="description" maxlength="200" size="50"></p>
	<p>Adresse compl&egrave;te : <input type="text" name="url" maxlength="250" size="50"></p>
	<p>Cat&eacute;gorie : <select name="categorie">
	<?
	include("connection.php");
	$sql = "SELECT * FROM `liens_categories`";
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	while($data = mysql_fetch_assoc($req)) {
                echo '<option value="'.$data['id'].'">'.$data['cat'].'</option>';
				if ( $data['num_subcats'] != 0 ){
				$sqlb = "SELECT * FROM `liens_subcat` WHERE `parent_id`=".$data['id']."";
				$reqb = mysql_query($sqlb) or die('Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error());
				while($datab = mysql_fetch_assoc($reqb)) {
					$value = (1000*$data['id']) + $datab['id'];
					echo '<option value="'.$value.'">'.$data['cat'].' > '.$datab['subcat'].'</option>';
				}
				}
	}
	?>
	</select></p>
	<p><input type="submit" value="Ok" name="adminlink"></p>
	</form>
	</p>

</div></div>
</div>
<?



}

$num_cat_unempty = 0;
include('connection.php');
$sql = "SELECT * FROM `liens_categories` ORDER BY id";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

if (mysql_num_rows($req)==0) {
echo '<div class="centered"><p>Il n\'y a aucune cat&eacute;gorie de liens &agrave; afficher.</p><p>C\'est sans doute Ber et Mike qui ont foir&eacute;.</p></div>';
}

else {
while($data = mysql_fetch_assoc($req))
{
if($data['num_subcats']==0)
{	

		$sqlb = "SELECT * FROM `liens` WHERE categorie=".$data['id']." ORDER BY nom";
		$reqb = mysql_query($sqlb) or die('Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error());
		if (mysql_num_rows($reqb)==0) { echo '';}
		else {
		$num_cat_unempty++;
		
		echo '<a name="'.$data['id'].'"></a><h2>'.$data['cat'].' ('.mysql_num_rows($reqb).')</h2>';
		while($datab = mysql_fetch_assoc($reqb)){
			echo '<p class="links">';
			if($admin==1) { echo '<form action="liens.php" method="post"><input type="hidden" name="id" value="'.$datab['id'].'"><input type="image" src="images/icons/del.png" value="Effacer" name="dellink"></form><form action="editlink.php" method="post"><input type="hidden" name="id" value="'.$datab['id'].'"><input type="hidden" name="attente" value="non"><input type="image" src="images/icons/edit.png" value="Editer" name="editlink"></form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';}
			echo '<a href="'.str_replace("http://http://","http://",$datab['url']).'" alt="'.$datab['description'].'">'.$datab['nom'].'</a>';
			
			echo '</p>';
			echo '<p class="linkdesc">'.$datab['description'].'</p>';
			
		}
	}
	}
	
	else
	{
		$sqlb = "SELECT * FROM `liens` WHERE categorie=".$data['id']." ORDER BY nom";
		$reqb = mysql_query($sqlb) or die('Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error());
		echo '<a name="'.$data['id'].'"></a><h2>'.$data['cat'].' ('.mysql_num_rows($reqb).')</h2>';
		echo '<p></p>';
		$sqlc = "SELECT * FROM `liens_subcat` WHERE parent_id=".$data['id']." ORDER BY ordre";
		$reqc = mysql_query($sqlc) or die('Erreur SQL !<br>'.$sqlc.'<br>'.mysql_error());
			while ($datac = mysql_fetch_assoc($reqc))
			{
				$sqld = "SELECT * FROM `liens` WHERE categorie=".$data['id']." AND subcat=".$datac['id']." ORDER BY nom";
				$reqd = mysql_query($sqld) or die('Erreur SQL !<br>'.$sqld.'<br>'.mysql_error());
				if (mysql_num_rows($reqd)==0) { echo '';}
				else {
					echo '<h3>'.$datac['subcat'].' ('.mysql_num_rows($reqd).')</h2>';
					while($datad = mysql_fetch_assoc($reqd)){
						echo '<p class="links">';
						if($admin==1) { echo '<form action="liens.php" method="post"><input type="hidden" name="id" value="'.$datad['id'].'"><input type="image" src="images/icons/del.png" value="Effacer" name="dellink"></form><form action="editlink.php" method="post"><input type="hidden" name="id" value="'.$datad['id'].'"><input type="hidden" name="attente" value="non"><input type="image" src="images/icons/edit.png" value="Editer" name="editlink"></form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';}
						echo '<a href="'.str_replace("http://http://","http://",$datad['url']).'" alt="'.$datad['description'].'">'.$datad['nom'].'</a>';
						echo '</p>';
						echo '<p class="linkdesc">'.$datad['description'].'</p>';
			
		}
				}
			}
	}
}
}


if($num_cat_unempty==0) echo '<div class="centered"><p>Il n\'y a aucun lien &agrave; afficher dans aucun cat&eacute;gorie.</p><p>C\'est sans doute Ber et Mike qui ont foir&eacute;.</p></div>';

?>
<div id="fill" style="height:400px;"></div>
</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
