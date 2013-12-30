<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Dota2直播</title>
<STYLE>HTML {
	OVERFLOW-Y: auto
}
P {
	PADDING-BOTTOM: 0px; LIST-STYLE-TYPE: none; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; LIST-STYLE-IMAGE: none; PADDING-TOP: 0px
}
FORM {
	PADDING-BOTTOM: 0px; LIST-STYLE-TYPE: none; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; LIST-STYLE-IMAGE: none; PADDING-TOP: 5px
}
UL {
	PADDING-BOTTOM: 0px; LIST-STYLE-TYPE: none; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; LIST-STYLE-IMAGE: none; PADDING-TOP: 0px
}
LI {
	PADDING-BOTTOM: 0px; LIST-STYLE-TYPE: none; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; LIST-STYLE-IMAGE: none; PADDING-TOP: 0px
}
FORM {
	POSITION: relative
}
#fm {
	width: 1000px;
	margin: 0 auto;
	margin-bottom: 10px;
	position: relative;
}
TABLE {     
	BORDER-RIGHT-WIDTH: 0px; BORDER-TOP-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px
}       
IMG {   
	BORDER-RIGHT-WIDTH: 0px; BORDER-TOP-WIDTH: 0px; BORDER-BOTTOM-WIDTH: 0px; BORDER-LEFT-WIDTH: 0px
}           
TD {            
	LINE-HEIGHT: 18px; FONT-SIZE: 9pt
} 
A {
	COLOR: #00c
}
A:active {
	COLOR: #f60
}
#lh {
	MARGIN: 16px 0px 5px; WORD-SPACING: 3px
}
#u {
	TEXT-ALIGN: right; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; PADDING-RIGHT: 10px; PADDING-TOP: 6px
}
#m {
	MARGIN: 0px auto; WIDTH: 1000px
}
#fm {
	TEXT-ALIGN: left; PADDING-LEFT: 0px
}
#cp {
	COLOR: #77c
}
#cp A {
	COLOR: #77c
}

#navBarBG {
width: 100%;
height: auto;
background-image: url("http://www.fengyunzhibo.com/images/v3/nav-bk.png");
background-repeat: repeat-x;
position: relative;
z-index: 10000;
min-width: 1000px;
min-height: 55px;
}

#navBar{
width: 1000px;
height: 55px;
text-align: center;
margin-right: auto;
margin-left: auto;
}

#body {
width: 1000px;
height: auto;
margin: 0 auto;
position: relative;
overflow: hidden;
}

