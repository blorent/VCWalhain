<?php
include("connection.php");
$sql = "SELECT count FROM `compteur` WHERE `page`='printcal.php'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_assoc($req);
$current = $data['count'];
$new = $current+1;
$sql = "UPDATE `compteur` SET `count`=($current+1) WHERE `page`='printcal.php'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Site du Volley Club Walhain</title>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="printstyle.css"  /> 
<!--[if IE 6]>
    <link rel="stylesheet" type="text/css" href="ie6.css" media="screen" />
<![endif]-->
 <!--[if IE 7]>
<link rel="stylesheet" type="text/css" media="screen" href="ie7.css" />
<![endif]-->
<link rel="SHORTCUT ICON" href="../site/images/mikasa.gif" type="image/gif" />

   </head>

   <body>

      

       <!-- Le corps -->

<div id="printcorps">

	<?php	
	
	echo '<h2>Calendrier  '.$_GET['eq'].'</h2>'  ?>
	
	
		<div id="tablematch">
		<?php
include("connection.php");
$sql = "SELECT *,DATE_FORMAT(date, '%d-%m-%Y') as datefr FROM `matches` WHERE `div`='".$_GET['eq']."' ORDER BY date";

	$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	
	$res = mysql_num_rows($req);
	
	if ($res==0) {
		echo '<div id="login"><center>Aucun match trouv&eacute;</center></div>';
		}
		
	else {
	echo '<center>';
	echo '<table cellpadding=5 width=100%><tr><th>Date</th><th>Heure</th><th>Rencontre</th><th>R&eacute;sultat</th></tr>';
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
	if($data['avec_commentaire']==0) { 
echo '<tr><td>'.frdate($data['date']).' '.$data['datefr'].'</td><td>'.$data['hour'].'</td><td>'.$local.' - '.$visiteur.'</td><td>'.$data['score_local'].'-'.$data['score_visiteur'].'</td></tr>';
		}
	else {
	 echo '<tr><td>'.frdate($data['date']).' '.$data['datefr'].'</td><td>'.$data['hour'].'</td><td><a href="commentaire.php?id='.$data['id'].'" alt="commentaire">'.$local.' - '.$visiteur.'</a></td><td>'.$data['score_local'].'-'.$data['score_visiteur'].'</td></tr>';
	}
	}

		echo '</table>';
		}
echo '</center>';
	mysql_close();
		?> 
		</div>
		
   
</div>

</body>
</html>
