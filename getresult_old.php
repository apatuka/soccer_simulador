<?php
	$lstr=$_POST['l'];
	$vstr=$_POST['v'];

/*	$lstr=10;
	$vstr=10;*/
	$lhp=$lstr+($lstr/100)*150; // 15% bonus local
	$vhp=$vstr+($vstr/100)*150;
	$curlhp=$lhp;
	$curvhp=$vhp;
	$lgol=0;
	$vgol=0;
	$gl=array();
	$gv=array();
	/*

	1 - A
	2 - X
	3 - A
	*/
	$ipos=2;
	for($i=1;$i<=90;$i++) {
		
		$latk=$lstr/rand(1,$lstr);
		$vatk=$vstr/rand(1,$vstr);
		$curlhp-=$vatk+($i*0.1);
		$curvhp-=$latk+($i*0.1);

		/*$curlhp+=rand(0,$lstr)*0.5;
		$curvhp+=rand(0,$vstr)*0.5;*/
		if($curlhp<=0) {
			$curlhp=$lhp;
			if((rand(0,$vstr)-rand(0,$vstr))>($vstr/2)) {
				if($ipos>1) {
					$ipos--;
				} else {
					$vgol++;
					$gv[]=$i;
					$ipos=2;
				}
			}
		}
		if($curvhp<=0) {
			$curvhp=$vhp;
			if((rand(0,$lstr)-rand(0,$lstr))>($vstr/2)) {
				if($ipos<3) {
					$ipos++;
				} else {
					$lgol++;
					$gl[]=$i;
					$ipos=2;
				}
			}
		}
	}

	if($lgol>$vgol) {
		$classl="badge-success";
		$classv="badge-important";
	} elseif($vgol>$lgol) {
		$classv="badge-success";
		$classl="badge-important";
	} else {
		$classl="badge-warning";
		$classv="badge-warning";
	}
?>
 <span class="badge <?=$classl?>"><?=$lgol?></span>
 <span class="badge <?=$classv?>"><?=$vgol?></span>
 <div class="row">
 	<div class="span1">
 		<?php foreach($gl as $g): ?>
 			<?=$g?>' <br />
 		<?php endforeach; ?>
 	</div>
 	<div class="span1">
 		 <?php foreach($gv as $g): ?>
 			<?=$g?>' <br />
 		<?php endforeach; ?>
 	</div>
 </div>
