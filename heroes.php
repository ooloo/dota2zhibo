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

.container { width: 1030px;}
.bottom { float:left; height:200px; width:1000px; text-align:center; font-size:12px;}

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
<li><a href="http://dota2zhibo.com/player.php">Player</a></li>
<li class="active"><a href="http://dota2zhibo.com/heroes.php">Heroes</a></li>
<li><a href="http://dota2zhibo.com/history.php">History</a></li>
<li><a href="http://dota2zhibo.com/about.php">Updates</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>

<DIV id=m>
<DIV id=fm>
</DIV>

<?php
    include "count.php";
    include "stat.php";
    include "hot.php";
    include "items_img.php";
    include "items_cost.php";

    echo "<br><BR><BR><div class=\"left\">";

    echo "<div class=\"panel panel-info\">";
    echo "<div class=\"panel-heading\">最近一周职业联赛热门英雄TOP30</div>\n";
    echo "<ul class=\"list-group\">\n";
    echo "<li class=\"list-group-item\">\n";
    echo "<table class=\"table\">";
    echo "<tr><th width=12%>Heroes</th><th width=12%>Matches</th><th width=12%>Winrate</th>";
    echo "<th width=12%>KDA</th><th width=50%>一周热门装备</th></tr>";

    $show_hero_num = 0;
    foreach($count as $hero => $summary)
    {
        if($show_hero_num++ >= 30)
            break;

        $picknum = $summary["all"];
        $w = $summary["w"];
        $l = $summary["l"];
        $k = $summary["k"];
        $d = $summary["d"];
        $a = $summary["a"];

        $wr = $w/$picknum * 100;
        $wr = round($wr, 0);

        $kda = ($k+$a)/$d;
        $kda = round($kda, 2);

        $show_num = 0;
        $item_num = "";
        $item_arr = $stat["$hero"];
        echo "<tr><td>";
        echo "<img src='http://cdn.dota2.com/apps/dota2/images/heroes/${hero}_sb.png'";
        echo " width='59' /></td>\n";
        echo "<td>$picknum-$w</td>";
        echo "<td>$wr%</td>";
        echo "<td>$kda</td>";
        echo "<td>";
        foreach($item_arr as $itemid => $usenum)
        {
            if($show_num >= 6)
                break;
            $img = $items_img["$itemid"];
            $pr = $items_cost["$itemid"];
            if(!empty($img) && !empty($pr) && $pr > 875)
            {
                //echo "<img src='http://media.steampowered.com/apps/dota2/images/items/{$t}_lg.png' ";
                echo "<img src='http://cdn.dota2.com/apps/dota2/images/items/{$img}' ";
                echo "width='45'style='margin-right:2px'/> \n";
                if($item_num == "")
                    $item_num = "$usenum";
                else
                    $item_num = "$item_num/$usenum";
                $show_num++;
            }
        }
        //echo "</td><td>$item_num</td></tr>";
        echo "</td></tr>";
    }
    echo "</table>";
    echo "</li></ul></div>\n";

    echo "</div>\n";
    // -------------left end--------------

    include "right.php";
?>

</DIV>

</body>
</html>
