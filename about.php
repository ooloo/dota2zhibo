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
<li><a href="http://dota2zhibo.com/history.php">History</a></li>
<li><a href="http://dota2zhibo.com/heroes.php">Heroes</a></li>
<li class="active"><a href="http://dota2zhibo.com/about.php">About</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>

<DIV id=m>

<?php
    include "hot.php";

    echo "<br><BR><BR><div class=\"left\">";

    echo "<div class=\"panel panel-info\">";
    echo "<div class=\"panel-heading\">About us</div>";
    echo "<div class=\"panel-body\">
    <h4>Copyright</h4><br>
    &copy; 2015 Valve Corporation. All rights reserved.<br><br>
    Valve, the Valve logo, Half-Life, the Half-Life logo, the Lambda logo, Steam, <br><br>
    the Steam logo, Team Fortress, the Team Fortress logo, <br><br>
    Opposing Force, Day of Defeat, the Day of Defeat logo, <br><br>
    Counter-Strike, the Counter-Strike logo, Source, the Source logo, <br><br>
    Counter-Strike: Condition Zero, Portal, the Portal logo, Dota, <br><br>
    the Dota 2 logo, and Defense of the Ancients are trademarks <br><br>
    and/or registered trademarks of Valve Corporation. <br><br>
    All other trademarks are property of their respective owners.<br><br>
    <h4>Valve Video Policy</h4><br>
    <a href=http://www.valvesoftware.com/videopolicy.html>Click here for information</a>.<br><br>
    <h4>Third Party Legal Notices</h4><br>
    Steam and other Valve products distributed via Steam use certain third party materials <br><br>
    that require notifications about their license terms.  <br><br>
    You can find a list of these notifications in the file called ThirdPartyLegalNotices.doc distributed <br><br>
    with the Steam client and/or a particular Valve product.  <br><br>
    Where license terms require Valve to make source code available for redistribution, <br><br>
    the code may be found <a href=http://developer.valvesoftware.com/wiki/Valve_Open_Source>here</a>.<br><br>
    <h4>Claims of Copyright Infringement</h4><br>
    Valve respects the intellectual property rights of others, <br><br>
    and we ask that everyone using our internet sites and services do the same. <br><br>
    Anyone who believes that their work has been reproduced in one of our internet sites or services <br><br>
    in a way that constitutes copyright infringement may notify Valve <br><br>
    via <a href=https://steamcommunity.com/dmca/create/>this page</a>.<br><br>
    More information about U.S. copyright law can be found at the United States <br><br>
    Copyright Office <a href=http://lcweb.loc.gov/copyright/>http://lcweb.loc.gov/copyright/</a><br><br>
    <br />
    </div></div>";

    echo "</div>\n";
    // -------------left end--------------

    include "right.php";
?>

</DIV>

</body>
</html>
