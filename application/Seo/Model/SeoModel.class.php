<?php
namespace Seo\Model;
use Think\Model;
use Common\Model\CommonModel;
class SeoModel extends CommonModel{
	protected $_validate = array(
		array('client', 'require', '客户名称不能为空！', 1, 'regex', CommonModel:: MODEL_INSERT  ),
		array('bword', 'require', '百度词数不能为空！', 1, 'regex', CommonModel:: MODEL_INSERT  ),
		array('pword', 'require', '手机百度词数不能为空！', 1, 'regex', CommonModel:: MODEL_INSERT  ),
		array('sword', 'require', '搜狗词数不能为空！', 1, 'regex', CommonModel:: MODEL_INSERT  ),
		array('cdate', 'require', '查询日期不能为空！', 1, 'regex', CommonModel:: MODEL_INSERT  ),
		array('excel', 'require', 'Excel文件不能为空！', 1, 'regex', CommonModel:: MODEL_INSERT  ),
	);
	protected $_auto = array(
			
	);

}