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
</div>

<? include('menu.php'); 
?>

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
	<li><a href="index.php" onClick="Effect.divSwap('default','admin_content');return false;">Cacher tout</a></li>
	<li><a href="index.php" onClick="Effect.divSwap('addnews','admin_content');return false;">Poster News</a></li>
	<li><a href="index.php" onClick="Effect.divSwap('tableaux','admin_content');return false;">Activer / d&eacute;sactiver tableaux</a></li>
	<li><a href="index.php" onClick="Effect.divSwap('addevent','admin_content');return false;">Ajouter un event</a></li>
	<li><a href="index.php" onClick="Effect.divSwap('delevent','admin_content');return false;">Supprimer un event</a></li>
	<li><a href="index.php" onClick="Effect.divSwap('parse','admin_content');return false;">Parse info</a></li>
	<li><a href="http://phpmyadmin.ovh.net/">PHPMyAdmin</a></li>
	</ul> 
	<span class="corners-bottom"><span></span></span></div>
	</div>
<? } ?>


	<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>
	<div id="calendar">
		<?
		include("string.php");
		include("calendrier.inc.php");
		if($_GET['per']==''){
			echo showCalendar(date("Y-m"));
		}
		else { echo showCalendar($_GET['per']);}
	?>
	</div>
	<span class="corners-bottom"><span></span></span></div>
	</div>

	<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>
	<h1>Calendriers</h1>
	<ul>
<?
include('connection.php');
$sql = "SELECT division, nom_complet FROM `equipes` WHERE `afficher`=1 ORDER BY `importance` ASC";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) {
	echo '<li><a href="calendrier.php?eq='.$data['division'].'">'.$data['nom_complet'].'</a></li>';
}
?>

	</ul>
	<span class="corners-bottom"><span></span></span></div>
	</div>


</div>

<div id="leftcol">

<?
include("connection.php");

