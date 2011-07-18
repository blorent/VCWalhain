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
<div id="slogan"><img src="images/slogan.png" /></div>
</div>

<? include('menu.php');?>

<!-- Debut Contenu -->
<div id="maincontent">
<div id="onecolumn">
<?if(isset($_POST['edituser'])){
include("connection.php");
if($_POST['photo']){$photo=1;} else {$photo=0;}
if(empty($_POST['nom']) || empty($_POST['prenom'])){
echo '<div id="error" style="margin-top : 40px;"><p>Les champs <b>nom</b> et <b>pr&eacute;nom</b> doivent &ecirc;tre remplis</p></div>';
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
echo '<div id="info" style="margin-top : 40px;"><p>Vos informations personnelles ont &eacute;t&eacute; mises &agrave; jour.</p></div>';
mysql_close();
}
}

echo '<h1>Editer ma fiche personnelle</h1>';
include('connection.php');
$sql = "SELECT * FROM `membres` WHERE `id`='".$_GET['id']."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$res = mysql_num_rows($req);
if ($res==0) {
     echo '<div class="centered">Aucun membre trouv&eacute;</div>';
}
else {
$data = mysql_fetch_assoc($req);
$naissance = $data['naissance'];
		echo '<div id="fiche">';
		if($data['photo']==1) {echo '<img src="photos/'.$data['id'].'.jpg" alt="'.$data['nom'].'" />';}
		    else {
		          echo '<img src="photos/null.jpg" alt="No photo" />';
		    }
echo '<table cellspacing=8><tr><td>ID du membre : '.$data['id'].'</td></tr><tr><td><form method="post" action="edit.php?id='.$_GET['id'].'"><input type="hidden" name="id" value="'.$data['id'].'">Nom : <input type="text" size=15 name="nom" value="'.$data['nom'].'" maxlength=20></td></tr><tr><td>Pr&eacute;nom : <input type="text" size=15 name="prenom" value="'.$data['prenom'].'" maxlength=20></td></tr><tr><td>Surnom : <input type="text" size=15 name="surnom" value="'.$data['surnom'].'" maxlength=15></td></tr><tr><td>Equipe : <select name="equipe">';

include("connection.php");
$sq = "SELECT `division` FROM `equipes`";
$re = mysql_query($sq) or die('Erreur SQL !<br>'.$sq.'<br>'.mysql_error());

while($dat = mysql_fetch_assoc($re)) {
	
	if($dat['division']==$data['equipe']){
		echo '<option selected value="'.$dat['division'].'">'.$dat['division'].'</option>';
	}
	else {
		echo '<option value="'.$dat['division'].'">'.$dat['division'].'</option>';
	}

}
?>
</select></td></tr><tr><td>Date de naissance : <select name="jour">
<?
for($i=1; $i!=32; $i++) {
	if($i == date('j',strtotime($naissance))) {echo '<option value='.$i.' selected>'.$i.'</option>';}
	else {echo '<option value='.$i.'>'.$i.'</option>';}
}
?>
</select>
<select name="mois">
<?
for($i=1; $i!=13; $i++) {
	if($i == date('n',strtotime($naissance))) {echo '<option value='.$i.' selected>'.$i.'</option>';}
	else{  echo '<option value='.$i.'>'.$i.'</option>';}
}
?>
</select>
<select name="annee">
<?;
for($i=1950; $i != date('Y')+2; $i++) {
		if($i == date('Y',strtotime($naissance))) {echo '<option value='.$i.' selected>'.$i.'</option>';}
		else{  echo '<option value='.$i.'>'.$i.'</option>';}
}
?>
</select></td></tr><tr><td>Ann&eacute;es &agrave; Walhain : <input type="text" size=2 name="arrivee" value="<? echo $data['arrivee']; ?>" maxlength=2></td></tr><tr><td>Taille (cm) : <input type="text" size=3 name="taille" value="<? echo $data['taille'];?>" maxlength=3></td></tr><tr><td>Poste : <input type="text" size=15 name="poste" value="<? echo $data['poste']; ?>" maxlength=15></td></tr><tr><td>Numero : <input type="text" size=2 name="numero" value="<? echo $data['numero']; ?>" maxlength=2></td></tr><tr><td>Profession : <input type="text" size=20 name="profession" value="<? echo $data['profession']; ?>" maxlength=20></td></tr><tr><td>Hobbies : <input type="textarea"  rows=4 cols=50 name="hobbies" value="<? echo $data['hobbies']; ?>" maxlength=200></td></tr><tr><td>Photo : <input type="checkbox"  name="photo" <? echo ($data['photo']==1)?" checked":""; ?>></td></tr><tr><td>Login du forum :  <select name="login"><option value=""></option>
<?	
include("connectionforum.php");
$sql2 = "SELECT username FROM `phpbb3_users`";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
while($data2 = mysql_fetch_assoc($req2)) {

	if($data2['username']==$data['login']){
		echo '<option selected value="'.$data2['username'].'">'.$data2['username'].'</option>';
	}
	else {
		 echo '<option value="'.$data2['username'].'">'.$data2['username'].'</option>';
	}
}
?>
</select><tr><td><input type=submit name="edituser" value=go></form></td></tr></table></div>
<?
 }
		        mysql_close();

?>
</div></div>
</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
