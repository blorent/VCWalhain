<!-- Debut Menu -->
<div id="cache" style="display:none;">
<img src="style/images/menu/accueil_hover.gif" />
<img src="style/images/menu/equipes_hover.gif" />
<img src="style/images/menu/pronos_hover.gif" />
<img src="style/images/menu/beach_hover.gif" />
<img src="style/images/menu/liens_hover.gif" />
<img src="style/images/menu/photos_hover.gif" />
<img src="style/images/menu/contact_hover.gif" />
<img src="style/images/menu/forum_hover.gif" />
</div>
<?php
function currentPage($strPage) {
  if (strstr($_SERVER['PHP_SELF'], $strPage)) {
     echo 'class="current_' . $strPage. '" ';
  } else {
     echo '';
  }
}
?>
<div id="menu">
<ul>
<li><a href="index.php" <?php currentPage('index') ?>id="index"></a></li>
<li><a href="equipes.php" <?php currentPage('equipes') ?>id="equipes"></a></li>
<li><a href="../forum/viewforum.php?f=27" <?php currentPage('viewforum.php?f=27') ?>id="pronos"></a></li>
<li><a href="beach.php" <?php currentPage('beach') ?>id="beach"></a></li>
<li><a href="liens.php" <?php currentPage('liens') ?>id="liens"></a></li>
<li><a href="photos.php" <?php currentPage('photos') ?>id="photos"></a></li>
<li><a href="contact.php" <?php currentPage('contact') ?>id="contact"></a></li>
<li><a href="../forum/index.php" id="forum"></a></li>
</ul>

<fieldset>
<form method="post" action="search.php">
<p><input name="q" id="q" type="text" size="4" value="" /></p>
</form>
</fieldset>

</div>
<!-- Fin Menu -->
