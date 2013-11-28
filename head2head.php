<?php
	include('db.php');
?>

		<style type="text/css">
			body,html {
				background: url("grey_wash_wall.png") repeat;
			}
			#h2h {
				width: 444px;
				margin:0 auto;
			}
			#ajax {
				width: 500px;
				margin:0 auto;
			}
			.btn {
				display: block;
				margin:0 auto;
			}
			.table td.text-center {
			   text-align: center;   
			}
		</style>
		<script type="text/javascript">
			function h2h() {
				$.ajax({
					url: 'h2h.php',
					type: 'post',
					data: {local:$("#local").val(),visitante:$("#visitante").val()},
					success: function (data) {
						$("#ajax").html(data);
					}
				});
			}
		</script>
	</head>
	<body>
		<div id="h2h">
			<select id="local">
				<?php 
					$res=mysql_query("SELECT * FROM equipos");
					while($row=mysql_fetch_array($res)):
				?>
					<option value="<?=$row['id']?>"><?=$row['equipo']?></option>
				<?php
					endwhile;
				?>
			</select>
			<select id="visitante">
				<?php 
					$res=mysql_query("SELECT * FROM equipos");
					while($row=mysql_fetch_array($res)):
				?>
					<option value="<?=$row['id']?>"><?=$row['equipo']?></option>
				<?php
					endwhile;
				?>
			</select><br />
			<input type="button" onclick="h2h();" class="btn btn-primary" value="VS">
		</div>
		<div id="ajax">

		</div>