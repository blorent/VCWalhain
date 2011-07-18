<select name="jour">
<?
for($i=1; $i < 32; $i++) {
	echo '<option value='.$i.'>'.$i.'</option>';
}
?>
</select>
<select name="mois">
<?;
for($i=1; $i < 13; $i++) {
        echo '<option value='.$i.'>'.$i.'</option>';
}
?>
</select>
<select name="annee">
<?;
for($i=date('Y'); $i < date('Y')+2; $i++) {
	        echo '<option value='.$i.'>'.$i.'</option>';
}
?>
</select>
