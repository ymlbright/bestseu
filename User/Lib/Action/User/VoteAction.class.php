<?php
	class VoteAction extends Action {
		public $Verifycode='';
		public $vtypeid=0;
		public $vcid=0;

		public function Show($type){
			if ($type==1){
				$com = M('community')->where('cstatus = 1')->order('cpoint desc,ccreatetime')->select();
				$this->assign('c',$com);
				$this->display();
			}
		}


		//Check Function
		protected function Initialize(){
			//登录检查
			$this->F_AjaxReturn("投票已经结束.",0);
			if (isset($_SESSION['user_power']) && $_SESSION['user_power'] < 10 ){
				$this->vtypeid = (int)I('post.vtype');
				$this->vcid = (int)I('post.cid');
				$this->Verifycode = I('post.vcode');

				//投票类型检查
				if ( !$this->TypeCheck() ) 
					$this->F_AjaxReturn("投票参数错误!",0);
				//身份检查
				if ( !$this->IdentityCheck() && $this->Verifycode == '')
					$this->F_AjaxReturn("",-1);
			} else {
				$this->F_AjaxReturn("请先登录!",0);
			}
		}

		public function Verify() {
			$stmp = Random(8);
			cookie('id',$stmp);
			session('user_id',$stmp);
			import('ORG.Util.Image');
			Image::buildImageVerify(4,3,'png');
		}

		public function Vote() {
			if (!IS_POST) halt('页面不存在',U('Index/index'));

			//投票组件初始化
			$this->Initialize();

			//投票状态检查
			switch ( $this->VoteCheck(10) ) {
				case 1:
					if ( $this->Verifycode != '' ) {
						//验证码检查
						if ( $_SESSION['verify'] != md5($this->Verifycode) || $_SESSION['user_id'] != $_COOKIE['id'])
							$this->F_AjaxReturn("验证码错误.",0);
					} 
					$this->Add_VoteData();
					$this->F_AjaxReturn("投票成功!",1);
					break;
				case 0:
					$this->F_AjaxReturn("您已经给10个社团点了赞,不能继续投票了.",0);
					break;
				case -1:
					$this->F_AjaxReturn("您已经给这个社团点过赞了.",0);

			}
		}

		protected function F_AjaxReturn($msg,$status){
			$data = array (
				"msg"		=>	$msg,
				"status"	=>	$status
				);
			$this->aJaxReturn($data,'JSON');
			exit(0);
		}

		//检查投票数量,可以继续投票返回1
		protected function VoteCheck($votenum){
			$count = M('vote')->where('uid = ' . $_SESSION['user_uid'] . ' and vtype = ' . $this->vtypeid)->count();
			if ( $count >= $votenum  )
				return 0;//"您已经给10个社团点了赞,不能继续投票了.";
			$num = M('vote')->where('uid = ' . $_SESSION['user_uid'] . ' and vtype = ' . $this->vtypeid .' and cid = '. $this->vcid )->count();
			if ( $num != 0)
				return -1;//$this->F_AjaxReturn("您已经给这个社团点过赞了.",0);

			return 1;
		}

		//判断投票类型,是否关闭
		protected function TypeCheck(){
			switch ( $this->vtypeid ){
				case 1:
					return true;
				default:
					return false;
			}
		}

		//身份校验
		protected function IdentityCheck(){
			$count = M('vote')->where("vip = '".get_client_ip()."'".' and vtype = ' . $this->vtypeid.' and cid='.$this->vcid)->count();
			return $count==0;
		}

		//获得投票用户ID
		private function Get_Voter_IP(){
			return get_client_ip();
		}

		//数据库写函数
		private function Add_VoteData(){
			$vdata = array(
					'vtype'	=>	$this->vtypeid,
					'uid'	=>	$_SESSION['user_uid'],
					'cid'	=>	$this->vcid,
					'vdata'	=>	time(),
					'vip'	=>	$this->Get_Voter_IP(),
					);
			M('vote')->add($vdata);
		}
	}