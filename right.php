<?php
    include "hot.php";

    $content = file_get_contents("/tmp/GetLeagueListing.xml");
	$xml = simplexml_load_string($content);
	$leagues = $xml->leagues[0];

    echo "<div class=\"right\">";

    echo "<div class=\"panel panel-primary\">";
    echo "<div class=\"panel-heading\">比赛直播</div>\n";
    echo "<ul class=\"list-group\">\n";
    echo "<li class=\"list-group-item\"><a target='_blank' href='http://www.alidota.com/'>阿里dota</a></li>";
    echo "<li class=\"list-group-item\"><a target='_blank' href='http://www.douyutv.com/directory/game/DOTA2'>斗鱼tv</a></li>";
    echo "<li class=\"list-group-item\"><a target='_blank' href='http://www.huomaotv.com/live_list?gid=23'>火猫tv</a></li>";
    echo "<li class=\"list-group-item\"><a target='_blank' href='http://www.huya.com/g/dota2'>虎牙直播</a></li>";
    echo "<li class=\"list-group-item\"><a target='_blank' href='http://www.zhanqi.tv/games/dota2'>战棋tv</a></li>";
	echo "</ul></div>";

    echo "<div class=\"panel panel-danger\">";
    echo "<div class=\"panel-heading\">热门资讯</div>\n";
    echo "<ul class=\"list-group\">\n";
    echo "<li class=\"list-group-item\"><a target='_blank' href='http://dota2.sgamer.com/'>sgamer资讯</a></li>";
    echo "<li class=\"list-group-item\"><a target='_blank' href='http://www.dota2lounge.com/'>d2l交易菠菜</a></li>";
    echo "<li class=\"list-group-item\"><a target='_blank' href='http://dota2.replays.net/'>replays资讯</a></li>";
    echo "<li class=\"list-group-item\"><a target='_blank' href='http://dota2.uuu9.com/'>uuu9资讯</a></li>";
	echo "</ul></div>";

    echo "<div class=\"panel panel-success\">";
    echo "<div class=\"panel-heading\">热门官方联赛</div>\n";
    echo "<ul class=\"list-group\">\n";

	foreach($leagues as $league)
	{
        $l = "$league->leagueid";
        if($hot["$l"] >= 5)
		    $name = $league->name;
        else
            continue;

		echo "<li class=\"list-group-item\">";
		echo "<p><font color='green'>联赛id:$l</font></p>\n";
        //echo "<a target='_blank' href='$league->tournament_url' title='$league->description'>$name</a>\n";
        echo "<a target='_blank' href='$league->tournament_url'>$name</a>\n";
		echo "</li>";
	}
	echo "</ul></div></div>";
?>

<BR><BR>
<DIV class="bottom">
<p id="lh"><a href="http://www.dota2zhibo.com/">加入dota2zhibo</a> | <a href="http://www.dota2zhibo.com">dota2风云榜</a> | <a href="http://www.dota2zhibo.com">关于dota2zhibo</a> | <a href="http://www.dota2zhibo.com">About dota2zhibo</a></p><p id="cp">&copy;2014 dota2zhibo.com <a href="http://www.dota2zhibo.com">使用搜索前必读</a> <a href="http://www.miibeian.gov.cn" target="_blank">京ICP备14027394号</a> <img src="http://gimg.baidu.com/img/gs.gif"></p><br>
</DIV>
