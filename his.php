<?php

    include "lea.php";
    include "match_info.php";
    include "match_score.php";

    // ------------------------- live end -----------------------------
    $lastday = "";

	foreach($match_info as $key => $value)
    {
        $karr = explode(',', $key);
        $series_type = $karr[2];
        $bo = 1;
        if($series_type == 1)
            $bo = 3;
        else if($series_type == 2)
            $bo = 5;
        else
            $bo = 1;

        $arr = explode(',', $value);
        $matid = $arr[0];
        $stime = $arr[1];
        $leaid = $arr[2];
        $star = $arr[3];
        $aside = $arr[4];
        $bside = $arr[5];

        $ln = $lea[$leaid];
        $d1 = date('Y-m-d H:i', (int)($stime));

        $matchtime = split(' ',$d1);
        $day = $matchtime[0];
        $hour = $matchtime[1];

        $curTime = time() - 86400*30;
        if(strtotime($day) <= $curTime) continue;

        $weekarray=array("日","一","二","三","四","五","六");
        $week = "星期".$weekarray[date('w',strtotime($day))]; 

        if($result == "-" || $result == "") $result = "VS.";

        if($day != $lastday)
        {
            if($lastday != "")
            {
                echo "</table></li></ul></div>\n";
            }
            echo "<div class=\"panel panel-info\">";
            echo "<div class=\"panel-heading\">$day $week</div>\n";
            echo "<ul class=\"list-group\">\n";
            echo "<li class=\"list-group-item\">\n";
            echo "<table class=\"table\">";
            $lastday = $day;
        }
        echo "<tr>\n";
        echo "<td width=10% style=\"vertical-align:middle\">$hour</td>";
        echo "<td width=30% style=\"vertical-align:middle\">$ln($karr[1])</td>";
        echo "<td width=10% style=\"vertical-align:middle\">BO$bo</td>";

        $score = $match_score[$key];
        $r1 = floor((int)$score/10);
        $r2 = floor((int)$score%10);
        if($star == 1)
            echo "<td width=50%><b>$aside<font color=green>&nbsp;$r1:$r2&nbsp;</font>$bside</b></td>";
        else
            echo "<td width=50%>$aside<font color=green><b>&nbsp;$r1:$r2&nbsp;</b></font>$bside</td>";
        echo "</tr>\n";
    }
    echo "</table></li></ul></div>\n";

// --------- history end ----------
?>
