<?php
/**
 * 仿腾讯视频源码，无需数据库，自动采集，一比一精仿！
 * 开发者不易，感谢支持，
 */
if(!isset($_GET["condition"])){ $_GET['condition'] = ""; }
if(!isset($_GET["page"]) || !is_numeric($_GET["page"]) || $_GET["page"] < 1){ $_GET["page"] = 1; }
require "../../data/index.php";
$data = data(array("act" => "list","type" => "dianshi","filter" => $_GET["condition"],"page" => $_GET["page"]));

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta name="referrer" content="no-referrer">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<title>电视剧</title>
<meta name="keywords" content="演示网站电视剧集合页">
<meta name="description" content="这是一个演示网站的电视剧集合页">
<link rel="stylesheet" type="text/css" href="../../static_qq/css/jquery.mobile.min.css">
<link rel="stylesheet" type="text/css" href="../../static_qq/css/common.css">
</head>

<body class="body" ltype="dianshi">

<div class="header">
	<a class="logo" href="../../" style="background-image:url(../../static_qq/images/logo.png)"></a>
	<div class="search">
		<input type="text" placeholder="输入你想看的" id="search" />
		<a id="searchDo"></a>
	</div>
	<div class="navigate">
		<a href="../../">精选</a>
		<a href="../dianying/">电影</a>
		<a href="../dianshi/" class="current">电视剧</a>
		<a href="../zongyi/">综艺</a>
		<a href="../dongman/">动漫</a>
	</div>
</div>

<div class="clear" style="height:0.2rem"></div>

<div class="condition" id="conditionBox">
	<?php foreach($data['filter'] as $condition){ ?>
		<div class="s-slide-menu"><div>
			<?php foreach($condition as $k => $v){ ?>
				<a href="./?condition=<?php echo urlencode($v)?>"<?php echo $v === $_GET['condition'] ? ' class="now"' : ''?>><?php echo  htmlspecialchars(substr($k,1))?></a>
			<?php } ?>
		</div></div>
	<?php } ?>
</div>

<div class="list">

	<?php if(!isset($data['list']) || count($data['list']) === 0){ ?>
	<div class="no-data" id="noDataBox" style="margin-top:1rem;background:none">没有找到相关影片，请尝试其他分类！</div>

	<?php }else{ ?>
	<div class="items" id="listList">
		<?php foreach($data['list'] as $v){ ?>
		<a href="../../play/?vid=<?php echo urlencode($v['id'])?>">
			<i style="background-image:url(<?php echo $v['pic']?>)"><b><?php echo $v['hint']?></b></i>
			<span><?php echo htmlspecialchars($v['title'])?></span>
		</a>
		<?php } ?>
		<span class="clear"></span>
	</div>

	<div class="more">
		<a class="prev" href="./?condition=<?php echo urlencode($_GET['condition'])?>&page=<?php echo $_GET['page'] - 1?>"<?php echo $_GET['page'] <= 1 ? ' style="display:none"' : ''?>><img src="../../static_qq/images/more.png" />上一页</a>
		<a class="next" href="./?condition=<?php echo urlencode($_GET['condition'])?>&page=<?php echo $_GET['page'] + 1?>"<?php echo !$data['hasmore'] ? ' style="display:none"' : ''?>>下一页<img src="../../static_qq/images/more.png" /></a>
	</div>
	<?php } ?>
</div>

<div class="clear" style="height:2rem"></div>

<div class="copyright">
	<p>本站内容均来自于互联网资源实时采集</p>
	<p>本源码仅用做学习交流</p>
</div>

<a class="scroll-to-top" id="scrollToTop"></a>

<script src="../../static_qq/js/jquery.min.js"></script>
<script src="../../static_qq/js/common.js"></script>
<script src="../../static_qq/js/list.js"></script>
</body>
</html>