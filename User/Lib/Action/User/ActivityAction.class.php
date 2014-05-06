<?php
	class ActivityAction extends Action {
		public function index(){
			$data = M('approval'); // 实例化Data数据对象
    		import('ORG.Util.Page');// 导入分页类
			$count = $data->where("astatus = 'P' and acontent5 = aname")->count();
			$page = new Page($count,20);
			$show = $page->show(); //分页显示输出
			$activity = $data->where("astatus = 'P' and acontent5 = aname")->order('aid desc')->limit($page->firstRow.','.$page->listRows)->select();
			for ($i= 0;$i< count($activity); $i++){
				$tmp = $data->where("aidentifier = '".$activity[$i]['aidentifier']."' and atype=24 and acontent2 <> ''")->select();
				if ($tmp) 
					$activity[$i]['acontent2'] = $tmp[0]['acontent2'];
				else
					$activity[$i]['acontent2'] = time();
				$tmp = $data->where("aidentifier = '".$activity[$i]['aidentifier']."' and acontent1 <> ''")->select();
				if ($tmp) 
					$activity[$i]['acontent1'] = $tmp[0]['acontent1'];
				else
					$activity[$i]['acontent1'] = '暂无';
			}
			$this->page = $show;
			$this->activity = $activity;
			$this->assign('nav3','active')->display();
		}

		public function edit($id){
			if ( $_SESSION['user_power'] < 49 ) $this->redirect('/index');
			$this->assign('id',htmlspecialchars($id));
			$this->show();
		}

		public function submit(){
			$id = (int)I('post.id');
			$disc = I('post.disc');
			$tmp = explode("-",I('post.time'));
			$time=mktime(0,0,0,$tmp[1],$tmp[2],$tmp[0]);
			$re=M('approval')->where("aidentifier =".$id." and acontent5 = aname")->select();
			if ($re){
				$re[0]['acontent1']=$disc;
				M('approval')->save($re[0]);
			}
			$re=M('approval')->where("aidentifier =".$id." and atype=24")->select();
			if ($re){
				$re[0]['acontent2']=$time;
				M('approval')->save($re[0]);
			}
			$this->redirect('/Activity/index');
		}
	}