$sql = 'SELECT value FROM constants WHERE `name`="index"';
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_assoc($req);
$index = $data['value'];
if($admin==1){

if(isset($_POST['adminnews'])){
include("connection.php");
if(empty($_POST['news'])) echo '<div id="error"><p>Il faut remplir le champ <b>texte</b></p></div>';
else{
$date = date("Y-m-d");
$sqlb = "INSERT INTO `news`(id,texte,date_creation) VALUES('','".$_POST['news']."','".$date."')";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>News enregistr&eacute;e</p></div>';
}
}

if(isset($_POST['table'])){
include("connection.php");
$sql = "UPDATE constants SET `value`='".$_POST['nb']."' WHERE `name`='index'";
$req = mysql_query($sql) or die('<div id="error">Erreur SQL !<br>'.$sql.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Configuration de la page d\'accueil chang&eacute;e</p></div>';
}

if(isset($_POST['addevent'])){
include("connection.php");
if(empty($_POST['texte'])) echo '<div id="error"><p>Il faut remplir le champ <b>titre de l\'event</b></p></div>';
else{
$datetime = strtotime($_POST['annee'].'-'.$_POST['mois'].'-'.$_POST['jour']);
$date = date("Y-m-d", $datetime);
$sqlb = "INSERT INTO `events`(id,date,titre) VALUES('','".$date."','".$_POST['texte']."')";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Event ajout&eacute;</p></div>';
}
}

if(isset($_POST['delnews'])){
include("connection.php");
$sqlb = "DELETE FROM `news` WHERE id='".$_POST['id']."'";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>News effac&eacute;e</p></div>';
}

if(isset($_POST['editnews'])){
include("connection.php");
$sqlb = "UPDATE `news` SET texte='".$_POST['message']."'WHERE id='".$_POST['id']."'";
$reqb = mysql_query($sqlb) or die('<div id="error">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>News &eacute;dit&eacute;e</p></div>';
}

if (isset($_POST['delevent']) && isset($_POST['del']) && is_array($_POST['del']))
{
include("connection.php");
foreach ($_POST['del'] as $num => $value)
{
$sql="delete from events where id='$value'";
$result=mysql_query($sql);

}
echo '<div id="info"><p>Events supprim&eacute;s</p></div>';
}



?>

<div id="admin_content">

<div id="default"><div></div></div>

<div id="addnews" style="display:none;"><div><h1>Ajouter une news</h1>
<p><form action="index.php" method='post'>
	<p>Texte : <input type="text" name="news" maxlength="100" size="50"></p>
	<p><input type="submit" value="Enregistrer" name="adminnews"></p></form>
	</p>
</div></div>


<div id="tableaux" style="display:none;"><div><h1>Tableaux / pas tableaux</h1>
<form method="post" action="index.php">

<?	include("connection.php");
        $sql = "SELECT * FROM `constants` WHERE `name` = 'index'";
	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	$data = mysql_fetch_assoc($req);
	$index = $data['value'];

	if($index==1) {

	echo '<p><input type="radio" name="nb" value="1" checked>Utiliser l\'index avec les r&eacute;sultats (saison)</p><p>
		<input type="radio" name="nb" value="2">Utiliser l\'index sans les tableaux (hors saison)</p>'; }
	else {
		echo '<p><input type="radio" name="nb" value="1">Utiliser l\'index avec les r&eacute;sultats (saison)</p><p>
	<input type="radio" name="nb" value="2" checked>Utiliser l\'index sans les tableaux (hors saison)</p>'; }

	?>
<p><input type=submit value=Enregistrer name="table"></p></form>
</div></div>


<div id="addevent" style="display:none;"><div><h1>Ajouter un event</h1>
<p>S&eacute;lectionner les events &agrave;; supprimer.</p>
<p><form action="index.php" method='post'>
	<p>Date : <?include('datecourt.php');?></p>
	<p><input type="text" name="texte" maxlength="50" size="50"></p>
	<p><input type="submit" value="Enregistrer" name="addevent"></p></form>
	</p>
</div></div>

<div id="delevent" style="display:none;"><div><h1>Supprimer un event</h1>
<p>Les events enregistr&eacute;s ici seront affich&eacute;s sur le calendrier en rouge.</p>
<p><form action="index.php" method='post'>
<?
$sqlb = "SELECT * FROM `events` ORDER BY date";
$reqb = mysql_query($sqlb) or die('Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error());
while($datab = mysql_fetch_assoc($reqb))
{
echo "<p><input type=\"checkbox\" name=\"del[]\" value=\"".$datab['id']."\">";
echo "&nbsp;";
echo $datab['date'];
echo " - ";
echo $datab['titre'];
echo "</p>";
}
?>
<p></p>
<p><input type="submit" value="Supprimer s&eacute;lectionn&eacute;s" name="delevent"></p></form>
</p>
</div></div>


<div id="parse" style="display:none;"><div><h1>Parser les r&eacute;sutlats et classements depuis portailAIF.be</h1>
<?
//$file=file("http://www.portailaif.be/vbClassement.php?vb_Env=vbna&div=P1M&mat=0" );
//$class = 0;
//for ($cpt_i=0; $cpt_i<count($file); $cpt_i++)
 //{
	//if (ereg('<TR ALIGN=CENTER VALIGN=MIDDLE BGCOLOR=><TD>', $file[$cpt_i]))
	//{
//		$class++;
//		echo "$class <br>";
//	}
//	if (ereg('<TD ALIGN="LEFT">&nbsp;', $file[$cpt_i]))
//	{
//		$team = substr($file[$cpt_i], 21, strpos($file[$cpt_i], '&')-23);
//		echo "$team <br>";
//	}//
 //} 




?>
<p><form action="index.php" method='post'>
<p><input type="submit" value="Confirmer" name="parseConfirm"></p></form>
</p>
</div></div>


</div>

<? } ?>
<? if($index==2) { ?>

<h1>Bienvenue...</h1>
<p>...sur le site du Volley Club Walhain.</p>
<p>Vous trouverez ici des informations sur les activit&eacute;s du club, sur ses membres et sur les diverses &eacute;quipes du club, notamment les calendriers et les classements respectifs durant la saison.</p>
<p>N'h&eacute;sitez pas &agrave; <a href="contact.php">nous contacter</a> si vous souhaitez obtenir de plus amples informations.</p>
<p>Bonne visite!</p>
<? }

$sql = "SELECT * FROM news ORDER BY date_creation DESC";

$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

if (mysql_num_rows($req)!=0) {
?>
<h1>News</h1>	
<div id="news">
<?
function month($datearg)
{	
	$mois = array('', 'Jan', 'F&eacute;v', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'D&eacute;c');
	return $mois[date("n", $datearg)];
}

	while($data= mysql_fetch_assoc($req))
	{
$date = $data['date_creation'];
if($admin==1) $mess = '<p><form style="display:inline; "action="index.php" method="post"><input type="hidden" name="id" value="'.$data['id'].'"><input type="image" src="images/icons/del.png" value="Effacer" name="delnews"></form><form style="display:inline; action="editnews.php" method="post"><input type="hidden" name="id" value="'.$data['id'].'"><input type="image" src="images/icons/edit.png" value="Editer" name="editnews"></form></p>'; else $mess = '';
echo '<div class="newsitem"><div class="date">'.date('d',strtotime($date)).' <span>'.month(strtotime($date)).'</span> </div><div class="newstext">'.$data['texte'] .'</div>'.$mess.'</div>';

}
mysql_close(); ?> 
</div>

<? } 
if($index==1) {
include("connection.php");
function frdate($datearg)
{
	$userDate = strtotime($datearg);
	$jours = array('Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa');
	return $jours[date("w", $userDate)];
	}
function frmonth($datearg)
{	
	$mois = array('', 'janvier', 'f&eacute;vrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'ao&ucirc;t', 'septembre', 'octobre', 'novembre', 'd&eacute;cembre');
	return $mois[date("n", $datearg)];
}


$sql = "SELECT *,DATE_FORMAT(date, '%d-%m-%Y') as datefr FROM `matches` ORDER BY id";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

$id_day = date('w');
$inc = 1 + $id_day;

$prevSatime = time() - ($inc*24*60*60);
$prevSa = date('Y-m-d', $prevSatime);

$prevSaDay = date('j',$prevSatime);
$prevSaMonth = date('n',$prevSatime);

$prevDitime = time() - ($id_day*24*60*60);
$prevDi = date('Y-m-d', $prevDitime);

$prevDiDay = date('j',$prevDitime);
$prevDiMonth = date('n',$prevDitime);
$limittime = $prevDitime - (6*24*3600);
$limit = date('Y-m-d', $limittime);

if ($prevDiMonth==$prevSaMonth) {
echo '<h1>Derniers r&eacute;sultats : '.$prevSaDay.' - '.($prevSaDay+1).' '.frmonth($prevSatime).'</h1>';
}

else {
echo '<h1>Derniers r&eacute;sultats : '.$prevSaDay.' '.frmonth($prevSatime).' et 1er '.frmonth($prevDitime).'</h1>';
}

echo '<center><div id="tablematch">';
echo '<table cellpadding=5 width=90%><tr>';
if ($admin==1) echo '<th><font color="red">Admin</font></th>';
echo '<th>Division</th><th>Date</th><th>Rencontre</th><th>R&eacute;sultat</th></tr>';

$sql = "SELECT *,DATE_FORMAT(date, '%d-%m-%Y') as datefr FROM `matches` WHERE  `date`<='".$prevDi."' AND `date`>='".$limit."' ORDER BY date";

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());	
while($data = mysql_fetch_assoc($req))
       {
if(ereg('Walhain',$data['local'])) {$local = '<b>'.$data['local'].'</b>';$visiteur=$data['visiteur'];}
	
if(ereg('Walhain',$data['visiteur'])) {$local=$data['local'];$visiteur='<b>'.$data['visiteur'].'</b>';}

if($data['score_local']==0 && $data['score_visiteur']==0) {$score = '-';} else {$score=$data['score_local'].'-'.$data['score_visiteur'];}

if($data['avec_commentaire']==0) {
echo '<tr>';
if($admin==1) {
echo '<td><form style="display:inline;" action="calendrier.php?eq='.$data['div'].'" method="post"><input type="hidden" name="id" value="'.$data['id'].'">';
echo '<input type="image" src="images/icons/del.png" value="Effacer" name="delmatch"></form><form style="display:inline;" action="editmatch.php" method="post">';
echo '<input type="hidden" name="id" value="'.$data['id'].'"><input type="image" src="images/icons/edit.png" value="Editer" name="editmatch"></form>';
echo '<form style="display:inline;" action="comment.php" method="post"><input type="hidden" name="id" value="'.$data['id'].'">';
echo '<input type="image" src="images/icons/commentaire.png" value="Commentaire" name="comment"></form>';
echo '</td>';
}
echo '<td>'.$data['div'].'</td><td>'.frdate($data['date']).' '.$data['datefr'].'</td><td>'.$local.' - '.$visiteur.'</td><td>'.$score.'</td></tr>';
           }
else {
echo '<tr>';
if($admin==1) {
echo '<td><form style="display:inline;" action="calendrier.php?eq='.$data['div'].'" method="post"><input type="hidden" name="id" value="'.$data['id'].'">';
echo '<input type="image" src="images/icons/del.png" value="Effacer" name="delmatch"></form><form style="display:inline;" action="editmatch.php" method="post">';
echo '<input type="hidden" name="id" value="'.$data['id'].'"><input type="image" src="images/icons/edit.png" value="Editer" name="editmatch"></form>';
echo '<form style="display:inline;" action="comment.php" method="post"><input type="hidden" name="id" value="'.$data['id'].'">';
echo '<input type="image" src="images/icons/commentaire.png" value="Commentaire" name="comment"></form>';
echo '</td>';
}
echo '<td>'.$data['div'].'</td><td>'.frdate($data['date']).' '.$data['datefr'].'</td><td><a href="commentaire.php?id='.$data['id'].'" alt="commentaire">'.$local.' - '.$visiteur.'</a></td><td>'.$score.'</td></tr>';
         }
        }	 
echo '</table></div></center>';

$nextWeek = time() + (7 * 24 * 60 * 60);
$nextdate = date('Y-m-d', $nextWeek);
$date = date('Y-m-d', time());

$id_day = date('w');
$inc = 7 - $id_day;
if($inc<0) {$inc = 7;}

$nextSatime = time() + (($inc-1)*24*60*60);
$nextSa = date('Y-m-d', $nextSatime);
$nextSaDay = date('j',$nextSatime);
$nextSaMonth = date('n',$nextSatime);

$nextDitime = time() + $inc*(24*60*60);
$nextDi = date('Y-m-d', $nextDitime);
$nextDiDay = date('j',$nextDitime);
$nextDiMonth = date('n',$nextDitime);

$limittime = $nextDitime;
$limit = date('Y-m-d', $limittime);


if ($nextDiMonth==$nextSaMonth) {
echo '<h1>Prochains matches : '.$nextSaDay.' - '.($nextSaDay+1).' '.frmonth($nextSatime).'</h1>';
}

else {
echo '<h1>Prochains matches :'.$nextSaDay.' '.frmonth($nextSaDay).' et 1er '.frmonth($nextDiDay).'</h1>';
          }

$sql = "SELECT *,DATE_FORMAT(date, '%d-%m-%Y') as datefr FROM `matches` WHERE  `date`<='".$nextDi."' AND `date`>='".date('Y-m-d', time())."' ORDER BY date";


$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

$res = mysql_num_rows($req);

if ($res==0) {
echo '<div id="login"><center>Il n\'y a pas de matches ce week-end.</center></div>';
}

else {
echo '<center><div id="tablematch"><table cellpadding=5 width=90%><tr>';
if ($admin==1) echo '<th><font color="red">Admin</font></th>';
echo '<th>Division</th><th>Date</th><th>Heure</th><th>Rencontre</th></tr>';
while($data = mysql_fetch_assoc($req))
{
echo '<tr>';
if($admin==1){
echo '<td><form style="display:inline;" action="calendrier.php?eq='.$data['div'].'" method="post"><input type="hidden" name="id" value="'.$data['id'].'">';
echo '<input type="image" src="images/icons/del.png" value="Effacer" name="delmatch"></form><form style="display:inline;" action="editmatch.php" method="post">';
echo '<input type="hidden" name="id" value="'.$data['id'].'"><input type="image" src="images/icons/edit.png" value="Editer" name="editmatch"></form>';
echo '</td>';
}
echo '<td>'.$data['div'].'</td><td>'.frdate($data['date']).' '.$data['datefr'].'</td><td>'.$data['hour'].'</td><td>'.$data['local'].' - '.$data['visiteur'].'</td></tr>';
}

echo '</table></center>';
}
mysql_close();
echo '</div></div>';
}
?>


</div>

</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
