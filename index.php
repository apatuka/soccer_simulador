<?php
	include('db.php');
?>
<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>MM</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<style type="text/css">
			body,html {
				background: url("grey_wash_wall.png") repeat;
			}
			.span1 {
				text-align: center;
			}
			.ranking {
				/*overflow-y:scroll;
				overflow-x:hidden;*/
				/*height:200px;*/
				width: 600px; margin: 0px auto;
			}
			#torneo {
				width:220px;
				margin:0 auto;
			}
			.ban {
				margin-top:-3px;
				padding-right: 5px;
			}
			.btn {
				display: block;
			}
			/*#selTorneo {
				float: left;
				display:block;
			}*/
		</style>
		<script type="text/javascript">
			var xl=1;

			$(document).ready(function() {
				/*$("#selAnho").load('selAnho.php?id='+$("#selTorneoData").val(),function() {
					$("#selTorneo").load('selTorneo.php?id='+$("#selTorneoData").val()+'&año='+$("#selAnho").val());	
				});*/
				//$(".ranking").load('getTable.php?id='+$("#selTorneo").val());
				cambiaTD();
				
				$("img.flag").click(function() {
					var str = $(this).attr('str');
					if(xl==1) {
						$("#local").val(str);
						xl=2;
					} else {
						$("#visit").val(str);
						xl=1;					
					}

				});
			});
			function NuevoTorneo() {
				var prompt = window.prompt("Ingrese año: ","2013");
				$.ajax({
					url: 'nvoTorneo.php',
					type: 'POST',
					data: {id: $("#selTorneoData").val(), año: prompt},
				})
				.done(function() {
					cambiaTD();
				})
				
			}
			function NuevoFixture() {
				$.ajax({
					url: 'genMatch.php',
					type: 'POST',
					data: {id: $("#selTorneo").val() },
				})
				.done(function() {
					//window.location = 'index.php';
					cambiaT();
				})
				
			}
			function matchGen() {
				/*var l = $("#local").val();
				var v = $("#visit").val();*/
				$.ajax({
					url: 'getResult.php',
					type: 'get',
					data: {id:$("#selTorneo").val()},
					success: function (data) {
						$("#marker").html(data);
						getRanking();
					}
				});
				return false;
			}
			function getRanking() {
				$(".ranking").load('getTable.php?id='+$("#selTorneo").val()+'&año='+$("#selAnho").val()+'&torneo_id='+$("#selTorneoData").val());
			}
			function cambiaTD() {
				$("#selAnho").load('selAnho.php?id='+$("#selTorneoData").val(),function() {
					$("#selTorneo").load('selTorneo.php?id='+$("#selTorneoData").val()+'&año='+$("#selAnho").val(), function() {
						cambiaT();
					});
				});
			}
			function cambiaA() {
				$("#selTorneo").load('selTorneo.php?id='+$("#selTorneoData").val()+'&año='+$("#selAnho").val(), function() {
					cambiaT();
				});

			}
			function cambiaT() {
				//$(".ranking").load('getTable.php?id='+$("#selTorneo").val());
				getRanking();
			}
		</script>
	</head>
	<body>
		<div id="torneo">
		<select onchange="cambiaTD()" id="selTorneoData">
			<?php
				$res=mysql_query("SELECT torneo_data.id, torneo_data.nombre, pais.pais FROM torneo_data
  Inner Join pais ON torneo_data.pais = pais.id") or die(mysql_error());
				while($row=mysql_fetch_assoc($res)):
			?>
				<option value="<?=$row['id']?>"><?=$row['nombre']?> (<?=$row['pais']?>)</option>
			<?php
				endwhile;
			?>
		</select>
		<select onchange="cambiaA()" id="selAnho">

		</select>
		<select onchange="cambiaT()" id="selTorneo">
			
		</select>
		<input onclick="NuevoTorneo()" type="button" name="" value="Nuevo" class="btn btn-primary" style="height:30px; width:220px">
		</div>
		<br />
		<div class="ranking">
		</div>
		<div style="margin:0 auto; width: 450px; margin-top:20px">
			<div style="margin:0 auto; width: 124px;">
				<!--img class="flag" str="10" src="png/ar.png">
				<img class="flag" str="5" src="png/bo.png">
				<img class="flag" str="10" src="png/br.png">
				<img class="flag" str="7" src="png/co.png" title="Colombia">
				<img class="flag" str="8" src="png/cl.png" >
				<img class="flag" str="7" src="png/ec.png" title="Ecuador">
				<img class="flag" str="7" src="png/py.png">
				<img class="flag" str="6" src="png/pe.png">
				<img class="flag" str="8" src="png/uy.png">
				<img class="flag" str="6" src="png/ve.png"!-->
				<br />
				<!--input type="text" id="local" class="span1" name="" value="" placeholder="LOCAL">
				<input type="text" id="visit" class="span1" name="" value="" placeholder="VISIT"><br /!-->
				<a href="#" onclick="return matchGen()" class="btn btn-primary">A Jugar !</a>
				<a data-toggle="modal" href="head2head.php" class="btn btn-primary" data-target="#myModal">Cara a Cara</a>
			</div>
			<br / ><br / >
			<p class="text-center" id="marker">
			 <!--span class="badge badge-default">0</span> 
			 <span class="badge badge-default">0</span!-->
			</p>
		</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Cara a Cara</h4>

            </div>
            <div class="modal-body"><div class="te"></div></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

	</body>
</html>