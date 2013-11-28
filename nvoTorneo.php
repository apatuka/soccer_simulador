<?php
	include('db.php');
	$res=mysql_query("SELECT * FROM torneo_temporada WHERE torneo_id = {$_POST['id']} ORDER by temporada DESC");
	while($row=mysql_fetch_assoc($res)) {
		mysql_query("INSERT INTO torneo (nombre,año,torneo_id) VALUES ('{$row['torneo']}',{$_POST['año']},{$_POST['id']})");	
	}
	echo "OK";
?>