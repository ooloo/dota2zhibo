<?php
include "lea.php";
include "team.php";

$content = file_get_contents("/tmp/GetLiveLeagueGames.xml");
$xml = simplexml_load_string($content);

echo "<div class=\"panel panel-info\">";
echo "<div class=\"panel-heading\">Live Game</div>\n";
echo "<ul class=\"list-group\">\n";
echo "<li class=\"list-group-item\">\n";
echo "<table class=\"table\" style='table-layout:fixed;'>";

foreach($xml->games->game as $game)
{
    $r = $game->radiant_team->team_name;
    $d = $game->dire_team->team_name;
    $s = $game->spectators;
    $l = $game->league_id;
    $ln = $lea["$l"];

    if($ln=="") continue;

    if($game->league_tier == "0") continue;

    if(empty($r))   { $r = "天辉#noname#"; continue; }
    if(empty($d))   { $d = "夜魇#noname#"; continue; }

    $duration = $game->scoreboard->duration;

    $dur = date('i:s',floor($duration));

    $bo = 0;
    if($game->series_type == 1)
        $bo = 3;
    else if($game->series_type == 2)
        $bo = 5;
    else
        $bo = 1;

    $rscore = $game->scoreboard->radiant->score;
    $dscore = $game->scoreboard->dire->score;

    $style = "style=\"vertical-align:middle;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;\"";
    echo "<tr>";
    echo "<td width=10% $style>$dur</td>";
    echo "<td width=40% $style>$ln($game->league_tier)</td>";
    echo "<td width=10%>BO$bo</td>";
    echo "<td width=40% $style>$r ($rscore)<font color=green><b>&nbsp;.VS&nbsp;</b></font>($dscore) $d</td>";
    //echo "<td width=40%>$r <font color=green><b>&nbsp;.VS&nbsp;</b></font> $d</td>";
    echo "</tr>";
}

echo "</table>";
echo "</li></ul></div>\n";

// live end
?>
