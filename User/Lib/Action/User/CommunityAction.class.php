<?php
	class CommunityAction extends Action {
		//显示全部社团
		public function index(){
			$this->getcommunity(0,12);
		}
		
		//显示社团列表
		public function Show($type){
			$type = (int)$type;
			$this->getcommunity($type,12);
		}
		
		//显示社团详细信息
		public function ShowDetial($id){
			$id = (int)$id;
			$community = M('community')->where('cid = ' . $id)->select();
			$compic = M('filemap')->where('cid = ' . $id)->select();
			$this->assign('compic',$compic[0]);
			cookie('community_name',$community[0]['cname'],3600);
			$this->assign('community',$community[0])->assign('nav2','active')->display();
		}
		
		//获取社团详细信息
		public function GetDetial(){
			if (!IS_AJAX) halt('页面不存在',U('Index/index'));
			
			$id = I('get.id');
			$id=(int)$id;
			$community = M('community')->where('cid = ' . $id)->select();
			if ($community)
				$this->aJaxReturn($community[0],'json');
		}
		
		//社团报名表显示
		public function SignUp($id){
			$this->assign('cid',(int)$id)->assign('nav2','active')->display();
		}
		
		//报名表提交\修改
		public function Submit($type){
			if (!IS_POST) halt('页面不存在',U('Index/index'));
			if (!isset($_SESSION['user_power'])) $this->aJaxReturn(array('status'=> -3),'json');

			//校验函数在 students_signup1  students_signup1_change 函数内
			if ($type=='1') $this->aJaxReturn(array('status'=>students_signup1()),'json');
			if ($type=='2') $this->aJaxReturn(array('status'=>students_signup1_change()),'json');
		}
		
		//普通用户查看报名表
		public function SignUpDetial($id){
			$this->assign('cid',$id)->assign('nav2','active')->display();
		}
		
		//获取报名信息
		public function GetSignUpDetial($cid){
			$result = get_students_signup1($cid);
			if ($result){
				$this->aJaxReturn( array( 'json' => $result['json'], 'name' => a_getcname($result['result']['cid']), 'suggestion' => $result['result']['ssuggestion'] , 'status' =>	 $result['result']['sstatus'] ),'json');
			}
			$this->aJaxReturn('','json');
		}
		
		//删除报名表
		public function DelSignUp($cid){
			if (!IS_POST) halt('页面不存在',U('Index/index'));
			$cid = (int)$cid;
			$result = M('signup')->where('cid = ' . $cid . ' and uid = ' . $_SESSION['user_uid'])->select();
			unlink('./Data/'.$result[0]['spath']);
			if ( M('signup')->where('cid = ' . $cid . ' and uid = ' . $_SESSION['user_uid'])->delete() )
				$this->assign('del',1)->display();
			else
				$this->display();
		}
		
		//普通用户获取申请表信息
		public function ShowSignUp(){
			if (isset($_SESSION['user_power']) && $_SESSION['user_power'] < 10 ){
				$result = M('signup')->where('uid = ' . $_SESSION['user_uid'])->select();
				$this->signup = $result;
				$result = M('approval')->where('atype = 11 and acontent2 = ' . $_SESSION['user_uid']);
				$this->display();
			}
			else
				halt('页面不存在',U('Index/index'));
		}
		
		//社团显示模块
		private function getcommunity($type,$n){
			$data = M('community'); // 实例化Data数据对象
    		import('ORG.Util.Page');// 导入分页类
			$count = $type==0 ? $data->where('cstatus = 1')->count() : $data->where('ctype = ' . $type . ' and cstatus = 1')->count();
			$page = new Page($count,$n);
			$show = $page->show(); //分页显示输出
			if($type==0)
				$community = $data->where('cstatus = 1')->order('cpoint desc,ccreatetime')->limit($page->firstRow.','.$page->listRows)->select();
			else
				$community = $data->where('ctype = ' . $type . ' and cstatus = 1')->order('cpoint desc,ccreatetime')->limit($page->firstRow.','.$page->listRows)->select();
			$this->page = $show;
			$this->community = $community;
			
			$this->assign('tab' . $type ,'active')->assign('nav2','active')->display('index');
			
		}
	}