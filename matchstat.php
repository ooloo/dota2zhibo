<?php
$content = file_get_contents("/tmp/heroes.xml");
$xml = simplexml_load_string($content);
$heroes_arr = array("0" => "NULL");
$len = strlen("npc_dota_hero_");
foreach($xml->heroes->hero as $hero)
{
    $heroes_arr["$hero->id"] = substr($hero->name, $len);
}
$stat = array();
$count = array();
$lea = array();
$hot = array();
$kda = array();

//$regex = '/Alliance|CDEC|Digital Chaos|EHOME|Empire|Evil|Fantastic|Fantuan|Fnatic|Invictus|LGD|Liquid|Mineski|MVP|Navi|NewBee|OG Dota2|Team Secret|Team. Spirit|TongFu|Vega|Vici|Virtus|Wings/i';
$regex = '/^Alliance|^CDEC|^dc|^EHOME|^Empire|^EG|^Fnatic|^IG|^LGD|^Liquid|^Mski|^MVP|^Navi|^NewBee|^OG|^Secret|^TongFu|^Vega|^VG|^Wings|^TSpirit/i';

$file = file("/tmp/matches_filelist") or exit("Unable to open file!");
foreach($file as $line)
{
    $filename = str_replace("\n", "", $line);
    $content = file_get_contents("/tmp/$filename");

    if(empty($content)) continue;

    echo "/tmp/$filename\n";

    $xml = simplexml_load_string($content);

    //if(empty($xml->radiant_name) || empty($xml->dire_name))
      //  continue;
    if($xml->first_blood_time == "0" || empty($xml->first_blood_time))
        continue;
    if($xml->human_players != "10")
        continue;


    array_push($hot, "$xml->leagueid");

    //history
    $odbh = dba_open("/tmp/official_account.db", "r", "db4");
    foreach($xml->players->player as $player)
    {
        $key = dba_fetch("$player->account_id", $odbh);
        if($key == "") continue;
        if(!preg_match($regex, $key)) continue;

        $name = $heroes_arr["$player->hero_id"];

        if(!isset($kda["$key"]))
            $kda["$key"] = array();

        if(!isset($kda["$key"]["$name"]))
            $kda["$key"]["$name"] = array(
                    "all" => 0,
                    "w" => 0,
                    "l" => 0,
                    "k" => 0,
                    "d" => 0,
                    "a" => 0,
                    );

        $kda["$key"]["$name"]["all"] = ++$kda["$key"]["$name"]["all"];

        $player_slot = "$player->player_slot";
        if(($player_slot < 10 && $xml->radiant_win == "true")
                || ($player_slot > 120 && $xml->radiant_win == "false"))
            $kda["$key"]["$name"]["w"] = ++$kda["$key"]["$name"]["w"];
        else
            $kda["$key"]["$name"]["l"] = ++$kda["$key"]["$name"]["l"];

        $kda["$key"]["$name"]["k"] = $kda["$key"]["$name"]["k"] + $player->kills;
        $kda["$key"]["$name"]["d"] = $kda["$key"]["$name"]["d"] + $player->deaths;
        $kda["$key"]["$name"]["a"] = $kda["$key"]["$name"]["a"] + $player->assists;
        arsort($kda["$key"]);
    }
    dba_close($odbh);

    // heroes
    foreach($xml->players->player as $player)
    {
        $name = $heroes_arr["$player->hero_id"];
        if(!isset($stat["$name"]))
            $stat["$name"] = array();
        $arr = array(
                "$player->item_0",
                "$player->item_1",
                "$player->item_2",
                "$player->item_3",
                "$player->item_4",
                "$player->item_5"
                );
        foreach($arr as $item)
        {
            if($item != "0")
            {
                if(!isset($stat["$name"]["$item"]))
                    $stat["$name"]["$item"] = 1;
                else
                    $stat["$name"]["$item"] = ++$stat["$name"]["$item"];
            }
        }
        arsort($stat["$name"]);

        if(!isset($count["$name"]))
            $count["$name"] = array(
                    "all" => 0,
                    "w" => 0,
                    "l" => 0,
                    "k" => 0,
                    "d" => 0,
                    "a" => 0,
                    );
        $count["$name"]["all"] = ++$count["$name"]["all"];

        $player_slot = "$player->player_slot";
        if(($player_slot < 10 && $xml->radiant_win == "true")
                || ($player_slot > 120 && $xml->radiant_win == "false"))
            $count["$name"]["w"] = ++$count["$name"]["w"];
        else
            $count["$name"]["l"] = ++$count["$name"]["l"];

        $count["$name"]["k"] = $count["$name"]["k"] + $player->kills;
        $count["$name"]["d"] = $count["$name"]["d"] + $player->deaths;
        $count["$name"]["a"] = $count["$name"]["a"] + $player->assists;
    }
}

$content = file_get_contents("/tmp/GetLeagueListing.xml");
$xml = simplexml_load_string($content);
$leagues = $xml->leagues[0];

foreach($leagues as $league)
{
    $l = "$league->leagueid";
    $name = "$league->name";
    $lea["$l"] =  "$name";
}

arsort($count);

foreach($kda as $k => $v)
{
    $all = 0;
    foreach($v as $hero => $h_arr)
    {
        $all = $all + $h_arr["all"];
    }

    if($all < 1)
        unset($kda[$k]);
    else
        $kda[$k] = array_splice($v, 0, 5);
}

ksort($kda);

$handle = fopen("./stat.php", "w+");
fwrite($handle, '<?php'.chr(10).'$stat='.var_export ($stat,true).';'.chr(10).'?>');
fclose($handle);

$handle = fopen("./count.php", "w+");
fwrite($handle, '<?php'.chr(10).'$count='.var_export ($count,true).';'.chr(10).'?>');
fclose($handle);

$handle = fopen("./hot.php", "w+");
fwrite($handle, '<?php'.chr(10).'$hot='.var_export (array_count_values($hot),true).';'.chr(10).'?>');
fclose($handle);

$handle = fopen("./lea.php", "w+");
fwrite($handle, '<?php'.chr(10).'$lea='.var_export ($lea,true).';'.chr(10).'?>');
fclose($handle);

$handle = fopen("./kda.php", "w+");
fwrite($handle, '<?php'.chr(10).'$kda='.var_export ($kda,true).';'.chr(10).'?>');
fclose($handle);

?>
