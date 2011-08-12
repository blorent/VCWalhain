<!-- Debut Menu -->
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
<li><a href="index.php" <?php currentPage('index') ?>id="index">ACCUEIL</a></li>
<li><a href="equipes.php" <?php currentPage('equipes') ?>id="equipes">EQUIPES</a></li>
<li><a href="beach.php" <?php currentPage('beach') ?>id="beach">BEACH</a></li>
<li><a href="liens.php" <?php currentPage('liens') ?>id="liens">LIENS</a></li>
<li><a href="photos.php" <?php currentPage('photos') ?>id="photos">PHOTOS</a></li>
<li><a href="contact.php" <?php currentPage('contact') ?>id="contact">CONTACT</a></li>
<li><a href="../forum/index.php" id="forum">FORUM</a></li>
</ul>
</div>
<!-- Fin Menu -->
