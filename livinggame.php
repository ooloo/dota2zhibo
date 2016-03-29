<?php
include "hot.php";

$key = "V001/?key=B1426000A46BD10C3FE0EAB36501A9E3&format=xml&language=zh";
$head = "https://api.steampowered.com/IDOTA2Match_570";

$content = file_get_contents("/tmp/GetLiveLeagueGames.xml");
if(empty($content)) exit;

$arr = $hot;

$xml = simplexml_load_string($content);

foreach($xml->games->game as $game)
{
    if($game->league_tier != 1)
    {
        $l = $game->league_id;
        $arr["$l"] = 1;
    }

    // record all players
    foreach($game->players->player as $player)
    {
        $dbh = dba_open("/tmp/account.db", "c", "db4");
        dba_replace("$player->account_id", "$player->name", $dbh);
        dba_close($dbh);
    }
}

if(!empty($arr))
{
    foreach($arr as $id => $num)
    {
        $l_url = "$head/GetMatchHistory/$key&league_id=$id";

        $content = file_get_contents("$l_url");
        $conLen = strlen($content);
        echo "league_id=$id ($conLen)\n";

        if($conLen < 128)
        {
            continue;
        }

        file_put_contents("/tmp/$id.xml", "$content");

        $xml = simplexml_load_string($content);

        $show_num = 0;
        foreach($xml->matches->match as $match)
        {
            if(++$show_num >= 50) break;

            $player_list = $match->players->player;
            $player_count = $player_list->count();
            //echo "$player_count\n";
            if($player_count != 10) continue;

            $now = time();
            $mtime = "$match->start_time";
            if($now - $mtime > 86400*2) continue;

            $m_url = "$head/GetMatchDetails/$key&match_id=$match->match_id";
            $match_file = "/tmp/$match->match_id.xml";
            echo "$match_file\n";
            if(!file_exists($match_file) || filesize($match_file) < 1024)
            {
                echo "$match_file\n";
                $content = file_get_contents("$m_url");
                file_put_contents("$match_file", "$content");
            }
        }
    }
}

?>
