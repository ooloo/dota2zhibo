<?php

include "hot.php";

$team = array(
        1075534 => 'Orange Esports Dota',
        2640099 => 'Shazam',
        2759317 => 'Elements',
        2701329 => 'Freedom',
        2217730 => 'Kingdom',
        2537636 => 'Elements',
        2538753 => 'F5',
        55 => 'PR',
        59 => 'KP',
        2685608 => 'TP',
        2746885 => 'Wings.R',
        1421914 => 'Zenith',
        2822317 => 'T.0.T',
        2414475 => 'Way',
        2755844 => 'MC',
        111474 => 'Alliance',
        350190 => 'Fnatic',
        39 => 'EG',
        1148284 => 'MVP',
        543897 => 'Mski',
        2777247 => 'VG.R',
        2163 => 'Liquid',
        15 => 'LGD',
        2512249 => 'DC',
        1836806 => 'Wings',
        1838315 => 'Secret',
        2586976 => 'OG',
        46 => 'Empire',
        3 => 'coL',
        36 => 'Na`Vi',
        1375614 => 'Newbee',
        2642171 => 'AF',
        2783913 => 'DiG',
        2108395 => 'TNC',
        4 => 'EHOME',
        2789395 => 'Taring',
        2635099 => 'CDEC.Y',
        2677025 => 'FDL',
        2006913 => 'Vega',
        2621843 => 'TSpirit',
        2764871 => 'CNB',
        2767921 => 'Rave',
        1276785 => 'Mongolz',
        24 => 'SiG',
        2644737 => 'NG',
        2662139 => 'Mski-X',
        2659468 => 'WG.Unity',
        795543 => 'Arcanys',
        32150 => 'Gse7en',
        2413217 => 'SGR',
        2100450 => 'Awake.R',
        2201839 => 'MVP',
        2672298 => 'Infamous',
        1883502 => 'VP',
        1520578 => 'CDEC',
        2538621 => 'FTD.A',
        1951061 => 'Newbee.Y',
        2626685 => 'EHOME.K',
        2524644 => 'TRG',
        2208748 => 'DuoBao',
        2600130 => 'HTML',
        20 => 'TongFu',
        2789129 => 'Bheart.Z',
        2640025 => 'iG.V',
        5 => 'iG',
        2643401 => 'CDEC.A',
        2414095 => 'Avalon',
        2539098 => 'FTD.B',
        2634810 => 'EHOME.L',
        1983234 => 'Bheart',
        2523807 => 'Immortal',
        );

$official_team = array();

$key = "v1/?key=B1426000A46BD10C3FE0EAB36501A9E3&format=xml&language=zh&teams_requested=200";
$head = "https://api.steampowered.com/IDOTA2Match_570/GetTeamInfoByTeamID";

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

        $teamurl = "$head/$key&start_at_team_id=$match->radiant_team_id";
        $official_team["$match->radiant_team_id"] = "$teamurl";

        $teamurl = "$head/$key&start_at_team_id=$match->dire_team_id";
        $official_team["$match->dire_team_id"] = "$teamurl";
    }
}

foreach($official_team as $teamid => $teamurl)
{
    echo "$teamurl\n";
    $content = file_get_contents("$teamurl");

    if(strlen("$content") < 1024) continue;

    $xml = simplexml_load_string($content);

    foreach($xml->teams->team as $t)
    {
        $tag = $t->tag;

        if(!empty($tag))
        {
            $dbh = dba_open("official_team.db", "c", "db4");
            dba_replace("$teamid", "$tag", $dbh);
            dba_close($dbh);

            $team["$teamid"] = "$tag";
            echo "$teamid $tag\n";
        }
    }
}

$handle = fopen("./team.php", "w+");
fwrite($handle, '<?php'.chr(10).'$team='.var_export ($team,true).';'.chr(10).'?>');
fclose($handle);

?>
