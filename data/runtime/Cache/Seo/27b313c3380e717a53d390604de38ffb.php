<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>报表首页</title>
<meta name="keywords" content="报表首页">
<meta name="description" content="报表首页">
<link rel="stylesheet" type="text/css" href="/themes/simplebootx/Public/Seo/index.css" /><link rel="stylesheet" type="text/css" href="/public/simpleboot/seo/page.css" />
<script type="text/javascript" src="/themes/simplebootx/Public/Seo/index.js"></script>
</head>
<body>
	<div class="top">
		<div class="content">
			<div class="item">
				<div class="logo">
					<img src="/themes/simplebootx/Public/Seo/images/logo.jpg" alt="网赢快车" />
				</div>
			</div>
			<div class="item">
				<div class="auth">
					<img src="/themes/simplebootx/Public/Seo/images/biao.jpg" alt="用户注册" />
				</div>
			</div>
		</div>
	</div>
	<div class="path">
		<div class="content">
			<h3>当前企业：<?php echo ($list[0]["client"]); ?>(报表更新日期：<?php echo ($list[0]["cdate"]); ?>)</h3>
		</div>
	</div>
	<div class="banner">
		<div class="content">
			<img src="/themes/simplebootx/Public/Seo/images/biao_07.jpg" alt="" />
		</div>
	</div>
	<div class="box">
		<div class="content">
			<div class="count">监测到<font color="blue"><?php echo ($list[0]["collect"]); ?></font>个关键词排名搜索前3页</div>
			<div class="thead">
				<div class="item">
					<ul>
						<li>百度(<font color="green"><?php echo ($list[0]["bword"]); ?></font>)</li>
						<li>百度移动(<font color="green"><?php echo ($list[0]["pword"]); ?></font>)</li>
						<li>360搜索(<font color="green"><?php echo ($list[0]["sword"]); ?></font>)</li>
						<li>搜狗(<font color="green"><?php echo ($list[0]["gword"]); ?></font>)</li>
					</ul>
				</div>
				<div class="item">
					<ul>
						<li>发布时间</li>
						<li>排名先后顺序</li>
						<li class="active">字数排序</li>
					</ul>
				</div>
			</div>
			<div class="tbody">
				<?php if(is_array($list[0]['excel'])): $k = 0; $__LIST__ = $list[0]['excel'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><ul>
					<li class="title"><a href="<?php echo ($vo["B"]); ?>"><?php echo ($vo["A"]); ?></a></li>
					<li><img src="/themes/simplebootx/Public/Seo/images/biao_<?php if($k%4 == 1): ?>11<?php elseif($k%4 == 2): ?>14<?php elseif($k%4 == 3): ?>16<?php else: ?>18<?php endif; ?>.jpg" alt="百度排名" /></li>
					<li class="order">第<?php echo ($vo["C"]); ?>页(3) <img src="/themes/simplebootx/Public/Seo/images/biao_21.jpg" alt="百度排名" /></li>
					<li><a href="<?php echo ($vo["B"]); ?>" class="check">查看</a></li>
				</ul><?php endforeach; endif; else: echo "" ;endif; ?>
				
				
			</div>
			<div class="tfoot green-black"><?php echo ($page); ?></div>
		</div>
	</div>
	<div class="bottom">
		<div class="content">本表由【<font color="red">网赢快车</font>】提供技术支持，由于百度、360、搜狗搜索引擎更新频繁，报表查询结果以实际搜索为准</div>
	</div>
	<div class="footer">
		<div class="content"><img src="/themes/simplebootx/Public/Seo/images/biao_25.jpg" alt="网赢快车" /></div>
	</div>
</body>
</html>