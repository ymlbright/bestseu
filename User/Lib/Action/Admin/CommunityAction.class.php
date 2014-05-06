<?php
class CommunityAction extends CommonAction {
    public function index(){
    	$re = $this->get_community_table_page();
    	$this->assign('community',$re['community'])->assign('page',$re['page']);
		$this->assign('nav3','active')->display();
    }

	public function del($id){
    	if ($id != '')
    		M('community')->where('cid ='.(int)$id)->delete();
    	$this->success('删除成功');
    }

    public function add(){
    	$data = I('post.');
        $data['cstatus']=1;
        $tmp=explode("-",$data['ccreatetime']);
        $data['ccreatetime']=mktime(0,0,0,$tmp[1],$tmp[2],$tmp[0]);
    	if (M('community')->add($data))
    		$this->aJaxReturn(array('status'=>1),'json');
    	else
    		$this->aJaxReturn(array('status'=>0),'json');
    }

    public function get(){
    	$id = (int)I('post.id');
    	if ($id){
	    	$re = M('community')->where('cid = '.$id)->select();
            $re[0]['ccreatetime']=date('Y-m-d',$re[0]['ccreatetime']);
	    	$this->aJaxReturn($re[0],'json');
    	}
    }

    public function edit(){
    	if (IS_POST){
    		$data = I('post.');
            $tmp=explode("-",$data['ccreatetime']);
            $data['ccreatetime']=mktime(0,0,0,$tmp[1],$tmp[2],$tmp[0]);
    		if(M('community')->save($data))
    			$this->aJaxReturn(array('status'=>1),'json');
    	}
    	$this->aJaxReturn(array('status'=>0),'json');
    }

    public function hide($id){
    	if ($id){
	    	$re = M('community')->where('cid = '.(int)$id)->select();
	    	if ($re[0]['cstatus']==1){
		    	$re[0]['cstatus']=0;
		    	M('community')->save($re[0]);
		    }
    	}
    	$this->success('隐藏成功');
    }

    public function show($id){
    	if ($id){
	    	$re = M('community')->where('cid = '.(int)$id)->select();
	    	$re[0]['cstatus']=1;
	    	if (M('community')->save($re[0]))
	    		$this->success('显示成功');
    	}
    	$this->error('显示失败');
    }	

    public function lock($id){
    	if ($id){
	    	$re = M('community')->where('cid = '.(int)$id)->select();
	    	if ($re[0]['cstatus']==1){
		    	$re[0]['cstatus']=2;
		    	M('community')->save($re[0]);
		    	$re = M('user')->where('xh = '.(int)$id)->select();
		    	$re[0]['power']=0;
		    	if (M('user')->save($re[0]))
		    		$this->success('锁定成功');
		    }
    	}
    	$this->error('锁定失败');
    }

    public function unlock($id){
    	if ($id){
	    	$re = M('community')->where('cid = '.(int)$id)->select();
		    $re[0]['cstatus']=1;
		    M('community')->save($re[0]);
		    $re = M('user')->where('xh = '.(int)$id)->select();
		    $re[0]['power']=30;
		    if(M('user')->save($re[0]))
		    	$this->success('解锁成功');
    	}
    	$this->error('解锁失败');
    }

    private function get_community_table_page(){
		$data = M('community'); // 实例化Data数据对象
    	import('ORG.Util.Page');// 导入分页类
		$count = $data->count();
		$page = new Page($count,30);
		$show = $page->show(); //分页显示输出
		$community = $data->order('cid')->limit($page->firstRow.','.$page->listRows)->select();
		return array('page' => $show,'community' =>$community);
	}
}