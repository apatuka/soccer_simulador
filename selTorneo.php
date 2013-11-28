<?php
	include('db.php');
	$res=mysql_query("SELECT * FROM torneo WHERE torneo_id = {$_GET['id']} AND año = {$_GET['año']} ORDER by año DESC");
	while($row=mysql_fetch_assoc($res)):
?>
	<option value="<?=$row['id']?>"><?=$row['nombre']?> (<?=$row['año']?>)</option>
<?php
	endwhile;
?>
	<option value="0">Acumulativo</option>
