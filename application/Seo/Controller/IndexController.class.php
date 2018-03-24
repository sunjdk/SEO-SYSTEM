<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/20 0020
 * Time: 11:52
 */
namespace Seo\Controller;

use Think\Upload;
use Common\Controller\HomebaseController;
use Think\Page;
class IndexController extends HomebaseController{
	protected $SeoModel;
	
	public function _initialize() {
		parent::_initialize();
		$this->SeoModel = D("Seo");		
	}

    public function index(){
        if(IS_GET){
        	$db=$this->SeoModel;
        	
        	$count=$db->count();
        	$Page=new Page($count,1);        	
        	$show = $Page->show();
        	$list=$db->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();   
        	
        	vendor("PHPExcel.PHPExcel");

        	$objExcel=new \PHPExcel();
        	$objReader=new \PHPExcel_Reader_Excel2007();
        	
        	foreach($list as $k=>$v){
        		$path=$v['excel'];
        		if(!$objReader->canRead($path)){
        			$objReader=new \PHPExcel_Reader_Excel5();
        			if(!$objReader->canRead($path)){
        				echo '读取错误';
        				return ;
        			}
        		}
        		$objReader->setReadDataOnly(true);
        		$excel=$objReader->load($path);
        		$currentSheet=$excel->getSheet(0);
        		$maxcol=$currentSheet->getHighestColumn();
        		$maxrow=$currentSheet->getHighestRow();
        		$excelData=array();
        		for($row=1;$row<=$maxrow;$row++){
        			for($col='A';$col<=$maxcol;$col++){
        				$address = $col.$row;
        				$excelData[$row][$col]=$currentSheet->getCell($address)->getValue();
        			}
        		}
        		$list[$k]['excel']=$excelData;
        	}       	
        	 	
        	$this->assign('page',$show);
        	$this->assign('list',$list);
        	$this->display();
        	
        }else {
        	$this->error('页面不存在');
        }
    }
}
