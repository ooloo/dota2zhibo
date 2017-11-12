<?php
include "lea.php";
include "team.php";

$content = file_get_contents("GetLiveLeagueGames.xml");
$xml = simplexml_load_string($content);

$weekarray=array("日","一","二","三","四","五","六");

echo "<div class=\"panel panel-info\">";
echo "<div class=\"panel-heading\">Live Game</div>\n";
echo "<ul class=\"list-group\">\n";
echo "<li class=\"list-group-item\">\n";
echo "<table class=\"table\" style='table-layout:fixed;'>";

foreach($xml->games->game as $game)
{
    $r = $game->radiant_team->team_id;
    $d = $game->dire_team->team_id;
    $r = $team["$r"];
    $d = $team["$d"];
    $s = $game->spectators;
    $l = $game->league_id;
    $ln = $lea["$l"];

    if($ln=="") continue;

    if($game->league_tier == "1") continue;
    if($s > 1000)
    {
        $s = $s/1000;
        $s = floor($s)."k";
    }

    if(empty($r))   { $r = "天辉#noname#"; continue; }
    if(empty($d))   { $d = "夜魇#noname#"; continue; }

    $dbh = dba_open("living.db", "c", "db4");
    $starttime = dba_fetch("$game->lobby_id", $dbh);
    if(empty($starttime))
    {
        $starttime = time();
        dba_replace($game->lobby_id, $starttime, $dbh);
    }
    dba_close($dbh);
    $tmpDay = date('Y-m-d H:i', (int)($starttime));

    $tmpDay = split(' ',$tmpDay);
    $day = $tmpDay[0];
    $hour = $tmpDay[1]; 

    $week = "星期".$weekarray[date('w',strtotime($day))]; 

    $bo = 0;
    if($game->series_type == 1)
        $bo = 3;
    else if($game->series_type == 2)
        $bo = 5;
    else
        $bo = 1;

    $rscore = $game->scoreboard->radiant->score;
    $dscore = $game->scoreboard->dire->score;

    echo "<tr>";
    echo "<td width=10%>$hour</td>";
    echo "<td width=40% style=\"vertical-align:middle;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;\">$ln($game->league_tier)</td>";
    echo "<td width=10%>BO$bo</td>";
    echo "<td width=40%>$r ($rscore)<font color=green><b>&nbsp;.VS&nbsp;</b></font>($dscore) $d</td>";
    //echo "<td width=40%>$r <font color=green><b>&nbsp;.VS&nbsp;</b></font> $d</td>";
    echo "</tr>";
}

echo "</table>";
echo "</li></ul></div>\n";

// live end
?>
