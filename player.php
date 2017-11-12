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
<a class="navbar-brand" href="">DOTA2 直播</a>
</div>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav">
<li><a href="http://dota2zhibo.com/index.php">Home</a></li>
<li class="active"><a href="http://dota2zhibo.com/player.php">Player</a></li>
<li><a href="http://dota2zhibo.com/heroes.php">Heroes</a></li>
<li><a href="http://dota2zhibo.com/history.php">History</a></li>
<li><a href="http://dota2zhibo.com/about.php">Updates</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>

<DIV id=m>

<?php
    include "teaminfo.php";

    echo "<br><BR><BR><div class=\"left\">";

    function show_account($k, $v)
    {
        global $teaminfo;

        echo "<div class=\"panel panel-info\">";
        echo "<div class=\"panel-heading\">$k 队员一周出场英雄TOP3</div>\n";
        echo "<ul class=\"list-group\">\n";
        echo "<li class=\"list-group-item\">\n";
        echo "<table class=\"table\">";
        echo "<tr>";
        echo "<th width=20%>Player</th>";
        echo "<th width=30%>Heroes</th>";
        echo "<th width=10%>Matches</th>";
        echo "<th width=10%>KDA</th>";
        echo "<th width=10%>Kill</th>";
        echo "<th width=10%>Death</th>";
        echo "<th width=10%>Assist</th>";
        echo "</tr>";
        foreach($v as $player => $h_arr)
        {
            $h = $h_arr["h"];
            $w = $h_arr["w"];
            $l = $h_arr["l"];
            $k = $h_arr["k"];
            $d = $h_arr["d"];
            $a = $h_arr["a"];

            $kda = ($k+$a)/$d;
            $kda = round($kda, 2);

            $wr = $w/$all * 100;
            $wr = round($wr, 0);

            echo "<tr><td>$player</td><td>";
            $heroList = split('\|', $h);
            foreach($heroList as $hero)
            {
                echo "<img src='http://cdn.dota2.com/apps/dota2/images/heroes/${hero}_sb.png'";
                echo "width='45'style='margin-right:2px'/>\n";
            }
            echo "</td>\n";

            echo "<td>$w-$l</td>";
            echo "<td>$kda</td>";
            echo "<td>$k</td>";
            echo "<td>$d</td>";
            echo "<td>$a</td>";
            echo "</tr>";
        }
        echo "</table></li></ul></div>\n";
    }

    foreach($teaminfo as $k => $v)
    {
        //if(sizeof($v) < 4 or sizeof($v) > 6) continue;
        if(sizeof($v) != 5) continue;
        show_account($k, $v);
    }

    echo "</div>\n";
    // -------------left end--------------

    include "right.php";
?>

</DIV>

</body>
</html>
