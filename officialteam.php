<?php

include "hot.php";

$official_team = array();

$key = "v1/?key=B1426000A46BD10C3FE0EAB36501A9E3&format=xml&language=zh";
$head = "https://api.steampowered.com/IDOTA2Teams_570/GetTeamInfo";

foreach($hot as $id => $num)
{
    $content = file_get_contents("/tmp/$id.xml");
    echo "/tmp/$id.xml\n";

    $xml = simplexml_load_string($content);

    $show_num = 0;
    foreach($xml->matches->match as $match)
    {
        if(++$show_num >= 100) break;

        if($match->radiant_team_id == "0" || $match->dire_team_id == "0")
            continue;

        $teamurl = "$head/$key&team_id=$match->radiant_team_id";
        $official_team["$match->radiant_team_id"] = "$teamurl";

        $teamurl = "$head/$key&team_id=$match->dire_team_id";
        $official_team["$match->dire_team_id"] = "$teamurl";
    }
}

foreach($official_team as $teamid => $teamurl)
{
    $content = file_get_contents("$teamurl");

    $xml = simplexml_load_string($content);
    $tag =$xml->teams->message->tag;

    if(!empty($tag))
    {
        $dbh = dba_open("/tmp/official_team.db", "c", "db4");
        dba_replace("$teamid", "$tag", $dbh);
        dba_close($dbh);
        echo "$teamid $tag\n";
    }
}

?>
