<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.6.2/html5shiv.js"></script>
<script src="js/respond.src.js"></script>
<![endif]-->

<meta charset="utf-8">
<link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">

<title>Dota2 直播</title>

<STYLE>
#m {
	MARGIN: 0px auto; WIDTH: 1020px
}
.left {
width: 778px;
height: auto;
position: relative;
float: left;
}

.right {
float: right;
overflow: hidden;
width: 218px;
height: auto;
padding-right: 10px;
}

.bottom { float:left; height:200px; width:1000px; text-align:center; font-size:12px;}
.container { width: 1030px;}

</STYLE>
</head>

<body>
<?php include_once("analyticstracking.php") ?>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="">DOAT2 直播</a>
</div>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav">
<li><a href="http://dota2zhibo.com/index.php">Home</a></li>
<li class="active"><a href="http://dota2zhibo.com/history.php">History</a></li>
<li><a href="http://dota2zhibo.com/heroes.php">Heroes</a></li>
<li><a href="http://dota2zhibo.com/about.php">About</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>

<DIV id=m>

<?php
    include "lea.php";
    include "hot.php";
    include "team.php";

    echo "<br><BR><BR><div class=\"left\">";

    $content = file_get_contents("/tmp/heroes.xml");
    $xml = simplexml_load_string($content);
    $show_lastmatch_num = 0;
    $heroes_arr = array();
    foreach($xml->heroes->hero as $hero)
    {
        $heroes_arr["$hero->id"] = $hero->localized_name;
    }

    function show_match($matchXmlContent)
    {
        global $lea;
        global $hot;
        global $team;
        global $heroes_arr;
        global $show_lastmatch_num;
        $xml = simplexml_load_string($matchXmlContent);

        if(!array_key_exists("$xml->leagueid", $hot))
            return;

        if($xml->first_blood_time == "0" || empty($xml->first_blood_time))
            return;

        if(empty($xml->radiant_name) || empty($xml->dire_name))
            return;

        $win_lose = "win";
        if($xml->radiant_win == "false")
        {
            $win_lose = "lose";
        }

        $ln = $lea["$xml->leagueid"];
        $d2 = date('Y-m-d H:i:s', (int)($xml->start_time));
        echo "<div class=\"panel panel-info\">";
        echo "<div class=\"panel-heading\">{$xml->radiant_name} <font color=black><b>$win_lose</b></font> {$xml->dire_name}";
        echo "&nbsp;&nbsp;&nbsp;(联赛id:$xml->leagueid,比赛id:$xml->match_id)&nbsp;&nbsp;[$d2]</div>\n";
        echo "<ul class=\"list-group\">\n";
        echo "<li class=\"list-group-item\">\n";
        echo "<table class=\"table\">";
        echo "<tr><th width=40%><font color=green>$ln</font></th>";
        echo "<th width=20%>英雄</th>";
        echo "<th width=20%>击杀/死亡/助攻</th>";
        echo "<th width=20%>每分钟金钱/经验</th></tr>";
        $dbh = dba_open("/tmp/account.db", "r", "db4");
        $odbh = dba_open("/tmp/official_account.db", "r", "db4");
        foreach($xml->players->player as $player)
        {
            echo "<tr>";
            $name = $heroes_arr["$player->hero_id"];
            $account_name = dba_fetch("$player->account_id", $odbh);
            if($account_name == "")
            {
                $account_name = dba_fetch("$player->account_id", $dbh);
            }
            if($player->player_slot < 5)
                echo "<td><font color=blue size=2>$account_name</font></td>";
            else
                echo "<td><font color=red size=2>$account_name</font></td>";
            echo "<td>$name($player->level)</td>";
            echo "<td>$player->kills/$player->deaths/$player->assists</td>";
            //echo "<td>$player->gold_spent</td>";
            echo "<td>$player->gold_per_min/$player->xp_per_min</td></tr>";
        }
        dba_close($odbh);
        dba_close($dbh);
        echo "</table></li></ul></div>\n";
        $show_lastmatch_num++;
    }

    $file = file("/tmp/history_filelist") or exit("Unable to open file!");
    foreach($file as $line)
    {
        if($show_lastmatch_num >= 15)
            break;

        $filename = str_replace("\n", "", $line);
        $content = file_get_contents("/tmp/$filename");
        show_match($content);
    }

    echo "</div>\n";
    // -------------left end--------------

    include "right.php";
?>

</DIV>

</body>
</html>
