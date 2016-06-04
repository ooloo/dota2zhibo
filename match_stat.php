<?php

include "hot.php";

$series = array();
$match_info = array();
$match_score = array();
$regex = '/Alliance|CDEC|Digital Chaos|EHOME|Empire|Evil|Fantastic|Fantuan|Fnatic|Invictus|LGD|Liquid|Mineski|MVP|Navi|NewBee|OG Dota2|Team Secret|Team. Spirit|TongFu|Vega|Vici|Virtus|Wings/i';

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

        $series["$match->match_id"] = "$match->series_id,$match->series_type,$match->radiant_team_id,$match->dire_team_id";
    }
}

$file = file("/tmp/matches_filelist") or exit("Unable to open file!");
foreach($file as $line)
{
    $filename = str_replace("\n", "", $line);
    $content = file_get_contents("/tmp/$filename");

    if(empty($content)) continue;

    echo "/tmp/$filename\n";

    $xml = simplexml_load_string($content);

    $star_team = 0;
    //if(preg_match($regex, $xml->radiant_name) || preg_match($regex, $xml->dire_name))
    //{
    //    $star_team = 1;
    //}

    if($xml->first_blood_time == "0" || empty($xml->first_blood_time))
        continue;

    if(array_key_exists("$xml->match_id",$series))
    {
        $seriesTerm = split(',',$series["$xml->match_id"]);
        $series_id = $seriesTerm[0];
        $series_type = $seriesTerm[1];
        $radiant_team_id = $seriesTerm[2];
        $dire_team_id = $seriesTerm[3];
    }
    else
        continue;
    
    if($series_id == "0") $series_id = $xml->match_id;

    if(strcmp($radiant_team_id,$dire_team_id) > 0)
    {
        $key = "$xml->leagueid,$series_id,$series_type";
        if($xml->radiant_win == "true") $score = 1; else $score = 10;
        $match_info[$key] = "$xml->match_id,$xml->start_time,$xml->leagueid,$star_team,$dire_team_id,$radiant_team_id";
    }
    else
    {
        $key = "$xml->leagueid,$series_id,$series_type";
        if($xml->radiant_win == "true") $score = 10; else $score = 1;
        $match_info[$key] = "$xml->match_id,$xml->start_time,$xml->leagueid,$star_team,$radiant_team_id,$dire_team_id";
    }

    if(array_key_exists("$key",$match_score))
        $match_score[$key] = $match_score[$key] + $score;
    else
        $match_score[$key] = $score;
}

arsort($match_info);

$handle = fopen("./match_info.php", "w+");
fwrite($handle, '<?php'.chr(10).'$match_info='.var_export ($match_info,true).';'.chr(10).'?>');
fclose($handle);

$handle = fopen("./match_score.php", "w+");
fwrite($handle, '<?php'.chr(10).'$match_score='.var_export ($match_score,true).';'.chr(10).'?>');
fclose($handle);

?>
