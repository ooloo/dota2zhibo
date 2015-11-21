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
<li class="active"><a href="http://dota2zhibo.com/index.php">Home</a></li>
<li><a href="http://dota2zhibo.com/history.php">History</a></li>
<li><a href="http://dota2zhibo.com/heroes.php">Heroes</a></li>
<li><a href="http://dota2zhibo.com/about.php">About</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>

<DIV id=m>

<?php
    echo "<br><BR><BR><div class=\"left\">";
    
    include "live.php";

    $json = file_get_contents("/tmp/schedule.json");
    $array = json_decode(substr($json, 1, -1), true); 
    $lastday = "";
    //print_r($array);
    //$gamelist = array_reverse($array['list']);
    $gamelist = $array['list'];
	foreach($gamelist as $arr)
    {
        $title = $arr['title'];
        $aside = $arr['aside'];
        $bside = $arr['bside'];
        $bo = $arr['bonum'];
        $result = $arr['pointresult'];
        $endtime = $arr['gameendtime'];

        $day = split(' ',$endtime);
        $hour = $day[1];
        $day = $day[0];

        //$curTime = time() - 86400*3;
        //if(strtotime($day) <= $curTime) continue;

        $weekarray=array("日","一","二","三","四","五","六");
        $week = "星期".$weekarray[date('w',strtotime($day))]; 

        if($result == "-" || $result == "") $result = "VS.";

        if($day != $lastday)
        {
            if($lastday != "")
            {
                echo "</table>";
                echo "</li></ul></div>\n";
            }
            echo "<div class=\"panel panel-info\">";
            echo "<div class=\"panel-heading\">$day $week</div>\n";
            echo "<ul class=\"list-group\">\n";
            echo "<li class=\"list-group-item\">\n";
            echo "<table class=\"table\">";
            $lastday = $day;
        }
        echo "<tr><td width=10%>$hour</td><td width=30%>$title</td><td width=10%>BO$bo</td>";
        echo "<td width=50%>$aside <font color=green><b>$result</b></font> $bside</td></tr>";
    }
    if($lastday != "")
    {
        echo "</table>";
        echo "</li></ul></div>\n";
    }

    echo "</div>\n";
    // -------------left end--------------

    include "right.php";
?>

</DIV>

</body>
</html>
