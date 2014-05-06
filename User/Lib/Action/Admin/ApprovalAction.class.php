<?php
class ApprovalAction extends CommonAction {
    public function index(){
    	$re = $this->get_approval_table_page();
    	$this->assign('approval',$re['approval'])->assign('page',$re['page']);
		$this->assign('nav4','active')->display();
    }

	public function del($id){
    	if ($id != ''){
    		$result = M('approval')->where('aid = '.(int)$id)->select();
			unlink('./Data/'.$result[0]['apath']);
			M('approval')->where('aid = ' . $result[0]['aid'])->delete();
    	}
    	$this->success('删除成功');
    }

    public function edit($id){
    	if ($id != ''){
    		$result = M('approval')->where('aid = '.(int)$id)->select();
    		$result[0]['astatus']='U';
    		M('approval')->save($result[0]);
    	}
    	$this->success('初始化成功');
    }

    private function get_approval_table_page(){
		$data = M('approval'); // 实例化Data数据对象
    	import('ORG.Util.Page');// 导入分页类
		$count = $data->count();
		$page = new Page($count,30);
		$show = $page->show(); //分页显示输出
		$approval = $data->order('aid desc')->limit($page->firstRow.','.$page->listRows)->select();
		return array('page' => $show,'approval' =>$approval);
	}
}