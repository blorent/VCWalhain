<?php
include('session.php');
$photoset = '72157603990114606';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Site du Volley Club Walhain</title>
<link rel="stylesheet" media="screen" type="text/css" title="Design" href="style/style.css"  />
<script type='text/javascript' src='js/jquery.js?ver=1.2.6'></script>
<script src="js/jqueryflickr.js" type="text/javascript"></script>
<script src="js/jquerylitebox.js" type="text/javascript"></script>
<script type="text/javascript" src="fancybox/jqueryfancybox.js"></script>
<script type="text/javascript" src="fancybox/jquerypngFix.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/fancy.css" media="screen" />
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

<div id="rightcol">
<div class="rightitem"><div class="inner">
	<span class="corners-top"><span></span></span>
	<h1>Albums</h1>
	<ul>
	<li><a href="photos.php?album=72157606758672990">Beach</a></li>
	<li><a href="photos.php?album=72157603990114606">Photos de match</a></li>
	<li><a href="photos.php?album=72157603990112386">Photos d'&eacute;quipes</a></li>
	</ul> 
	<span class="corners-bottom"><span></span></span></div>
	</div>
</div>
<div id="leftcol">


<?
if($_GET['album']=='') {
echo '<h1>Photos</h1>';
echo '<p>S&eacute;lectionnez un album dans la liste de droite pour afficher ses photos.</p>';
echo '<p>Si vous poss&eacute;dez des photos susceptibles d\'&ecirc;tre incluses &agrave; ces galleries veuillez prendre';
echo ' contact avec un administrateur du site.</p>';
echo '<p>Certaines soci&eacute;t&eacute;s bloquent l\'acc&egrave;s au service FlickR, auquel cas vous ne pourrez pas voir les photos. D&eacute;sol&eacute;...</p>';
}

else {
$photoset = $_GET['album'];
?>
<script type="text/javascript"> 
	jQuery(function(){   
		jQuery("#gallery").flickr({     
			api_key: "412e7067a513669176e0f5f482681906", 
			type : 'photoset',
			photoset_id : '<? echo $photoset;?>',
			per_page: 100,
			thumb_size : 't',
			callback: liteBoxCallback
		});  
		
	}); 
	function liteBoxCallback(el){
          jQuery(el).litebox({
		  nz: '0.8em',
		  lu: 'images/loadingAnimation.gif',
		  oc : 'white',
		  oy: 0.6,
		  ns : 0,
		  prev : 'Pr&eacute;c&eacute;dente',
		  next : 'Suivante',
		  auto : 'Diaporama',
		  stop : 'Stop',
		  close : 'Fermer',
		  ad : '3000',
		  nz  : '9px',
		  });
        }

	function fancyBoxCallback(el){
        jQuery(el).lightBox();
    }





</script>
<h1>
<?
switch ($photoset)
{
case 72157606758672990 : echo "Beach"; break;
case 72157603990114606 : echo "Photos de match"; break;
case 72157603990112386 : echo "Photos d'&eacute;quipes"; break;
}
?>
</h1>
<p id="gallery" class="gallery">&nbsp;</p>
	<?}?>
</div>

</div>
<!-- Fin Contenu -->

</div> <!-- fermeture de container -->
<div id="bottombox"></div> <!-- hors du container car largeur plus grande -->
<div id="footnote"><p>&copy; Volley Club Walhain 2008</p></div>
</body>
</html>
