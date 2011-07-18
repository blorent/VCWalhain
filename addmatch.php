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
<div id="onecolumn">
<?if($admin!=1) { ?>
<div class="center"><p>Vous n'avez pas le droit d'acc&eacute;der &agrave; cette page.  Cliquez <a href="index.php">ici</a>
pour revenir &agrave; la page d'accueil.</p></div>
<?
}
else { ?>
<h1>Ajouter des matches en <?= $_POST['division'] ?></h1>
<form method="post" action="equipes.php">
<table cellspacing="5" cellpadding="3" width="100%">
<?
if (isset($_POST['addmatchFromFile']))
{	
	$fp = fopen("cal.txt",'w');
	fwrite($fp, $_POST['text']);
	fclose($fp);
	$rf = fopen("cal.txt", 'r');
	$sam = 0;
	$dim = 0;
	$i = 0;
	while (!feof($rf))
	{
		$line = fgets($rf);
		if (substr($line, 0, 4) == "Week")
		{
			$substring = strpbrk($line, "0123456789");
			
			$array=explode("\t", $substring);
			
			$sam = substr($substring, 0, 2);
			$dim = substr($substring, 3, 2);
			
			$month = substr($substring, 6, 4);
			switch ($month) 
			{
			    case 'Janv':
				    $m = 1;
			    break;
			    case 'Févr':
				    $m = 2;
			    break;
			    case 'Mars':
				    $m = 3;
			    break;
			    case 'Avri':
				    $m = 4;
			    break;
			    case 'Mai ':
				    $m = 5;
			    break;
			    case 'Juin':
				    $m = 6;
			    break;
			    case 'Juil':
				    $m = 7;
			    break;
			    case 'Aout':
				    $m = 8;
			    break;
			    case 'Sept':
				    $m = 9;
			    break;
			    case 'Octo':
				    $m = 10;
			    break;
			    case 'Nove':
				    $m = 11;
			    break;
			    case 'Déce':
				    $m = 12;
			    break;		
			}
			$y = substr($substring, -6, 4);
		}
		else if (ereg("walhain|Walhain", $line))
		{
			$i++;			
			$array=explode("\t", $line);
			
			if ( ((string) $array[1]) == 'SA')
			    $day = $sam;
			else
			{
				    if (!is_numeric($dim))
				    {
					    $dim = 1;
					    if($m != 12) $m++; else $m = 1;
				    }
				    $day = $dim;
			}
			$hour = (string) $array[2];
			if(ereg("walhain|Walhain", (string) $array[3])) $local = "Walhain"; else $local = (string) $array[3];
			if(ereg("walhain|Walhain", (string) $array[5])) $visiteur = "Walhain"; else $visiteur = (string) $array[5];
			
			echo '<input type="hidden" value="'.$_POST['division'].'" name="div'.$i.'" />';
	        echo '<tr>';
	        echo '<td>'.$i.')</td>';
	        echo '<td><label for="jour'.$i.'">Date :</label>';
	        echo '<select name="jour'.$i.'">';
		    for($j=1; $j < 32; $j++) {
		        if ($j == $day)
		            echo '<option value='.$j.' selected>'.$j.'</option>';
		        else
		            echo '<option value='.$j.'>'.$j.'</option>';		        
		    }
		    echo '</select>';
		    echo '<select name="mois'.$i.'">';
		    for($j=1; $j < 13; $j++) {
		        if ($j == $m)
		            echo '<option value='.$j.' selected>'.$j.'</option>';
		        else
		            echo '<option value='.$j.'>'.$j.'</option>';		       
		    }	
	        echo '</select>';
	        echo '<select name="annee'.$i.'">';
		    for($j= date('Y'); $j < date('Y')+3; $j++) {
		        if ($j == $y)
		            echo '<option value='.$j.' selected>'.$j.'</option>';
		        else
		            echo '<option value='.$j.'>'.$j.'</option>';		       
		    }
	        echo '</select></td>';
	        echo '<td><label for="local'.$i.'">Local &nbsp; :</local><input type="text" size="35" maxlength="60" name="local'.$i.'" value="'.trim($local).'"  /></td></tr><tr>';
	        echo '<td></td><td><label for="hour'.$i.'">Heure :</label><input type="text" size="2" maxlength="2" name="hour'.$i.'" value="'.substr($hour,0,2).'"/>
	    h<input type="text" size="2" maxlength="2" name="min'.$i.'" value="'.substr($hour,3,2).'" /></td>';
	        echo '<td><label for="visiteur'.$i.'">Visiteur :</label><input type="text" size="35" maxlength="60" name="visiteur'.$i.'" value="'.trim($visiteur).'" /></td>';
	    echo '</tr><tr><td>&nbsp;</td></tr>';
		}
	}
    echo '<input type="hidden" value="'.$i.'" name="numMatches" />';
}
else
{
    echo '<input type="hidden" value="'.$_POST['nombreMatches'].'" name="numMatches" />';
    for ($i=1; $i<$_POST['nombreMatches']+1; $i++) {
	    echo '<input type="hidden" value="'.$_POST['division'].'" name="div'.$i.'" />';
	    echo '<tr>';
	    echo '<td>'.$i.')</td>';
	    echo '<td><label for="jour'.$i.'">Date :</label>';
	    echo '<select name="jour'.$i.'">';
		    for($j=1; $j < 32; $j++) {
			    echo '<option value='.$j.'>'.$j.'</option>';
		    }
		    echo '</select>';
		    echo '<select name="mois'.$i.'">';
		    for($j=1; $j < 13; $j++) {
			    echo '<option value='.$j.'>'.$j.'</option>';
		    }	
	    echo '</select>';
	    echo '<select name="annee'.$i.'">';
		    for($j= date('Y'); $j < date('Y')+3; $j++) {
	            echo '<option value='.$j.'>'.$j.'</option>';
		    }
	    echo '</select></td>';
	    echo '<td><label for="local'.$i.'">Local &nbsp; :</local><input type="text" size="35" maxlength="60" name="local'.$i.'" /></td></tr><tr>';
	    echo '<td></td><td><label for="hour'.$i.'">Heure :</label><input type="text" size="2" maxlength="2" name="hour'.$i.'" />
	    h<input type="text" size="2" maxlength="2" name="min'.$i.'" /></td>';
	    echo '<td><label for="visiteur'.$i.'">Visiteur :</label><input type="text" size="35" maxlength="60" name="visiteur'.$i.'" /></td>';
	    echo '</tr><tr><td>&nbsp;</td></tr>';
    }
}
echo '<tr><td></td></tr><tr><td colspan="3" align="center"><input type="submit" name="addManyMatch" value="Go"/></td></tr>';
echo '</table></form>';

} ?>
</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
