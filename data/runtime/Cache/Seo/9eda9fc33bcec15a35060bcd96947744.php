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
<link rel="stylesheet" type="text/css" href="/public/js/webuploader/webuploader.css" />
<script type="text/javascript" src="/public/js/webuploader/webuploader.min.js"></script>
<style>
.uploadify {
	background-color: #0b6cbc
}

.uploadify-button {
	background-color: transparent;
	border: none;
	padding: 0;
}

.uploadify:hover .uploadify-button {
	background-color: transparent;
}
</style>
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo U('AdminSeo/add');?>">seo数据报表</a></li>
			<li><a href="<?php echo U('AdminSeo/index');?>">数据列表</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form"
			action="<?php echo U('AdminSeo/add_post');?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label">客户名：</label>
					<div class="controls">
						<input type="text" name="client">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">总词数：</label>
					<div class="controls">
						<input type="text" name="collect">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label">百度词数：</label>
					<div class="controls">
						<input type="text" name="bword">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">手机百度词数：</label>
					<div class="controls">
						<input type="text" name="pword">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">360词数：</label>
					<div class="controls">
						<input type="text" name="sword">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">搜狗词数：</label>
					<div class="controls">
						<input type="text" name="gword">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">查询日期：</label>
					<div class="controls">
						<input type="text" name="cdate" class="js-datetime date"
							autocomplete="off">
					</div>
				</div>
							
				<div class="control-group">
					<label class="control-label">导入表格：</label>
					<div class="controls">
						<div id="uploader" class="wu-example">
							<div id="thelist" class="uploader-list"></div>
							<div class="btns">
								<div id="picker">选择文件</div>
								<a id="ctlBtn" class="btn btn-default">开始上传</a>
							</div>
						</div>
						<input type="hidden" name="excel"/> 						
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('ADD');?></button>
				<a class="btn" href="javascript:history.back(-1);"><?php echo L('BACK');?></a>
			</div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
	<script>
	/* 
	Array
        	(
        			[file] => Array
        			(
        					[name] => 2018011616272149583.xls
        					[type] => application/vnd.ms-excel
        					[size] => 25600
        					[key] => file
        					[ext] => xls
        					[md5] => 1fc4df7a9faa643e165fe019ecf8798e
        					[sha1] => 2180be1e9ebfc7975d6c8d8b48dfacc88681592a
        					[savename] => 5ab3d6ac4c892.xls
        					[savepath] => 20180323/
        			)
        	
        	) 
	*/
		$(function(){
			var BASE_URL = "/public/js/webuploader";
			var syncPath="<?php echo U('AdminSeo/synUpload');?>";
			
			var $list=$('#thelist'),
			$btn = $('#ctlBtn'),
	        state = 'pending',
	        uploader;
			uploader=WebUploader.create({
		        resize: false,
		        swf: BASE_URL + '/js/Uploader.swf',
		        server: syncPath,
		        pick:{
		        	id:'#picker',
		        	name:'',
		        	label:'点击选择Excel文件',
		        	multiple:false
		        } ,
		        fileNumLimit:1,
		        duplicate:true,//是否可重复选择同一文件
		        
		        accept: {
		            title: 'Files',
		            extensions: 'xls,xlsx',
		            mimeTypes: 'application/vnd.ms-excel'
		        }
			});
			uploader.on( 'beforeFileQueued', function( file ){
				if(file.size>(1024*1024*8)){
					alert('文件大于8M');
					return false;
				}else{
					return true;
				}  
			});
			uploader.on( 'fileQueued', function( file ) {
				$list.append( '<div id="' + file.id + '" class="item">' +
			            '<h4 class="info">' + file.name + '</h4>' +
			            '<p class="state">等待上传...</p>' +
			        '</div>' );
		        
		    });
			// 文件上传过程中创建进度条实时显示。
		    uploader.on( 'uploadProgress', function( file, percentage ) {
		        var $li = $( '#'+file.id ),
		            $percent = $li.find('.progress .progress-bar');

		        // 避免重复创建
		        if ( !$percent.length ) {
		            $percent = $('<div class="progress progress-striped active">' +
		              '<div class="progress-bar" role="progressbar" style="width: 0%">' +
		              '</div>' +
		            '</div>').appendTo( $li ).find('.progress-bar');
		        }				
		        
		        $li.find('p.state').text('上传中');

		        $percent.css( 'width', percentage * 100 + '%' );
		    });
		    
		    uploader.on( 'uploadSuccess', function( file,response ) { 
		    	if(response.status){
		    		$("input[name='excel']").val(response.value);
		    		$( '#'+file.id ).find('p.state').text('已上传');
		    	}else{
		    		$( '#'+file.id ).find('p.state').text(response.msg);		    		
		    	}		    	
		    });

		    uploader.on( 'uploadError', function( file ) {
		        $( '#'+file.id ).find('p.state').text('上传出错');
		    });

		    uploader.on( 'uploadComplete', function( file ) {
		        $( '#'+file.id ).find('.progress').fadeOut();
		    });
		    uploader.on( 'all', function( type ) {
		        if ( type === 'startUpload' ) {
		            state = 'uploading';
		        } else if ( type === 'stopUpload' ) {
		            state = 'paused';
		        } else if ( type === 'uploadFinished' ) {
		            state = 'done';
		        }

		        if ( state === 'uploading' ) {
		            $btn.text('暂停上传');
		        } else {
		            $btn.text('开始上传');
		        }
		    });
		    uploader.on('uploadFinished', function () {
		        //清空队列
		         uploader.reset();
		    });
		    /* uploader.on('uploadAccept', function( file, response ){
		    	//console.log(response);
		    	if(!response.status){
		    		$( '#'+file.id ).find('p.state').text(response.msg);
		    	}
		    	
		    }); */
		    $btn.on( 'click', function() {
		        if ( state === 'uploading' ) {
		            uploader.stop();
		        } else {
		            uploader.upload();
		        }
		    });
		})
	</script>
</body>
</html>