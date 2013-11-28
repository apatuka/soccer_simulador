<?php
    if(!isset($_GET['id']))
        die("NO ID");
  include('db.php');
    function getResult($eq1, $eq2) {
        $goal1 = 0;
        $goal2 = 0;
        $r1 = (1 + rand(1,100));//random number to indicate form
        $r2 = (1 + rand(1,100));
        $poisson = rand(1,10000);//$poisson value to calculate number of goals
        $home = $eq1 * 1.25 * $r1;//$home team gets double advantage 15%
        $away = $eq2 * $r2;
        if($poisson < 578)
        {
            $goal1 = 0;
            $goal2 = 0;
        }
        else if($poisson >= 578 && $poisson < 2227 )
        {
            
            if($home > $away)
            {
            $goal1 = 1;
            $goal2 = 0;
            }
            else{
            $goal1 = 0;
            $goal2 = 1;
            }
        }
        else if($poisson >= 2227 && $poisson < 4576 )
        {
            
            if($home / $away >= 3)
            {
            $goal1 = 2;
            $goal2 = 0;
            }
            else if($away/$home >= 3){
            $goal1 = 0;
            $goal2 = 2;
            }
            else{
            $goal1 = 1;
            $goal2 = 1;
            }
        }
        else if($poisson >= 4576 && $poisson < 6808 )
        {
            
            if($home / $away >=5)
            {
            $goal1 = 3;
            $goal2 = 0;
            }
            else if($away/$home >= 5){
            $goal1 = 0;
            $goal2 = 3;
            }
            else if($home>$away){
            $goal1 = 2;
            $goal2 = 1;
            }
            else{
            $goal1 = 1;
            $goal2 = 2;
            }
        }
        else if($poisson >= 6808 && $poisson < 8398 )
        {
           
            if($home / $away >=7)
            {
            $goal1 = 4;
            $goal2 = 0;
            }
            else if($away/$home >= 7){
            $goal1 = 0;
            $goal2 = 4;
            }
            else if($home / $away >=5/3 && $home / $away < 7 )
            {
            $goal1 = 3;
            $goal2 = 1;
            }
            else if($away/$home >= 5/3 && $away / $home < 7){
            $goal1 = 1;
            $goal2 = 3;
            }
            else{
            $goal1 = 2;
            $goal2 = 2;
            }
        }
        else if($poisson >= 8398 && $poisson < 9304 )
        {
            
            if($home / $away >=9)
            {
            $goal1 = 5;
            $goal2 = 0;
            }
            else if($away/$home >= 9){
            $goal1 = 0;
            $goal2 = 5;
            }
            else if($home / $away >=7/3 && $home / $away < 9 )
            {
            $goal1 = 4;
            $goal2 = 1;
            }
            else if($away/$home >= 7/3 && $away / $home < 9){
            $goal1 = 1;
            $goal2 = 4;
            }
            else if($home > $away){
            $goal1 = 3;
            $goal2 = 2;
            }
            else{
            $goal1 = 2;
            $goal2 = 3;
            }
        }
        else if($poisson >= 9304 && $poisson < 9735 )
        {
            
            if($home / $away >=11)
            {
            $goal1 = 6;
            $goal2 = 0;
            }
            else if($away/$home >= 11){
            $goal1 = 0;
            $goal2 = 6;
            }
            else if($home / $away >=3 && $home / $away < 11 )
            {
            $goal1 = 5;
            $goal2 = 1;
            }
            else if($away/$home >= 3 && $away / $home < 11){
            $goal1 = 1;
            $goal2 = 5;
            }
            else if($home / $away >=1.4 && $home / $away < 3 )
            {
            $goal1 = 4;
            $goal2 = 2;
            }
            else if($away/$home >= 1.4 && $away / $home < 3){
            $goal1 = 4;
            $goal2 = 2;
            }
            else{
            $goal1 = 3;
            $goal2 = 3;
            }
        }
        else if($poisson >= 9735 && $poisson < 9800 )
        {
            
            if($home / $away >=13)
            {
            $goal1 = 7;
            $goal2 = 0;
            }
            else if($away/$home >= 13){
            $goal1 = 0;
            $goal2 = 7;
            }
            else if($home / $away >=11/3 && $home / $away < 13 )
            {
            $goal1 = 6;
            $goal2 = 1;
            }
            else if($away/$home >= 11/3 && $away / $home < 13){
            $goal1 = 1;
            $goal2 = 6;
            }
            else if($home / $away >=1.8 && $home / $away < 11/3 )
            {
            $goal1 = 5;
            $goal2 = 2;
            }
            else if($away/$home >= 1.8 && $away / $home < 11/3){
            $goal1 = 5;
            $goal2 = 2;
            }
            else if($home > $away){
            $goal1 = 4;
            $goal2 = 3;
            }
            else{
            $goal1 = 3;
            $goal2 = 4;
            }
        }
        else if($poisson >= 9801)
        {
            
            if($home / $away >=13)
            {
            $goal1 = 10;
            $goal2 = 0;
            }
            else if($away/$home >= 13){
            $goal1 = 0;
            $goal2 = 7;
            }
            else if($home / $away >=11/3 && $home / $away < 13 )
            {
            $goal1 = 0;
            $goal2 = 1;
            }
            else if($away/$home >= 11/3 && $away / $home < 13){
            $goal1 = 1;
            $goal2 = 6;
            }
            else if($home / $away >=1.8 && $home / $away < 11/3 )
            {
            $goal1 = 5;
            $goal2 = 2;
            }
            else if($away/$home >= 1.8 && $away / $home < 11/3){
            $goal1 = 5;
            $goal2 = 2;
            }
            else if($home > $away){
            $goal1 = 4;
            $goal2 = 3;
            }
            else{
            $goal1 = 3;
            $goal2 = 4;
            }
        }
        return $goal1."-".$goal2;
                //System.out.print($t1.teamName+" "+$goal1+"-"+$goal2+" "+$t2.teamName+"\n");;
    }
    $res=mysql_query("SELECT
COUNT(equipos.id) as total
FROM
torneo
Inner Join equipos ON torneo.torneo_id = equipos.torneo
WHERE
torneo.id = {$_GET['id']}");
    $num=intval(mysql_result($res, 0)/2);

    $query="SELECT
`local`.equipo as eqnloc,
visitante.equipo as eqnvis,
partidos.id,
partidos.eqloc,
partidos.eqvis,
`local`.str AS strl,
visitante.str AS strv
FROM
partidos
Inner Join equipos AS `local` ON partidos.eqloc = `local`.id
Inner Join equipos AS visitante ON partidos.eqvis = visitante.id
WHERE partidos.estado = 'pendiente' AND partidos.torneo = {$_GET['id']}
LIMIT 0,{$num}";
    $res=mysql_query($query);
    echo '<table id="tbl" class="table table-condensed table-striped table-hover" style="background: none repeat scroll 0% 0% rgb(255, 255, 255);">';
    while($row=mysql_fetch_assoc($res)) {
        echo '<tr>';
        $result=getResult($row['strl'],$row['strv']);
        $goles=explode("-",$result);
        if($goles[0]>$goles[1]) {
            $classl="badge-success";
            $classv="badge-important";
        } elseif($goles[1]>$goles[0]) {
            $classv="badge-success";
            $classl="badge-important";
        } else {
            $classl="badge-warning";
            $classv="badge-warning";
        }
        echo "<td>".$row['eqnloc']."</td> <td><span class=\"badge $classl\">".$goles[0]."</span> - <span class=\"badge $classv\">".$goles[1]."</span></td> <td>".$row['eqnvis']."</td>";
        echo '</tr>';
        mysql_query("UPDATE partidos SET gloc = {$goles[0]},gvis = {$goles[1]},estado ='jugado' WHERE id = {$row['id']}");
        if($goles[0]>$goles[1])
            vLoc($_GET['id'],$goles[0],$goles[1],$row['eqloc'],$row['eqvis']);
        elseif($goles[0]<$goles[1])
            vVis($_GET['id'],$goles[0],$goles[1],$row['eqloc'],$row['eqvis']);
        else
            emp($_GET['id'],$goles[0],$goles[1],$row['eqloc'],$row['eqvis']);
    }
    echo '</table>';
    function vLoc($id,$g1,$g2,$eq1,$eq2) {
        global $sql;
        mysql_query("UPDATE tabla SET pg=pg+1,gf=gf+$g1,gc=gc+$g2 WHERE equipo = $eq1 AND torneo = $id ");
        mysql_query("UPDATE tabla SET pp=pp+1,gf=gf+$g2,gc=gc+$g1 WHERE equipo = $eq2 AND torneo = $id ");
    }
    function vVis($id,$g1,$g2,$eq1,$eq2) {
        global $sql;
        mysql_query("UPDATE tabla SET pp=pp+1,gf=gf+$g1,gc=gc+$g2 WHERE equipo = $eq1 AND torneo = $id ");
        mysql_query("UPDATE tabla SET pg=pg+1,gf=gf+$g2,gc=gc+$g1 WHERE equipo = $eq2 AND torneo = $id ");
    }
    function emp($id,$g1,$g2,$eq1,$eq2) {
        global $sql;
        mysql_query("UPDATE tabla SET pe=pe+1,gf=gf+$g1,gc=gc+$g2 WHERE equipo = $eq1 AND torneo = $id ");
        mysql_query("UPDATE tabla SET pe=pe+1,gf=gf+$g2,gc=gc+$g1 WHERE equipo = $eq2 AND torneo = $id ");
    }

?>