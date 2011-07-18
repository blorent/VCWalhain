<?php
include('session.php')
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
<?include('log.html');?>

<div id="rightcol">
<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>
	<h1>Autres matches de cette &eacute;quipe</h1>
	<ul>
	<?
	include('connection.php');
	$sqla = "SELECT `div` FROM `matches` WHERE `id`='".$_GET['id']."'";
	$reqa = mysql_query($sqla) or die('<div id="error">Erreur SQL !<br>'.$sqla.'<br>'.mysql_error().'</div>');
	$dat = mysql_fetch_assoc($reqa);
	$sql = "SELECT * FROM `matches` WHERE `div`='".$dat['div']."' AND `avec_commentaire`=1";
	$req = mysql_query($sql) or die('<div id="error">Erreur SQL !<br>'.$sql.'<br>'.mysql_error().'</div>');
	while($data = mysql_fetch_assoc($req)) {
                echo '<li><a href="commentaire.php?id='.$data['id'].'">'.$data['local'].' - '.$data['visiteur'].'</a></li>';
	}
	?>
	</ul> 
	<span class="corners-bottom"><span></span></span></div>
	</div>
</div>

<div id="leftcol">

	<?php	

	include("connection.php");

$sql = "SELECT * FROM `matches` WHERE `id`='".$_GET['id']."'";

$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

$res = mysql_num_rows($req);

$data = mysql_fetch_assoc($req);

echo '<h1>'.$data['div'].' : '.$data['local'].' - '. $data['visiteur'].' : '.$data['score_local'].' - '.$data['score_visiteur'].'</h1>'; 
	if ($res==0) {
		echo '<div class="centered"><center>Pas de commentaire pour ce match.</center></div>';
		}
		
	else {
	
	$com = str_replace("++","</p><p>",$data['commentaire']);
	echo '<p>'.$com.'</p>';
	
	if ($admin==1) {
	echo '<h2 style="margin-top : 35px;">Admin</h2>';
	echo '<p>';
	echo '<form style="display:inline;" action="comment.php" method="post">Editer le commentaire : <input type="hidden" name="id" value="'.$data['id'].'">';
	echo '<input type="image" src="images/icons/commentaire.png" value="Commentaire" name="comment"></form></p><p>';
	echo '<form style="display:inline;" action="calendrier.php?eq='.$data['div'].'" method="post">Supprimer le commentaire actuel : <input type="hidden" name="id" value="'.$data['id'].'">';
	echo '<input type="image" src="images/icons/del.png" value="Effacer commentaire" name="delcomment"></form></p>';
	}
	
	if(strlen($com) < 100) echo '<div id="bouchetrou" style="height:300px;"></div>';

		}

	mysql_close();
		?> 
</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
