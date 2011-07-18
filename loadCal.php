<?
$f = "cal.txt";
$fp = fopen($f,'w');
fwrite($fp, $_POST['calText'])
fclose($fp);
$rf = fopen($f, 'r');
$sam = 0;
$dim = 0;
while (!feof($rf)){
	$line = fgets($rf);
	echo $line;
	if (substr($line, 0, 4) == "Week"){
		$substring = strpbrk($line, "0123456789");
		$sam = substr($substring, 0, 2);
		echo $sam;
		$dim = substr($substring, 4, 2);
		echo $dim;
		}
	else if (ereg("walhain|Walhain", $line)){
		if (substr($line, 12, 2) == 'SA') $day = $sam; else $day = $dim;
		$hour = substr($line; 16, 2);
		$min = substr($line, 19, 2);
		$teams = substr($line, 23);
		echo $teams;
		$locVis[] = explode("\t \t", $teams);
		$local = $locVis[0];
		$visitor = $locVis[1];
}
fclose($rf);
?>