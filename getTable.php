<?php
	if($_GET['año']=="null")
		die("Crear torneo");
?>
<table id="tbl" class="table table-condensed table-striped table-hover" style="background: none repeat scroll 0% 0% rgb(255, 255, 255);">
	    	<tr>
				<td>Pos</td>
				<td>Equipo</td>
				<td>PJ</td>
				<td>PG</td>
				<td>PE</td>
				<td>PP</td>
				<td>GF</td>
				<td>GC</td>
				<td>DG</td>
				<td>Pts.</td>
	    	</tr>
	    	<?php 
				include('db.php');
	    		if($_GET['id']!=0):
				$query="SELECT
				equipos.equipo,
				pais.bandera,
				tabla.pg+tabla.pe+tabla.pp as pj,
				tabla.pg,
				tabla.pe,
				tabla.pp,
				tabla.gf,
				tabla.gc,
				tabla.gf-tabla.gc as dg,
				(tabla.pg*3)+tabla.pe as pts,
				torneo_data.ascienden,
				torneo_data.descienden,
				torneo_data.cupo_libertadores,
				torneo_data.cupo_sudamericana,
				torneo_data.torneo_ascenso_id,
				torneo_data.torneo_descenso_id
				FROM
				tabla
				Inner Join equipos ON tabla.equipo = equipos.id
				Inner Join torneo ON tabla.torneo = torneo.id
				Inner Join torneo_data ON torneo.torneo_id = torneo_data.id
				INNER JOIN pais ON pais.id = equipos.pais
				WHERE tabla.torneo = {$_GET['id']}
				ORDER by pts DESC,dg DESC,gf DESC,gc ASC";
				else: 
				$query="SELECT
				equipos.equipo,
				pais.bandera,
				SUM(tabla.pg+tabla.pe+tabla.pp) as pj,
				SUM(tabla.pg) as pg,
				SUM(tabla.pe) as pe,
				SUM(tabla.pp) as pp,
				SUM(tabla.gf) as gf,
				SUM(tabla.gc) as gc,
				SUM(tabla.gf-tabla.gc) as dg,
				SUM((tabla.pg*3)+tabla.pe) as pts,
				torneo_data.ascienden,
				torneo_data.descienden,
				torneo_data.cupo_libertadores,
				torneo_data.cupo_sudamericana,
				torneo_data.torneo_ascenso_id,
				torneo_data.torneo_descenso_id
				FROM
				tabla
				Inner Join equipos ON tabla.equipo = equipos.id
				Inner Join torneo ON tabla.torneo = torneo.id
				Inner Join torneo_data ON torneo.torneo_id = torneo_data.id
				INNER JOIN pais ON pais.id = equipos.pais
				WHERE torneo.`año` = {$_GET['año']} AND	torneo.torneo_id = {$_GET['torneo_id']}
				GROUP by equipos.id
				ORDER by pts DESC,dg DESC,gf DESC,gc ASC";
				endif; 
	    		//$res=mysql_query("SELECT * FROM equipos LIMIT 0,25") or die(mysql_error());
	    		$res=mysql_query($query);
				if(mysql_num_rows($res)>0) {
		    		$ascienden=mysql_result($res,0,'ascienden');
		    		$descienden=mysql_result($res,0,'descienden');
		    		$cupo_lib=mysql_result($res,0,'cupo_libertadores');
		    		$cupo_sud=mysql_result($res,0,'cupo_sudamericana');
		    		mysql_data_seek($res, 0);
					if($ascienden==0)
						$verde=$cupo_lib;
					else
						$verde=$ascienden;

					if($cupo_sud==0)
						$amarillo=0;
					else
						$amarillo=$cupo_sud;

		    		$i=1;
		    		$todos=mysql_num_rows($res);
	    		}
	    		while($row=mysql_fetch_assoc($res)):
	    			if($i<=$verde):
	    				if($i==1):
	    		?>
	    			<tr class="success" style="font-weight:bold;">
	    		<?php else: ?>
					<tr class="success">
	    		<?php endif; ?>
	    		<?php elseif( ($amarillo>0) && ($i>$verde) && ($i<=$verde+$amarillo) ): ?>
	    			<tr class="warning">
	    		<?php elseif( ($i>$todos-$descienden) && ($i<=$todos) ): ?>
	    			<tr class="error">
	    		<?php else: ?>
		    		<tr>
				<?php endif;  ?>
						<td><?php echo $i; ?></td>
						<td><img class="ban" src="png/<?=$row['bandera']?>.png"><?=$row['equipo']?></td>
						<td><?=$row['pj']?></td>
						<td><?=$row['pg']?></td>
						<td><?=$row['pe']?></td>
						<td><?=$row['pp']?></td>
						<td><?=$row['gf']?></td>
						<td><?=$row['gc']?></td>
						<td><?=$row['dg']?></td>
						<td><?=$row['pts']?></td>
					</tr>
				<?php $i++; endwhile; ?>
				<?php if(mysql_num_rows($res)==0): ?>
				<tr class="warning">
<td colspan="5">El fixture aún no está generado</td>
<td colspan="5"><input onclick="NuevoFixture()" type="button" name="" value="Generar" class="btn btn-warning"></td>
</tr>
			<?php endif; ?>
</table>
<?php
	if(mysql_num_rows($res)>0):
		$torneo_asc = mysql_result($res, 0, 'torneo_ascenso_id');
		$torneo_dsc = mysql_result($res, 0, 'torneo_descenso_id');
		if($torneo_asc<>0) {
			$t = mysql_query("SELECT nombre FROM torneo_data WHERE id = $torneo_asc");
			$torneo_asc_str = mysql_result($t, 0);
		}
		if($torneo_dsc<>0) {
			$t = mysql_query("SELECT nombre FROM torneo_data WHERE id = $torneo_dsc");
			$torneo_dsc_str = mysql_result($t, 0);
		}

?>
<table class="table table-striped table-hover">
	<tr>
		<td colspan="2">Leyenda</td>
	</tr>
	<tr class="success">
		<td></td>
		<?php if($torneo_asc==0): ?>
		<td>Clasif. Libertadores</td>
		<?php else: ?>
		<td>Asciende (<?=$torneo_asc_str?>)</td>
		<?php endif; ?>
	</tr>
	<tr class="warning">
		<td></td>
		<td>Juega Prom. - Clasif. Sudamericana</td>
	</tr>
	<?php if($torneo_dsc<>0): ?>
	<tr class="error">
		<td></td>
		<td>Desciende (<?=$torneo_dsc_str?>)</td>
	</tr>
	<?php endif; ?>

</table>
<?php endif; ?>