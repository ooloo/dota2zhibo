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
    echo "<div class=\"panel-heading\">6.86 游戏性更新</div>";
    echo "<div class=\"panel-body\">

    <h3>综合</h3>
    <ul>
    <li>小兵的金钱奖励每次升级后都会增加1金钱即每7分30秒</span></li>
    </ul>
    <br>
    <ul>
    <li>英雄所受的攻城伤害从75%上升至85%防御塔和攻城单位对英雄的伤害提升约13%。<br />例如，1级防御塔对英雄的伤害从82.5点上升至93.5点。</span></li>
    </ul>
    <br>
    <ul>
    <li>英雄的基础生命值从150点上升至180点</li>
    </ul>
    <br>
    <ul>
    <li>现在兵线的位置略微靠近夜魇上塔和天辉下塔</li>
    </ul>
    <br>
    <ul>
    <li>随机征召（RD）的初始英雄数量从24个增加至50个</li>
    <li>随机征召模式加入天梯匹配</li>
    <li>现在随机征召的选人机制与天梯全英雄选择相同</li>
    </ul>
    <br>
    <ul>
    <li>半人马猎手现在拥有一个可以叠加的魔法抗性光环（普通单位20%，英雄5%）这是半人马营地中较小的单位。</span></li>
    <li>地狱熊怪现在拥有一个可以叠加的魔法抗性光环（普通单位20%，英雄5%）这是地狱熊怪营地中较小的单位。</span></li>
    <li>龙隐光环的护甲加成从2点增加至3点</li>
    <li>远古黑龙堆的护甲减少1点</li>
    <li>现在远古中立生物与普通中立生物类似，死亡时范围内所有英雄平分经验</li>
    </ul>
    <br>
    <ul>
    <li>远古黑龙增加一个新技能，火球
    <p>以一片区域为目标吐出一个火球，点燃300范围内区域，持续10秒。每秒造成85点伤害。</p>
    <p>冷却时间：10秒<br />魔法消耗：100点<br />施法距离：1000。</p>
    </ul>
    <br>
    <ul>
    <li>远古雷隐兽的暴怒现在以单位为目标</li>
    <li>丘陵巨魔巫师的魔法光环从2点/秒增加至3点/秒</li>
    <li>萨特放逐者的净化冷却时间从5秒减少至3秒</li>
    <li>萨特苦难使者的邪恶光环生命恢复从4点/秒增加至6点/秒</li>
    <li>萨特苦难使者的冲击波距离从800增加至1200</li>
    <li>萨特苦难使者的冲击波速度从1050减少至900</li>
    <li>萨特苦难使者的冲击波伤害从125点增加至160点</li>
    <li>黑暗巨魔召唤法师和丘陵巨魔的攻击距离从500降低至400</li>
    <li>黑暗巨魔召唤法师的攻击力增加6点</li>
    </ul>
    <br>
    <ul>
    <li>Roshan的基础护甲增加1点</li>
    <li>Roshan的基础攻击间隔从1.0增加至2.0</li>
    <li>Roshan现在拥有+100攻击速度的加成效果
    
    他的攻击频率保持不变，但是攻速降低效果的作用将会变小。
    </span>
    </li>
    </ul>
    <br>
    <ul>
    <li>增加巡逻指令</li>
    <li>现在被沉默后还是会呼出选定目标的指示框，而且会在选好目标时收到错误提示，而不是点击技能时</li>
    <li>现在拥有范围效果的单个目标类技能拥有全新的选定界面
    
    如寒霜爆发（巫妖）、风暴之拳（斯温）等等
    </span>
    </li>
    </ul>
    <br>
    <ul>
    <li>天梯全英雄选择的初始预选时间从15秒减少至5秒</li>
    <li>防御塔被摧毁后不再提供经验奖励（之前区域内平分25经验）</li>
    </ul>
    <br>
    <ul>
    <li>简化部分伤害和护甲类型
    <p>移除穿刺攻击类型，下列单位变成标准攻击类型（对建筑造成的伤害从40->50%）：半人马征服者，地狱熊怪，地狱熊怪粉碎者，枭兽撕裂者，萨特苦难使者，远古花岗岩傀儡，远古黑龙，熔炉精灵，小蜘蛛和术士的地狱火。</p>
    <p>移除无甲护甲类型，下列单位变成轻甲类型（与小兵相同）：兽王的战鹰</p>
    <p>中甲和重甲统一为相同类型（与其他中立生物相同）：狗头人士兵，豺狼人刺客，鬼魂，丘陵巨魔狂战士，丘陵巨魔牧师，鹰身女妖侦察者，鹰身女妖风暴巫师，豪猪（兽王），的墓碑（不朽尸王），幽冥守卫（帕格纳），灵能陷阱（圣堂刺客），地雷（工程师），麻痹陷阱（工程师），遥控炸弹（工程师）。</p>

    </li>
    </ul>

    <br />
    <h3>地形</h3>
    <ul>
    <li>双方各加入一组大型中立生物营地，靠近各自的神秘商店</li>
    <li>天辉的神秘商店上方的眼位处加入一个小斜坡</li>
    <li>天辉的大型中立生物营地现在更靠近夜魇的劣势路</li>
    <li>天辉野区的中型和大型中立生物营地互换位置</li>
    <li>天辉中路增加一条进入天辉野区的小路</li>
    <li>天辉野区增加一个连接至Roshan附近区域的斜坡</li>
    <li>增加一个通往天辉符点眼位的小路</li>
    <li>夜魇神秘商店后方增加一个新的绕树林点</li>
    <li>扩张了天辉上路二塔周围的地形</li>
    <li>下路符点略微上移</li>
    <li>天辉中路一塔稍微后移</li>
    <li>调整了天辉小型中立生物营地的刷新判定范围</li>
    <li>天辉远古生物营地附近增加一处新眼位（没有上路符点视野）</li>
    <li>增加一条通往天辉神秘商店下方眼位的小路</li>
    <li>天辉方通往上路符点的斜坡现在离符点更远了（更靠近中路）</li>
    <li>夜魇方通往上路符点的斜坡现在更靠上</li>
    <li>略微调整了天辉远古生物营地下方的地形和斜坡</li>
    <li>提升夜魇边路商店周围地形的绕树林效果</li>
    <li>天辉劣势路边路商店以南的树林中增加一条小路以及绕树林的路径</li>
    <li>天辉上路一塔右侧增加一处新眼位</li>
    <li>天辉远古生物下方斜坡右侧增加若干树木（可以遮住左侧的部分视野）</li>
    <li>夜魇现在可以通过中路天辉斜坡进入野区，靠边走不会驱散诡计之雾效果</li>
    <li>夜魇上路边路商店上方增加一条新的小路</li>
    <li>天辉下路二塔区域的长长一片树林中加入一条新的小路</li>
    <li>下路符点眼位附近增加一条可以通过的小路</li>
    <li>夜魇优势路大型中立生物营地的拉野范围减少</li>
    <li>夜魇上路符点上方悬崖处增加一条通往右侧的小路</li>
    <li>下路边路商店以南加入一条新的小路</li>
    <li>夜魇基地的中塔和上塔之间沿岩架增加若干树木</li>
    <li>调整了天辉大型中立生物营地附近眼位的绕树林点</li>
    <li>天辉下路大型中立生物营地的南部增加一个新的绕树林点</li>
    <li>夜魇中路靠近神秘商店边缘处增加一个新的藏身地点</li>
    <li>天辉上路二塔下方增加一些树木</li>
    <li>调整了夜魇劣势路左侧的树林（影响的是能否看见英雄从左侧树林出现）</li>
    <li>天辉远古中立生物营地上方增加一条小路（通往新眼位）</li>
    <li>微调了夜魇神秘商店的位置</li>
    <li>调整了天辉下路左侧眼位附近环路的寻路行为</li>
    <li>调整了天辉中型中立生物营地右侧高地的树木布局</li>
    <li>天辉方通向下路符点的斜坡往回移了一点</li>
    <li>原天辉大型中立生物营地（现天辉中型中立生物营地）上方的树丛增加了藏身地点</li>
    <li>天辉小型中立生物营地微微下移</li>
    <li>天辉中路中型中立生物营地略微下移，并调整了周围的树木</li>
    <li>夜魇下路，远古中立生物营地右侧高地上增加了一处新的藏身地点</li>
    <li>略微调整了天辉中路斜坡的位置</li>
    <li>天辉小型中立生物营地右侧的地形加入新的绕树林点</li>
    <li>夜魇上路二塔上方调整了树林中的小路，增加了若干藏身地点</li>
    </ul>
    <br />

    </div></div>";

    echo "</div>\n";
    // -------------left end--------------

    include "right.php";
?>

</DIV>

</body>
</html>
