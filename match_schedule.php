<?php

$schedule = array();

for($cnt=0; $cnt<7; $cnt++)
{
    $day = date('Y-m-d', strtotime("$cnt day"));
    echo $day;
    $url = "http://es.dota2.uuu9.com/Activity/calendar/?date=$day";
    $html = file_get_contents($url);

    $html = str_replace("meta charset=\"gbk\"", "meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"", $html);
    $html = iconv("gbk", "utf-8//IGNORE", $html);

    $doc=new DOMDocument();
    //libxml_use_internal_errors(False);
    $doc->strictErrorChecking = False;
    $doc->loadHTML($html);

    $tags = $doc->getElementsByTagName('ul');
    foreach ($tags as $tag)
    {
        $time = trim($tag->childNodes->item(0)->nodeValue);
        $name = trim($tag->childNodes->item(1)->nodeValue);

        $child = $tag->childNodes->item(3)->getElementsByTagName('i');
        $t1 = trim($child->item(0)->nodeValue);
        $t2 = trim($child->item(1)->nodeValue);
        echo $t1."\t".$t2."\t";

        if($t1 != "" && $t2 !="")
        {
            $v = $day.",".$time.",".$name.",3,".$t1.",".$t2;
            array_push($schedule, $v);
        }

        echo "\n";
    }
}

$handle = fopen("./schedule.php", "w+");
fwrite($handle, '<?php'.chr(10).'$schedule='.var_export ($schedule,true).';'.chr(10).'?>');
fclose($handle);

?>
