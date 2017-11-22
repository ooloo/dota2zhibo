<?php
include "hot.php";
include "tier.php";

$key = "V001/?key=B1426000A46BD10C3FE0EAB36501A9E3&format=xml&language=zh";
$head = "https://api.steampowered.com/IDOTA2Match_570";

$content = file_get_contents("/tmp/GetLiveLeagueGames.xml");
if(empty($content)) exit;

//$arr = $hot;
$arr = array();

$xml = simplexml_load_string($content);

foreach($xml->games->game as $game)
{
    if($game->league_tier != 1 && $game->league_id != 0)
    {
        // rewrite GetLiveLeagueGames.xml 
        //$item = $xml->addChild('game');
        //$node = $item->addChild("league_id", $game->league_id);
        //$node = $item->addChild("radiant_teami_id", $game->radiant_team->team_id);
        //$node = $item->addChild("dire_team_id", $game->dire_team->team_id);
        //$node = $item->addChild("spectators", $game->spectators);
        //$node = $item->addChild("league_tier", $game->league_tier);
        //$node = $item->addChild("series_type", $game->series_type);
        //$node = $item->addChild("radiant_score", $game->scoreboard->radiant->score);
        //$node = $item->addChild("dire_score", $game->scoreboard->dire->score);

        // add league list
        $l = $game->league_id;
        $arr["$l"] = "$game->league_tier";
        $tier["$l"] = "$game->league_tier";

        // record all players
        foreach($game->players->player as $player)
        {
            $dbh = dba_open("account.db", "c", "db4");
            dba_replace("$player->account_id", "$player->name", $dbh);
            dba_close($dbh);
        }
    }
}

$handle = fopen("./tier.php", "w+");
fwrite($handle, '<?php'.chr(10).'$tier='.var_export ($tier,true).';'.chr(10).'?>');
fclose($handle);

echo "GetLiveLeagueGames Done, Ready to get match content.\n";

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
            if((++$show_num) >= 10) break;

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
                $content = file_get_contents("$m_url");
                $conLen = strlen($content);
                if($conLen > 12800)
                {
                    file_put_contents("$match_file", "$content");
                }
            }
        }
    }
}

?>
