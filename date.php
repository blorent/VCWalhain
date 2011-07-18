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
for($i=1950; $i < date('Y')+1; $i++) {
	        echo '<option value='.$i.'>'.$i.'</option>';
}
?>
</select>



