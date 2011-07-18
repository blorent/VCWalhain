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
<h1>Editer un match</h1>
<?
$sql2 = "SELECT * FROM `matches` WHERE `id`='".$_POST['id']."'";
$req2 = mysql_query($sql2) or die('Erreur SQL !<br>'.$sql2.'<br>'.mysql_error());
$data2 = mysql_fetch_assoc($req2);
?>
<p><table cellspacing=10><tr><td><form method="post" action="calendrier.php?eq=<?echo $data2['div']?>">Div : <select name="div">
<?
include("connection.php");


$datematch = $data2['date'];

$sql = "SELECT `division` FROM `equipes`";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
while($data = mysql_fetch_assoc($req)) {

	if($data['division']==$data2['div']){
		echo '<option selected value="'.$data['division'].'">'.$data['division'].'</option>';
	}
	else {
		echo '<option value="'.$data['division'].'">'.$data['division'].'</option>';
	}
}?>
</select></td></tr>
<tr><td>Date : <select name="jour">
<?
for($i=1; $i!=32; $i++) {
	if($i == date('j',strtotime($datematch))) {echo '<option value='.$i.' selected>'.$i.'</option>';}
	else {echo '<option value='.$i.'>'.$i.'</option>';}
}
?>
</select>
<select name="mois">
<?
for($i=1; $i!=13; $i++) {
	if($i == date('n',strtotime($data2['date']))) {echo '<option value='.$i.' selected>'.$i.'</option>';}
	else{  echo '<option value='.$i.'>'.$i.'</option>';}
}
?>
</select>
<select name="annee">
<?;
for($i=date('Y')-1; $i != date('Y')+2; $i++) {
		if($i == date('Y',strtotime($data2['date']))) {echo '<option value='.$i.' selected>'.$i.'</option>';}
		else{  echo '<option value='.$i.'>'.$i.'</option>';}
}
?>
</select>
</td></tr>
<?
$heure = substr($data2['hour'],0,2);
$min = substr($data2['hour'],3,2);
?>
<tr><td>Heure : <input type="text" size=2 name="hour" maxlength=2 value="<?echo $heure;?>">h<input type="text" size=2 name="min" maxlength=2 value="<?echo $min;?>"></td></tr>
<tr><td>Local : <input type="text" size=25 name="local" maxlength=35 value="<? echo $data2['local']; ?>"></td></tr>
<tr><td>Visiteur : <input type="text" size=25 name="visiteur" maxlength=35 value="<? echo $data2['visiteur']; ?>"></td>
</tr>
<tr><td>Score local : <input type="text" size=1 name="score_local" maxlength=1 value="<? echo $data2['score_local']; ?>"></td></tr>
<tr><td>Score visiteur : <input type="text" size=1 name="score_visiteur" maxlength=1 value="<? echo $data2['score_visiteur']; ?>"></td>
<tr><td>Scores : <input type="text" size=30 name="scores" maxlength=30 value="<? echo $data2['scores']; ?>"></td>
</tr><tr><td><input type="hidden" name="id" value="<? echo $data2['id']; ?>"><input type=submit name="editmatch" value=go></form></td></tr>

</form></table>
</p>

</div>
</div>
<!-- Fin contenu -->
</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>

   </body>
</html>
