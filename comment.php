<?
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
</div>

<? include('menu.php'); 
?>

<!-- Debut Contenu -->
<div id="maincontent">
<?include('log.html');?>

<div id="onecolumn">
<?
if($admin==1){
include("connection.php");
$sql = "SELECT * FROM `matches` WHERE `id`='".$_POST['id']."' ORDER BY `div`";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$data = mysql_fetch_assoc($req);
$commentaire=$data['commentaire'];
?>
<h1>Commentaire pour le match : <?echo $data['div'];?> <? echo $data['local'];?> - <? echo $data['visiteur'];?></h1>
<?
if($data['avec_commentaire'] == 1){
echo '<form style="display:inline;" action="calendrier.php?eq='.$data['div'].'" method="post">Supprimer le commentaire actuel : <input type="hidden" name="id" value="'.$data['id'].'">';
echo '<input type="image" src="images/icons/del.png" value="Effacer commentaire" name="delcomment"></form>';
}
?>


<form method="post" action="calendrier.php?eq=<?echo $data['div']?>">
<p>
</p><p><textarea rows=15 cols=100 name="commentaire" maxlength=1500><?echo $commentaire;?></textarea></p>
<p><input type="submit" value="OK" name="addcomment"/>
</p>
<p><input type=reset value=effacer></p>
<p><input type="hidden" name="id" value="<?echo $data['id'];?>"></p>
<p><input type="hidden" name="local" value="<?echo $data['local']?>" /></p>
<p><input type="hidden" name="visiteur" value="<?echo $data['visiteur']?>" /></p>
</form>
<? }
else echo '<div id=center><p>Vous n\'avez pas acc&egrave;s &agrave; cette zone.</p></div>';
?>




</div>
</div>
<!-- Fin contenu -->
</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>

   </body>
</html>