.highlightit img{ border:1px solid #fff; }
.highlightit:hover img{ border:1px solid #FFCC99; }
.highlightit:hover { color: #FFCC99; }

.head1 { float:left; height:200px; width:1000px; }
.head2 { border-left:0 none; float:left; height:230px; width:500px; }

.bottom { float:left; height:200px; width:1000px; text-align:center; font-size:12px;}

.left {
width: 780px;
height: auto;
position: relative;
float: left;
}

.item {
	float:left; height:30px; width:778px;
	border:solid 1px lightGrey;
	font-size:14px;
	color: #0054AF;
	text-align:left;
	padding-left: 10px;
	line-height: 30px;
	font-family: '微软雅黑', 'Microsoft YaHei', '黑体', Arial;
	font-weight: normal;
	background: url("http://www.zhibo8.cc/css/images/menu_bg2.gif") repeat-x;
}

.content{
border: solid 1px lightGrey;
width:788px;
height: auto;
}

.content ul {
width: 768px;
height: auto;
overflow: hidden;
padding-top: 10px;
padding-right: 10px;
padding-bottom: 10px;
padding-left: 10px;
}

.content ul li {
width:768px;
height:auto;
line-height:20px;
font-size:12px; 
padding:0 0 8px 0; 
margin:8px 0; 
border-bottom:dotted 1px #CCCCCC;
font-family:Arial,"宋体";
}

.right {
background: #eef3f3;
float: right;
overflow: hidden;
width: 190px;
height: auto;
padding-right: 10px;
}

.leaguebox {
	float:left; height:30px; width:188px;
	border:solid 1px lightGrey;
	position: relative;
	font-size:14px;
	color: #0054AF;
	text-align:left;
	padding-left: 10px;
	line-height: 30px;
	font-family: '微软雅黑', 'Microsoft YaHei', '黑体', Arial;
	font-weight: normal;
	background: url("http://www.zhibo8.cc/css/images/menu_bg2.gif") repeat-x;
}

.info{
border: solid 1px lightGrey;
width:198px;
height: auto;
}

.info ul {
width: 178px;
height: auto;
overflow: hidden;
padding-top: 10px;
padding-right: 10px;
padding-bottom: 10px;
padding-left: 10px;
}

.info ul li {
width:178px;
height:auto;
line-height:20px;
font-size:12px; 
padding:0 0 8px 0; 
margin:8px 0; 
border-bottom:dotted 1px #CCCCCC;
font-family:Arial,"宋体";
word-break: break-all;
word-wrap: break-word;
}

</STYLE>
</head>

<body>
<div id="navBarBG" style="display: block;">
<div id="navBar">
<font color='green' size='6'>DOTA2官方联赛直播</font>
</div>
</div>

<DIV id=m>
<DIV id=fm>
</DIV>

<?php
    echo "<div class=\"left\">";

    $arr = array();
    $content = file_get_contents("/tmp/GetLiveLeagueGames.xml");
    $xml = simplexml_load_string($content);
        
    echo "<div class=\"item\">Living Game</div>\n";
    echo "<div class=\"content\"><ul>\n";
    foreach($xml->games as $games)
    {
        $r = $games->game->radiant_team->team_name;
        $d = $games->game->dire_team->team_name;
        $s = $games->game->spectators;
        $l = $games->game->league_id;

        if(!empty($r))
        {
            array_push($arr, $l);
            echo "<li>\n";
            echo "$r&nbsp;&nbsp;&nbsp;&nbsp;<font color='red'>VS</font>&nbsp;&nbsp;&nbsp;&nbsp;$d";
            echo "&nbsp;&nbsp; || 观众数: $s";
            echo "&nbsp;&nbsp; || leagueid: $l";
            echo "</li>\n";
        }
    }
    if(empty($arr))
    {
        echo "<li>No Living Game.</li>";
    }
    echo "</ul></div>\n";

    $cnt = count($arr);
    $content = file_get_contents("/tmp/GetLeagueListing.xml");
    $xml = simplexml_load_string($content);
    $leagues = $xml->leagues[0];	

    foreach($leagues as $league)
    {
        $l = "$league->leagueid";
        if(in_array($l, $arr))
		    $desc = $league->description;
        elseif($cnt > 0 || rand(0, 100) < 95)
            continue;
        else
		    $desc = $league->description;

        echo "<div class=\"item\">$league->name (id:$league->leagueid)</div>\n";
        echo "<div class=\"content\">\n";
        echo "<ul><li>\n";
        echo "$desc  >> ";
        echo "<a target='_blank' href='$league->tournament_url'>进入官网</a>&nbsp;&nbsp;";
        echo "</li></ul></div>\n";
    }
    echo "</div>\n";

	$content = file_get_contents("./EpicLeagueListing.xml");
	$xml = simplexml_load_string($content);

	$leagues = $xml->leagues[0];
	echo "<div class=\"right\">";
	echo "<div class=\"leaguebox\">联赛官方网站</div>";

	echo "<div class=\"info\"><ul>";
	foreach($leagues as $league)
	{
        $l = "$league->leagueid";
        if(in_array($l, $arr))
		    $name = $league->name;
        elseif($cnt > 0)
            continue;
        else
		    $name = $league->name;

		echo "<li>";
		if(0 === strcmp(substr($league->tournament_url, 0, 7), "http://"))
			echo "<a target='_blank' href='$league->tournament_url'>$name</a>";
		else
			echo "<a target='_blank' href='http://$league->tournament_url'>$name</a>";

		echo "</li>";
	}
	echo "</ul></div></div>";
?>

<BR><BR>
<DIV class="bottom">
<p id="lh"><a href="http://www.dota2zhibo.com/">加入dota2zhibo</a> | <a href="http://www.dota2zhibo.com">dota2风云榜</a> | <a href="http://www.dota2zhibo.com">关于dota2zhibo</a> | <a href="http://www.dota2zhibo.com">About dota2zhibo</a></p><p id="cp">&copy;2013 dota2zhibo.com <a href="http://www.dota2zhibo.com">使用搜索前必读</a> <a href="http://www.miibeian.gov.cn" target="_blank">京ICP证960173号</a> <img src="http://gimg.baidu.com/img/gs.gif"></p><br>
</DIV>

</DIV>

<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-21342336-3']);
	_gaq.push(['_trackPageview']);

	(function() {
	 var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>

</body>
</html>
