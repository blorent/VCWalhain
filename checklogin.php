<?php
include("connectionforum.php");
if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['pass'])) {
extract($_POST);// on recupère le password de la table qui correspond au login du visiteur
$sql = "SELECT user_password,user_access FROM phpbb_users WHERE username='".$login."'";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_assoc($req);
if($data['user_password'] != md5($pass)) {
	$message= '<div class="centered">Mauvais login / password. Merci de recommencer</div>';
	$connected = 0;
	$page='login.php';
	}
else {
	session_start();
	$_SESSION['login'] = $login;
	$_SESSION['access'] = $data['user_access'];
	$message= '<div class="centered">Merci de vous &ecirc;tre connect&eacute;, '.$_SESSION['login'].'.</div>';
	$connected=1;
	if ($_SESSION['access']==3) {
		$page='index.php';
		}
	if ($_SESSION['access']==2) {
		$page='index.php';
		}
	if ($_SESSION['access']==1) {
		$page='index.php';
	}
	}
	}
else {
$message = '<div class="centered">Vous avez oubli&eacute; de remplir un champ.</div>';
$connected=0;
$page='login.php';
}
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

<? include('menu.php'); 
?>

<!-- Debut Contenu -->
<div id="maincontent">
<?include('log.html')?>
<div id="onecolumn">
<div class="centered">
<p><?echo $message;?></p>
<p>Cliquez <a href="index.php">ici</a> pour revenir &agrave; la page d'accueil.</p>
</div>
</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
