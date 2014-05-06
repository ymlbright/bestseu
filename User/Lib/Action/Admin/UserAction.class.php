<?php
class UserAction extends CommonAction {
    public function index(){
    	$re = $this->get_user_table_page();
    	$this->assign('user',$re['user'])->assign('page',$re['page']);
		$this->assign('nav2','active')->display();
    }

    public function del($id){
    	if ($id != '')
    		M('user')->where('uid ='.(int)$id)->delete();
    	$this->success('删除成功');
    }

    public function add(){
    	$data = I('post.');
    	$data['pwd']=md5($data['pwd']);
    	if (M('user')->where('ykt = '.(int)$data['ykt'])->select())
    		$this->aJaxReturn(array('status'=>-1),'json');
    	if (M('user')->add($data))
    		$this->aJaxReturn(array('status'=>1),'json');
    	else
    		$this->aJaxReturn(array('status'=>0),'json');
    }

    private function get_user_table_page(){
		$data = M('user'); // 实例化Data数据对象
    	import('ORG.Util.Page');// 导入分页类
		$count = $data->where('power < 100')->count();
		$page = new Page($count,30);
		$show = $page->show(); //分页显示输出
		$user = $data->order('uid')->where('power < 100')->limit($page->firstRow.','.$page->listRows)->select();
		return array('page' => $show,'user' =>$user);
	}
}