<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<script type="text/javascript">
	//全局变量
	var GV = {
	    ROOT: "/",
	    WEB_ROOT: "/",
	    JS_ROOT: "public/js/",
	    APP:'<?php echo (MODULE_NAME); ?>'/*当前应用名*/
	};
	</script>
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script>
    	$(function(){
    		$("[data-toggle='tooltip']").tooltip();
    	});
    </script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body>
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li><a href="<?php echo U('AdminSeo/add');?>">seo数据报表</a></li>
			<li class="active"><a href="<?php echo U('AdminSeo/index');?>">数据列表</a></li>
		</ul>
		<form class="well form-search" method="post"
			action="<?php echo U('User/index');?>">
			客户名: <input type="text" name="user_login" style="width: 100px;"
				value="<?php echo I('request.user_login/s','');?>"
				placeholder="请输入<?php echo L('USERNAME');?>"> 时间： <input type="text"
				name="start_time" class="js-datetime"
				value="<?php echo ((isset($formget["start_time"]) && ($formget["start_time"] !== ""))?($formget["start_time"]):''); ?>" style="width: 120px;"
				autocomplete="off">- <input type="text" class="js-datetime"
				name="end_time" value="<?php echo ((isset($formget["end_time"]) && ($formget["end_time"] !== ""))?($formget["end_time"]):''); ?>"
				style="width: 120px;" autocomplete="off"> &nbsp; &nbsp; <input
				type="submit" class="btn btn-primary" value="搜索" /> <a
				class="btn btn-danger" href="<?php echo U('User/index');?>">清空</a>
		</form>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="50">ID</th>
					<th>客户名称</th>
					<th>百度指数</th>
					<th>手机百度指数</th>
					<th>搜狗指数</th>
					<th>查询日期</th>
					<th width="120">Excel 路径</th>
				</tr>
			</thead>
			<tbody>

				<?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
					<td><?php echo ($vo["id"]); ?></td>
					<td><?php echo ($vo["client"]); ?></td>
					<td><?php echo ($vo["bword"]); ?></td>
					<td><?php echo ($vo["pword"]); ?></td>
					<td><?php echo ($vo["sword"]); ?></td>
					<td><?php echo ($vo["cdate"]); ?></td>
					<td><?php echo ($vo["excel"]); ?></td>
				</tr><?php endforeach; endif; ?>
			</tbody>

			<tfoot>
				<tr>
					<th width="50">ID</th>
					<th>客户名称</th>
					<th>百度指数</th>
					<th>手机百度指数</th>
					<th>搜狗指数</th>
					<th>查询日期</th>
					<th width="120">Excel 路径</th>
				</tr>
			</tfoot>
		</table>
		<div class="pagination"><?php echo ($page); ?></div>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>