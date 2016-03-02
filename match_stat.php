<?php

include "series.php";

$match_info = array();
$match_score = array();
$regex = '/Alliance|CDEC|Digital Chaos|EHOME|Empire|Evil|Fantastic|Fantuan|Fnatic|Invictus|LGD|Liquid|Mineski|MVP|Navi|NewBee|OG Dota2|Team Secret|Team. Spirit|TongFu|Vega|Vici|Virtus|Wings/i';

$file = file("/tmp/matches_filelist") or exit("Unable to open file!");
foreach($file as $line)
{
    $filename = str_replace("\n", "", $line);
    $content = file_get_contents("/tmp/$filename");

    if(empty($content)) continue;

    echo "/tmp/$filename\n";

    $xml = simplexml_load_string($content);

    if(empty($xml->radiant_name) || empty($xml->dire_name))
        continue;
    if($xml->first_blood_time == "0" || empty($xml->first_blood_time))
        continue;

    $star_team = 0;
    if(preg_match($regex, $xml->radiant_name) || preg_match($regex, $xml->dire_name))
    {
        $star_team = 1;
    }


    if(array_key_exists("$xml->match_id",$series))
        $series_id = $series["$xml->match_id"];
    else
        continue;

    if(strcmp($xml->radiant_name,$xml->dire_name) > 0)
    {
        $key = "$xml->leagueid,$series_id,$xml->dire_name,$xml->radiant_name";
        if($xml->radiant_win == "true") $score = 1; else $score = 10;
        $match_info[$key] = "$xml->match_id,$xml->start_time,$xml->leagueid,$star_team,$xml->dire_name,$xml->radiant_name";
    }
    else
    {
        $key = "$xml->leagueid,$series_id,$xml->radiant_name,$xml->dire_name";
        if($xml->radiant_win == "true") $score = 10; else $score = 1;
        $match_info[$key] = "$xml->match_id,$xml->start_time,$xml->leagueid,$star_team,$xml->radiant_name,$xml->dire_name";
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
