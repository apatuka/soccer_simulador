<?php
	include('db.php');
	$res=mysql_query("SELECT torneo.`año` FROM torneo WHERE torneo.torneo_id = {$_GET['id']} GROUP BY torneo.`año` ORDER by torneo.`año` DESC");
	while($row=mysql_fetch_assoc($res)):
?>
	<option value="<?=$row['año']?>"><?=$row['año']?></option>
<?php
	endwhile;
?>
