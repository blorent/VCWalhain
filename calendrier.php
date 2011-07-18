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

<? include('menu.php');?>

<!-- Debut Contenu -->
<div id="maincontent">
<? include('log.html');
?>
<div id="onecolumn">
<?
if($admin==1){

if(isset($_POST['delcomment'])){
include("connection.php");
$sqlb = "UPDATE `matches` SET `avec_commentaire`=0, `commentaire`='' WHERE id=".$_POST['id']."";
$reqb = mysql_query($sqlb) or die('<div id="alert">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Commentaire effac&eacute; de la base de donn&eacute;es</p></div>';
}

if(isset($_POST['addcomment'])){
include("connection.php");
$sqlb = "UPDATE `matches` SET `avec_commentaire`=1, `commentaire`='".$_POST['commentaire']."' WHERE id=".$_POST['id']."";
$reqb = mysql_query($sqlb) or die('<div id="alert">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Commentaire ajout&eacute; &agrave; la base de donn&eacute;es</p></div>';
}

if(isset($_POST['delmatch'])){
include("connection.php");
$sqlb = "DELETE FROM `matches` WHERE id=".$_POST['id']."";
$reqb = mysql_query($sqlb) or die('<div id="alert">Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error().'</div>');
mysql_close();
echo '<div id="info"><p>Match effac&eacute; de la base de donn&eacute;es</p></div>';
}

if (isset($_POST['editmatch'])){
include("connection.php");
$date = $_POST['annee']."-".$_POST['mois']."-".$_POST['jour'];
$d = date("w",mktime(0, 0, 0, $_POST['mois'] , $_POST['jour'], $_POST['annee']));
$hour = $_POST['hour']."h".$_POST['min'];
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
if($_POST['local']=='' && $_POST['visiteur']!='') $local = 'Walhain';
if($_POST['visiteur']=='' && $_POST['local']!='') $_POST['visiteur'] ='Walhain';
$sql = "UPDATE `matches` SET `div`='".$_POST['div']."',`day`='".$day."',`hour`='".$hour."',`local`='".$_POST['local']."',`visiteur`='".$_POST['visiteur']."',`score_local`='".$_POST['score_local']."',`score_visiteur`='".$_POST['score_visiteur']."',`date`='".$date."',`scores`='".$_POST['scores']."' WHERE `id`='".$_POST['id']."'";
$req = mysql_query($sql) or die("<div id=\"alert\">Erreur SQL !<br>".$sql."<br>".mysql_error()."</div>");
echo '<div id="info"><p>Match &eacute;dit&eacute;</p></div>';
}
} // Fin admin

	
echo '<h1>Calendrier  '.$_GET['eq'].'</h1>'  ?>
<?php echo '<div class="rightalign"><a href="printcal.php?eq='.$_GET['eq'].'" target="_blank" title="Version imprimable"><img src="images/print_icon.gif" border="0"  alt="Version imprimable" style="position:relative;top:-20px;"/></a></div>' ?>
<div id="tablematch">
<?php
include("connection.php");
$sql = "SELECT *,DATE_FORMAT(date, '%d-%m-%Y') as datefr FROM `matches` WHERE `div`='".$_GET['eq']."' ORDER BY date";

	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	
	$res = mysql_num_rows($req);
	
	if ($res==0) {
		echo '<div class="centered">Aucun match trouv&eacute;</div>';
		}
		
	else {
	echo '<center>';
	echo '<table cellpadding=5 width=100%><tr>';
	if ($admin==1) echo '<th><font color="red">Admin</font></th>';
	echo '<th>Date</th><th>Heure</th><th>Rencontre</th><th>R&eacute;sultat</th></tr>';
function frdate($datearg)
      {
      $userDate = strtotime($datearg);
      $jours = array('Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa');
      return $jours[date("w", $userDate)];
      }

	while($data = mysql_fetch_assoc($req))
	{
	$visiteur=$data['visiteur'];
	$local = $data['local'];
	
if(ereg('Walhain',$data['local'])) {$local = '<b>'.$data['local'].'</b>';$visiteur=$data['visiteur'];}
	
if(ereg('Walhain',$data['visiteur'])) {$local=$data['local'];$visiteur='<b>'.$data['visiteur'].'</b>';}

if($data['score_local']==0 && $data['score_visiteur']==0) {$score = '-';} else {$score=$data['score_local'].'-'.$data['score_visiteur'];}
echo '<tr>';
if($admin==1) {
echo '<td><form style="display:inline;" action="calendrier.php?eq='.$data['div'].'" method="post"><input type="hidden" name="id" value="'.$data['id'].'">';
echo '<input type="image" src="images/icons/del.png" value="Effacer" name="delmatch"></form><form style="display:inline;" action="editmatch.php" method="post">';
echo '<input type="hidden" name="id" value="'.$data['id'].'"><input type="image" src="images/icons/edit.png" value="Editer" name="editmatch"></form>';
echo '<form style="display:inline;" action="comment.php" method="post"><input type="hidden" name="id" value="'.$data['id'].'">';
echo '<input type="image" src="images/icons/commentaire.png" value="Commentaire" name="comment"></form>';
echo '</td>';
}
if($data['avec_commentaire']==0) { 
echo '<td>'.frdate($data['date']).' '.$data['datefr'].'</td><td>'.$data['hour'].'</td><td>'.$local.' - '.$visiteur.'</td><td>'.$score.'</td></tr>';
		}
	else {
echo '<td>'.frdate($data['date']).' '.$data['datefr'].'</td><td>'.$data['hour'].'</td><td><a href="commentaire.php?id='.$data['id'].'" alt="commentaire">'.$local.' - '.$visiteur.'</a></td><td>'.$score.'</td></tr>';
	}
	}

		echo '</table>';
		}
echo '</center>';
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
