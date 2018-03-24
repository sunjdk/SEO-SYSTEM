<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/20 0020
 * Time: 11:52
 */
namespace Seo\Controller;

use Common\Controller\AdminbaseController;
use Think\Upload;
use Think\Exception;
class AdminSeoController extends AdminbaseController{
	protected $SeoModel;
	
	public function _initialize() {
		parent::_initialize();
		$this->SeoModel = D("Seo");		
	}

    public function index(){
        if(IS_GET){
        	$db=$this->SeoModel;
        	$this->list=$db->select();
        	$this->display();
        }else {
        	$this->error('页面不存在');
        }
    }
    public function add(){
        $this->display();
    }
    public function add_post(){
    	if(IS_POST){
    		$db=$this->SeoModel;
    		if($db->create()!==false){
    			$result=$db->add();
    			if($result){
    				$this->success('添加成功',U('index'));
    			}else{
    				$this->error('添加失败');
    			}
    		}else{
    			$this->error($db->getError());
    		}    		
    	}else{
    		$this->error('页面不存在！');
    	}    	
    }
	//异步上传excel处理
    public function synUpload(){
        $fileUpload=new Upload();
        $fileUpload->exts=array('xls','xlsx');
        $fileUpload->type='application/vnd.ms-excel';
        $fileUpload->size=1024*1024*8;
        $fileUpload->rootPath='./Uploads/';
        $fileUpload->savePath='';
        $fileUpload->saveName=array('uniqid','');
        $fileUpload->autoSub=true;
        $fileUpload->subName=array('date','Ymd');
        $info=$fileUpload->upload();
        if(!$info){
        	$this->ajaxReturn(array('status'=>0,'msg'=>$fileUpload->getError(),'value'=>NULL));
        }else{        	
			$this->ajaxReturn(array('status'=>1,'msg'=>'success','value'=>$fileUpload->rootPath.$info['file']['savepath'].$info['file']['savename']));
        }
    }
}
