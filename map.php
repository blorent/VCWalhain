<?php
session_start();
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
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAjrrBM5fdVwZS_G9-swHUJxQ-TYhbT3uBOoBcVWC_-4fheCTNGhR79PQM2FOIdC-M5f9puKFpyZc9rQ"
      type="text/javascript"></script>
	<script>
	//<![CDATA[
function createMarker(point,text) {
	  var marker = new GMarker(point);
	  GEvent.addListener(marker, "click", function() {   marker.openInfoWindowHtml(text);  });
	  return marker;
	}
   function load() {
     if (GBrowserIsCompatible()) {
		var map = new GMap2(document.getElementById("map"));
		map.setCenter(new GLatLng(50.616333, 4.700561), 12);
		map.addControl(new GSmallMapControl());
		map.addControl(new GMapTypeControl());
		var TextAffiche="<b>Volley Club Walhain</b>";
		var point = new GLatLng(50.616333, 4.700561);
		var marker = createMarker(point,TextAffiche);
		map.addOverlay(marker);
     }
   }

   //]]>
	</script>
</head>
<body onload="load()" onunload="GUnload()">

<div id="topheader"></div>
<div id="container">

<div id="header">
<div id="slogan"><img src="images/slogan.png" /></div>
</div>

<? include('menu.php'); ?>

<div id="maincontent">
<?include('log.html');?>

<div id="onecolumn">

<h1>Plan d'acc&egrave;s</h1>
<div id="map"></div>

</div>
</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
