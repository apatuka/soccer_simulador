<?php
/*$sql=mysql_pconnect("localhost","root","");
mysql_select_db("fixt");
*/
include('db.php');
if(!isset($_POST['id']))
    die("NO ID");
else
    $id=$_POST['id'];

function main() {
    ?>
    <style>
    input, textarea { display: block; margin-bottom: 1em; }
    label { font-weight: bold; display: block; }
    </style>
    <h1>Fixtures Generator</h1>
    <p>This page is part of <a
    href="http://bluebones.net/2005/05/league-fixtures-generator/">bluebones.net</a>.</p>
    <?php
    // Find out how many teams we want fixtures for.
    if (! isset($_GET['teams']) && ! isset($_GET['names'])) {
        print get_form(); 
    } else {
        # XXX check for int
        print show_fixtures(isset($_GET['teams']) ?  nums(intval($_GET['teams'])) : explode("\n", trim($_GET['names'])));
    }
}

function nums($n) {
    $ns = array();
    for ($i = 1; $i <= $n; $i++) {
        $ns[] = $i;
    }
    return $ns;
}

function show_fixtures($names,$id) { 
    global $sql;
    //$fecha = strtotime("21-11-2013");
    //echo "<pre>$fecha</pre>";
    $teams = sizeof($names);

    print "<p>Fixtures for $teams teams.</p>";

    // If odd number of teams add a "ghost".
    $ghost = false;
    if ($teams % 2 == 1) {
        $teams++;
        $ghost = true;
    }
    
    // Generate the fixtures using the cyclic algorithm.
    $totalRounds = $teams - 1;
    $matchesPerRound = $teams / 2;
    $rounds = array();
    for ($i = 0; $i < $totalRounds; $i++) {
        $rounds[$i] = array();
    }
   
    for ($round = 0; $round < $totalRounds; $round++) {
        for ($match = 0; $match < $matchesPerRound; $match++) {
            $home = ($round + $match) % ($teams - 1);
            $away = ($teams - 1 - $match + $round) % ($teams - 1);
            // Last team stays in the same place while the others
            // rotate around it.
            if ($match == 0) {
                $away = $teams - 1;
            }
            $rounds[$round][$match] = team_name($home + 1, $names) 
                . "-" . team_name($away + 1, $names);
        }
    }

    // Interleave so that home and away games are fairly evenly dispersed.
    $interleaved = array();
    for ($i = 0; $i < $totalRounds; $i++) {
        $interleaved[$i] = array();
    }
    
    $evn = 0;
    $odd = ($teams / 2);
    for ($i = 0; $i < sizeof($rounds); $i++) {
        if ($i % 2 == 0) {
            $interleaved[$i] = $rounds[$evn++];
        } else {
            $interleaved[$i] = $rounds[$odd++];
        }
    }

    $rounds = $interleaved;

    // Last team can't be away for every game so flip them
    // to home on odd rounds.
    for ($round = 0; $round < sizeof($rounds); $round++) {
        if ($round % 2 == 1) {
            $rounds[$round][0] = flip($rounds[$round][0]);
        }
    }
    
    // Display the fixtures        
    for ($i = 0; $i < sizeof($rounds); $i++) {

        //$fecha=mktime(0,0,0,date("n",strtotime($fecha)),date("j",$fecha)+7,date("Y",$fecha));
        //$fecha = date("d-m-Y",strtotime("+7 days", $fecha));
        //print "<p>Round " . ($i + 1) . " <pre>$fecha</pre></p>\n";

        foreach ($rounds[$i] as $r) {
            $eqs=explode("-",$r);
            echo $eqs[0]." v ".$eqs[1]."<br />";
            mysql_query("INSERT INTO partidos (torneo,eqloc,eqvis,estado) VALUES($id,{$eqs[0]},{$eqs[1]},'pendiente')");
        }
        print "<br />";
    }
    print "<p>Second half is mirror of first half</p>";
    $round_counter = sizeof($rounds) + 1;
    for ($i = sizeof($rounds) - 1; $i >= 0; $i--) {
        print "<p>Round " . $round_counter . "</p>\n";
        $round_counter += 1;
        foreach ($rounds[$i] as $r) {
            //print flip($r) . "<br />";
            $eqs=explode("-",flip($r));
            echo $eqs[0]." v ".$eqs[1]."<br />";
            mysql_query("INSERT INTO partidos (torneo,eqloc,eqvis,estado) VALUES($id,{$eqs[0]},{$eqs[1]},'pendiente')");
        }
        print "<br />";
    }
    print "<br />";

    if ($ghost) {
        print "Matches against team " . $teams . " are byes.";
    }
}

function flip($match) {
    $components = explode('-', $match);
    return $components[1] . "-" . $components[0];
}

function team_name($num, $names) {
    $i = $num - 1;
    if (sizeof($names) > $i && strlen(trim($names[$i])) > 0) {
        return trim($names[$i]);
    } else {
        return $num;
    }
}

function get_form() {
    $s = '';
    $s = '<p>Enter number of teams OR team names</p>' . "\n";
    $s .= '<form action="' . $_SERVER['SCRIPT_NAME'] . '">' . "\n";
    $s .= '<label for="teams">Number of Teams</label><input type="text" name="teams" />' . "\n";
    $s .= '<input type="submit" value="Generate Fixtures" />' . "\n";
    $s .= '</form>' . "\n";

    $s .= '<form action="' . $_SERVER['SCRIPT_NAME'] . '">' . "\n";
    $s .= '<div><strong>OR</strong></div>' . "\n";
    $s .= '<label for="names">Names of Teams (one per line)</label>'
        . '<textarea name="names" rows="8" cols="40"></textarea>' . "\n";
    $s .= '<input type="submit" value="Generate Fixtures" />' . "\n";
    $s .= "</form>\n";
    return $s;
}

//main();

//$array=array("Olimpia","Cerro","Nacional","Libertad");
//print show_fixtures($array);
?>

<?php

function getWeek($home, $away, $num_teams) {
    if($home == $away){
        return -1;
    }
    $week = $home+$away-2;
    if($week >= $num_teams){
        $week = $week-$num_teams+1;
    }
    if($home>$away){
        $week += $num_teams-1;
    }

    return $week;
}
$res=mysql_query("SELECT * FROM equipos WHERE equipos.torneo = (SELECT torneo.torneo_id FROM torneo WHERE torneo.id = $id)");
while($row=mysql_fetch_assoc($res)) {
    $teams[]=$row['id'];
    mysql_query("INSERT INTO tabla (torneo,equipo) VALUES ($id,{$row['id']})");
}
shuffle($teams);
//echo show_fixtures($teams);
show_fixtures($teams,$id);
$teams = count($teams);
$games = array();   //2D array tracking which week teams will be playing

// do the work
for( $i=1; $i<=$teams; $i++ ) {
    $games[$i] = array();
    for( $j=1; $j<=$teams; $j++ ) {
        $games[$i][$j] = getweek($i, $j, $teams);
    }
}

// display
/*echo '<pre>';
$max=0;
foreach($games as $row) {
    foreach($row as $col) {
        printf('%4d', is_null($col) ? -2 : $col);
        if( $col > $max ) { $max=$col; }
    }
    echo "\n";
}
printf("%d teams in %d weeks, %.2f weeks per team\n", $teams, $max, $max/$teams);
echo '</pre>';*/