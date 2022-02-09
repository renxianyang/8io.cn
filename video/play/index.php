<?php
/**
 * 仿腾讯视频源码，无需数据库，自动采集，一比一精仿！
 * 开发者不易，感谢支持，
 */
if(empty($_GET["vid"])){ header("Location: ../../");die(); }
require "../data/index.php";
$data = data(array("act" => "item","id" => $_GET["vid"]));

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit">
<meta name="referrer" content="no-referrer">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<?php if(isset($data['title'])){ ?>
<title>正在播放 - <?php echo htmlspecialchars($data['title'])?></title>
<meta name="keywords" content="免费电影网<?php echo htmlspecialchars($data['title'])?>播放页">
<meta name="description" content="免费电影网<?php echo htmlspecialchars($data['title'])?>播放页 - <?php echo htmlspecialchars($data['desc'])?>">
<?php }else{ ?>
<title>资源不存在</title>
<?php } ?>
<link rel="stylesheet" type="text/css" href="../static_qq/css/jquery.mobile.min.css">
<link rel="stylesheet" type="text/css" href="../static_qq/css/common.css">
<link rel="stylesheet" type="text/css" href="../static_qq/css/play.css">
</head>

<body class="body">

<div class="header">
	<a class="logo" href="../" style="background-image:url(../static_qq/images/logo.png)"></a>
	<div class="search">
		<input type="text" placeholder="输入你想看的" id="search" />
		<a id="searchDo"></a>
	</div>
	<div class="navigate">
		<a href="../" class="current">精选</a>
		<a href="../list/dianying/">电影</a>
		<a href="../list/dianshi/">电视剧</a>
		<a href="../list/zongyi/">综艺</a>
		<a href="../list/dongman/">动漫</a>
	</div>
</div>

<?php if(count($data['from']) !== 0){ ?>
<div id="playBox">

	<div class="play-box" id="playBoxIframe">

	</div>

	<div class="clear" style="height:0.3rem"></div>

	<h3 class="from-title" id="titleItem" value="<?php echo htmlspecialchars($data['title'])?>"><?php echo htmlspecialchars($data['title'])?></h3>
	<div class="from" id="fromList" style="display:none" from="<?php echo htmlspecialchars('{"data":'.json_encode($data).'}')?>">
		<div class="template"><a data-api="{{api}}" data-href="{{href}}" data-hasmore="{{hasmore}}" data-site="{{site}}">线路{{number}}</a></div>
		<span class="clear"></span>
	</div>

	<div class="loading" id="loadBox2">
		<span class="s-loading"><i class="first"></i><i class="second"></i><i class="third"></i></span>
	</div>

	<div class="episodes" id="episodesBox" style="display:none;">
		<div class="clear" style="height:0.3rem"></div>
		<h3 class="episodes-title">选集<span class="episodes-control" id="episodesControl"><a class="next">上一集</a><a class="prev">下一集</a></span></h3>
		<div class="episodes-list" id="episodesList">
			<div class="template"><a data-api="{{api}}" data-href="{{href}}" value="{{number}}">{{number}}</a></div>
			<span class="clear"></span>
		</div>
	</div>
</div>
<?php }else{ ?>
<div class="no-data" id="noDataBox">未找到可用播放线路</div>
<?php } ?>

<?php if(isset($data['title'])){ ?>
<div class="clear" style="height:2rem"></div>
<div id="itemList">
	<div class="more">
		<i style="background-image:url(<?php echo $data['pic']?>)"></i>
		<h5><?php echo htmlspecialchars($data['title'])?></h5>
		<span><?php echo implode('</span><span>',$data['item'])?></span>
	</div>
	<div class="more desc">
		<div>简介：<?php echo htmlspecialchars($data['desc'])?></div>
	</div>
</div>
<?php } ?>

<?php if(isset($data['guess']) && count($data['guess'])){ ?>
<div class="list" style="margin-top:1rem">

	<h3 class="title">猜你喜欢</h3>

	<div class="items" id="guessList">
		<?php foreach($data['guess'] as $v){ ?>
		<a href="./?vid=<?php echo urlencode($v['id'])?>">
			<i style="background-image:url(<?php echo $v['pic']?>)"></i>
			<span><?php echo htmlspecialchars($v['title'])?></span>
		</a>
		<?php } ?>
		<span class="clear"></span>
	</div>
</div>
<?php } ?>

<div class="clear" style="height:2rem"></div>

<div class="copyright">
	<p>本站内容均来自于互联网资源实时采集</p>
	<p>本源码仅用做学习交流</p>
</div>

<a class="scroll-to-top" id="scrollToTop"></a>

<script src="../static_qq/js/jquery.min.js"></script>
<script src="../static_qq/js/common.js"></script>
<script src="../static_qq/js/play.js"></script>
</body>
</html>