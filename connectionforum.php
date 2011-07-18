<?
// Paramètres persos
$host = "mysql5-1.perso"; // voir hébergeur
$user = "lorent_db"; // vide ou "root" en local
$pass = "vaSqt2FG"; // vide en local
$bdd = "lorent_db"; // nom de la BD
// connexion
@mysql_connect($host,$user,$pass)
   or die("Impossible de se connecter");
@mysql_select_db("$bdd")
   or die("Impossible de se connecter");
?>
