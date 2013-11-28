<table id="tbl" class="table table-condensed table-striped table-hover" style="background: none repeat scroll 0% 0% rgb(255, 255, 255);">
<?php
include('db.php');

function prc($i,$t,$x=0) {
	if($t>0) {
	if($x==0)
		return ($i/$t)*200;
	else
		return round(($i/$t)*100);
	}
	else
		return 0;
}

$query="SELECT
partidos.id,
`local`.equipo as eqloc,
visitante.equipo as eqvis,
partidos.gloc,
partidos.gvis,
torneo.nombre AS torneo,
torneo.`año`,
torneo_data.nombre AS torneo_data,
IF(partidos.gloc=partidos.gvis,'empate',IF(partidos.gloc>partidos.gvis,'local','visitante')) as 'cond'
FROM
partidos
INNER JOIN equipos AS `local` ON partidos.eqloc = `local`.id
INNER JOIN equipos AS visitante ON partidos.eqvis = visitante.id
INNER JOIN torneo ON torneo.id = partidos.torneo
INNER JOIN torneo_data ON torneo_data.id = torneo.torneo_id
WHERE (`local`.id = {$_POST['local']} AND visitante.id = {$_POST['visitante']} ) OR (`local`.id = {$_POST['visitante']} AND visitante.id = {$_POST['local']} ) 
ORDER BY partidos.id ASC";

$res=mysql_query($query,$sql);

$req1=mysql_query("SELECT equipo FROM equipos WHERE id = {$_POST['local']}");
$req2=mysql_query("SELECT equipo FROM equipos WHERE id = {$_POST['visitante']}");

$no1=mysql_result($req1, 0);
$no2=mysql_result($req2, 0);
$eq1=$_POST['local'];
$eq2=$_POST['visitante'];
$pg1=0;
$pg2=0;
$pe=0;
$g1=0;
$g2=0;
?>
<tr>
	<td>Torneo</td>
	<td>Año</td>
	<td>Local</td>
	<td></td>
	<td></td>
	<td>Visitante</td>
	<td>Cond</td>
</tr>
<?php
	@mysql_data_seek($res, 0);
	while($row=mysql_fetch_array($res)):
		if($row['cond'] == "local" && $row['eqloc']==$no1) {
			$pg1++;
		}
		elseif($row['cond'] == "local" && $row['eqloc']==$no2) {
			$pg2++;
		}
		elseif($row['cond'] == "visitante" && $row['eqvis']==$no1) {
			$pg1++;
		}
		elseif($row['cond'] == "visitante" && $row['eqvis']==$no2) {
			$pg2++;
		}
		else {
			$pe++;
		}

		if($row['eqloc']==$no1) {
			$g1+=$row['gloc'];
			$g2+=$row['gvis'];
		}
		if($row['eqloc']==$no2) {
			$g2+=$row['gloc'];
			$g1+=$row['gvis'];
		}

?>
<tr>
	<td><?=$row['torneo']?></td>
	<td><?=$row['año']?></td>
	<td><?=$row['eqloc']?></td>
	<td><?=$row['gloc']?></td>
	<td><?=$row['gvis']?></td>
	<td><?=$row['eqvis']?></td>
	<td><?=$row['cond']?></td>
</tr>
<?php
	endwhile;
?>
</table>
<style type="text/css">
	.lq {
		background: url("img/h2hsprite.jpg") repeat-x scroll 0 -60px rgba(0, 0, 0, 0);
	    float: right;
	    height: 20px;
	}
	.lqs {
		background: url("img/h2hsprite.jpg") no-repeat scroll -8px 0 #71C15E;
	    float: right;
	    height: 20px;
	    width: 4px;
	}
	.lqr {
		float: right;
		padding-right: 10px;
	}
	.rqs {
		background: url("img/h2hsprite.jpg") no-repeat scroll -7px -91px #73BED1;
		float: left;
		height: 27px;
		margin-top: -5px;
		width: 9px;
	}
	.rq {
		background: url("img/h2hsprite.jpg") repeat-x scroll 0 -40px rgba(0, 0, 0, 0);
	    float: left;
	    height: 20px;
	}
	.rqe {
		background: url("img/h2hsprite.jpg") no-repeat scroll 0 0 #73BED1;
	    float: left;
	    height: 20px;
	    width: 3px;
	}
	.rqr {
		float: left;
		padding-left: 10px;
	}
	.tablix_stats {
		width:500px; min-height:100px; background:#FFF; margin:0 auto;
		padding-bottom: 10px;
	}
	.tgig {
		width:240px; padding-top:5px; float:left; text-align:center;
	}
	.tchi {
		width:20px; padding-top:5px;float:left
	}
</style>
<?php
	$tg=$pg1+$pg2;
	$ga=$g1+$g2;
?>
<div class="tablix_stats">
	<div class="tgig">
		<?=$no1?>
	</div>
	<div class="tchi">VS</div>
	<div class="tgig">
		<?=$no2?>
	</div>

	<div class="tgig" title="<?=prc($pg1,$tg,1)?>%">
		<div class="lq" style="width:<?=prc($pg1,$tg)?>px"></div>
		<div class="lqs"></div>
		<div class="lqr"><?=$pg1?></div>
	</div>
	<div class="tchi">PG</div>
	<div class="tgig" title="<?=prc($pg2,$tg,1)?>%">
		<div class="rqs"></div>
		<div class="rq" style="width:<?=prc($pg2,$tg)?>px"></div>
		<div class="rqe"></div>
		<div class="rqr"><?=$pg2?></div>
	</div>

	<div class="tgig" title="<?=prc($pe,$pe,1)?>%">
		<div class="lq" style="width:<?=prc($pe,$pe)?>px"></div>
		<div class="lqs"></div>
		<div class="lqr"><?=$pe?></div>
	</div>
	<div class="tchi">PE</div>
	<div class="tgig" title="<?=prc($pe,$pe,1)?>%">
		<div class="rqs"></div>
		<div class="rq" style="width:<?=prc($pe,$pe)?>px"></div>
		<div class="rqe"></div>
		<div class="rqr"><?=$pe?></div>
	</div>

	<div class="tgig" title="<?=prc($g1,$ga,1)?>%">
		<div class="lq" style="width:<?=prc($g1,$ga)?>px"></div>
		<div class="lqs"></div>
		<div class="lqr"><?=$g1?></div>
	</div>
	<div class="tchi">GA</div>
	<div class="tgig" title="<?=prc($g2,$ga,1)?>%">
		<div class="rqs"></div>
		<div class="rq" style="width:<?=prc($g2,$ga)?>px"></div>
		<div class="rqe"></div>
		<div class="rqr"><?=$g2?></div>
	</div>

	<div style="clear:both"></div>
</div>