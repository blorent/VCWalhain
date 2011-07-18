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
<script language="JavaScript">
<!-- Begin
bouton = new Image();
bouton.src = "images/photos/salle2.jpg";
end -->
</script>
</head>
<body>

<div id="topheader"></div>
<div id="container">

<div id="header">
</div>

<? include('menu.php');?>

<!-- Debut Contenu -->
<div id="maincontent">
<?include('log.html');?>



<div id="onecolumn">

<a name="salle"></a>

<h1>La salle</h1>
<p><a href="map.php">Plan d'acc&egrave;s</a></p>
<div id="adressepic"><a href="#" onmouseover="bouton.src = 'images/photos/salle2.jpg';" onmouseout="bouton.src = 'images/photos/salle1.jpg';"><img src="images/photos/salle1.jpg" border=1 width="250" name=bouton></a></div>
<h4>Coordonn&eacute;es</h4>
<div id="adresse">
<p><img src="images/home.gif" /> : Rue Chapelle Sainte Anne 1457 Walhain</p>
<p><img src="images/icon_phone.gif" /> : 010 / 65 74 46</p>
<p><img src="images/clock.gif" /> Occupation : </p>
<p></p>
<ul>
  <li>Lundi : mini-foot / badminton</li>
  <li>Mardi : volley de 18h30 &agrave; 22h30</li>
  <li>Mercredi : volley (jeunes)</li>
  <li>Jeudi : volley de 18h30 &agrave; 22h30</li>
  <li>Vendredi : volley</li>
  <li>Samedi : volley</li>
  <li>Dimanche matin : volley loisirs / badminton</li>
</ul>
</div>

<a name="comite"></a>
<h1>Le comit&eacute;</h1>
<div id="comite">
<table cellpadding="20" width="85%" cellspacing="15">
  <tbody>
    <tr>      
      <td>
      <h3>Pr&eacute;sident</h3>
      <div class="contact">
      <p></p>
      <h4>Marc Jaumotte</h4>
      <p><img src="images/home.gif"> : Rue Abesse, 15, 1457 Walhain</p>
      <p><img src="images/icon_phone.gif"> : 010/65.75.41</p>
      <p><img src="images/adresse.gif"> : <a href="mailto:president@vcwalhain.be"></a></p>
      </div>
</td>
<td>
      <h3>Secr&eacute;taire</h3>
      <div class="contact">
      <p></p>
      <h4>Alain Dupont</h4>
      <p><img src="images/home.gif"> : Chauss&eacute;e de Namur, 251/2, 1300 Wavre</p>
      <p><img src="images/icon_phone.gif"> : 0478 / 32 77 09</p>
      <p><img src="images/adresse.gif"> : <a href="mailto:secretaire@vcwalhain.be">secretaire@vcwalhain.be</a></p>
      </div>
      </td>
</tr>
<tr>
	<td>
      <h3>Jeunes</h3>
      <div class="contact">
      <p></p>
      <h4>Alain Dupont</h4>
      <p><img src="images/home.gif"> : Chauss&eacute;e de Namur, 251/2, 1300 Wavre</p>
      <p><img src="images/icon_phone.gif"> : 0478 / 32 77 09</p>
      <p><img src="images/adresse.gif"> : <a href="mailto:secretaire@vcwalhain.be">secretaire@vcwalhain.be</a></p>
      </td>  
	<td>
      <h3>Loisirs</h3>
      <div class="contact">
      <p></p>
      <h4>Marcelle Moncousin</h4>
      <p><img src="images/home.gif"> : All&eacute;e des Jonquilles, 2, 1457 Walhain</p>
      <p><img src="images/icon_phone.gif"> : 010 / 65 89 47</p>
      <p><img src="images/adresse.gif"> : <a href="mailto:loisirs@vcwalhain.be"></a></p>
      </div>
      </td>
    </tr>
  </tbody>
</table>
</div>


<a name="email"></a>

<h1>Contact par mail</h1>

<div id="mail">
<form method=POST action=sendmail.php >
<input type=hidden name=subject value=formmail>
<table>
<tr><td>Votre Nom:</td>
    <td><input type=text name=realname size=30></td></tr>
<tr><td>Votre Email:</td>
    <td><input type=text name=email size=30></td></tr>
<tr><td>Sujet:</td>
    <td><input type=text name=title size=30></td></tr>
<tr><td colspan=2>Commentaires:<br>
  <textarea COLS=50 ROWS=6 name=comments></textarea>
</td></tr>
</table>
<br> <input type=submit value=Envoyer> -
     <input type=reset value=Annuler>
</form>
</div>
<a name="credits"></a>
<h1>Conception et maintenance du site</h1>
<div id="conception"><h4>Bertrand "Ber" Lorent</h4>
<p><a href="membre.php?id=1" alt="Ber">Voir sa fiche</a></p>
<p><a href="mailto:ber@vcwalhain.be" alt="Mail Ber">Lui envoyer un mail</a></p>
<h4>Micha&euml;l "Mike" Duch&ecirc;ne</h4>
<p><a href="membre.php?id=2" alt="Mike">Voir sa fiche</a></p>
<p><a href="mailto:mike@vcwalhain.be" alt="Mail Mike">Lui envoyer un mail</a></p>
</div>


</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
