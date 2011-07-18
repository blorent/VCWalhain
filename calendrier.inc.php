<?// Fonction pour afficher le calendrier
     function showCalendar($periode) {
     
     include("connection.php");

          $leCalendrier = "";
          // Tableau des valeurs possibles pour un numéro de jour dans la semaine
          $tableau = Array("0", "1", "2", "3", "4", "5", "6", "0");
          $nb_jour = Date("t", mktime(0, 0, 0, getMonth($periode), 1, getYear($periode)));
          $pas = 0;
          $indexe = 1;

          // Affichage du mois et de l'année
          $leCalendrier .= "\n\t<h1><a href=\"index.php?per=".date("Y-m", mktime(0, 0, 0, getMonth($periode)-1, 1, getYear($periode)))."\">&laquo;&nbsp;</a>" . monthNumToName(getMonth($periode)) . " " . getYear($periode) . "<a href=\"index.php?per=".date("Y-m", mktime(0, 0, 0, getMonth($periode)+1, 1, getYear($periode)))."\">&nbsp;&raquo;</a></h1>";
          // Affichage des entêtes
          $leCalendrier .= "
          <ul id=\"libelle\">
               \t<li>L</li>
               \t<li>M</li>
               \t<li>M</li>
               \t<li>J</li>
               \t<li>V</li>
               \t<li>S</li>
               \t<li>D</li>
          </ul>";
        // Tant que l'on n'a pas affecté tous les jours du mois traité
          while ($pas < $nb_jour) {
               if ($indexe == 1) $leCalendrier .= "\n\t<ul class=\"ligne\">";
               // Si le jour calendrier == jour de la semaine en cours
if (Date("w", mktime(0, 0, 0, getMonth($periode), 1 + $pas, getYear($periode))) == $tableau[$indexe]) {
                    // Si jour calendrier == aujourd'hui
$afficheJour = Date("j", mktime(0, 0, 0, getMonth($periode), 1 + $pas, getYear($periode)));

                    
$jour = Date("j", mktime(0, 0, 0, getMonth($periode), 1 + $pas, getYear($periode)));
$mois = getMonth($periode);
$an = getYear($periode);
$sql = "SELECT * FROM `matches` WHERE date='".date('Y-m-d', mktime(0,0,0,getMonth($periode), 1 + $pas, getYear($periode)))."' ORDER BY date";
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
$res = mysql_num_rows($req);
$text = "";
while($data = mysql_fetch_assoc($req))
{
$text .=  "<p><b>{$data['div']}</b> : {$data['local']} - {$data['visiteur']}</p>";
}
$sqlb = "SELECT * FROM `events` WHERE date='".date('Y-m-d', mktime(0,0,0,getMonth($periode), 1 + $pas, getYear($periode)))."' ORDER BY date";
$reqb = mysql_query($sqlb) or die('Erreur SQL !<br>'.$sqlb.'<br>'.mysql_error());
$i=0;
while($datab = mysql_fetch_assoc($reqb))
{
$text .=  "<p class=\"event\" style=\"color:red;\">".$datab['titre']."</p>";
$i++;
}
            if ($text != '') {
		$class = " class=\"itemExistingItem\"";
		if($i==0) {$aclass=" class=\"info\"";} else {$aclass = " class=\"withEvent\"";}

$afficheJour = "<a$aclass href=\"details.php?jour=".Date("j", mktime(0, 0, 0, getMonth($periode), 1 + $pas, getYear($periode)))."&mois=".Date("m", mktime(0, 0, 0, getMonth($periode), 1 + $pas, getYear($periode)))."&annee=".Date("Y", mktime(0, 0, 0, getMonth($periode), 1 + $pas, getYear($periode)))."&dom=both\">" . Date("j", mktime(0, 0, 0, getMonth($periode), 1 + $pas, getYear($periode))) . "<em><span></span>".$text."</em></a>";

                         }
                         else {
                              $class = "";
                         }
                    
                    // Ajout de la case avec la date
                    $leCalendrier .= "\n\t\t<li$class>$afficheJour</li>";
                    $pas++;
               }
               //
               else {
                    // Ajout d'une case vide
                    $leCalendrier .= "\n\t\t<li>&nbsp;</li>";
               }
               if ($indexe == 7 && $pas < $nb_jour) { $leCalendrier .= "\n\t</ul>"; $indexe = 1;} else {$indexe++;}
          }
          // Ajustement du tableau
          for ($i = $indexe; $i <= 7; $i++) {
               $leCalendrier .= "\n\t\t<li>&nbsp;</li>";
          }
          $leCalendrier .= "\n\t</ul>\n";

          // Retour de la chaine contenant le Calendrier
          return $leCalendrier;
     }
     ?>
