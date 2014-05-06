<?php
	class OfficeAction extends Action {
		//办公主页
		public function index(){
			$this->assign('nav4','active')->display();
			$this->display('Office:typeindex');
			$this->display('Office:footer');
		}
		
		//显示页面
		public function Show($type,$gp){
			switch ((int)$gp){
			case 1:
				if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<1) $this->redirect('/Login/index?relogin=0');
				$type=(int)$type;
				switch ($type){
					case 2:
						$this->vdata = str_replace('"','\'',json_encode(GetVote(1)));
						break;
				}
				$this->assign('type1_'.$type,'active')->assign('nav4','active')->display('index');
				$this->display('Office:type1_'.$type);
				$this->display('Office:footer');
				break;
			case 2:
				if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<20) $this->redirect('/Login/index?relogin=1');
				$type=(int)$type;
				switch ($type){
				case 9:
						$re = M('filemap')->where('cid = '.$_SESSION['user_xh'])->select();
						if ($re) $this->assign('cpic' ,$re[0]);
						break;
				case 11:
						$re = get_signup_table_page($_SESSION['user_xh']);
						$this->assign('signup',$re['signup'])->assign('page',$re['page']);break;
				case 12:
						$re = get_approval_table_page($_SESSION['user_xh']);
						$this->assign('approval',$re['approval'])->assign('page',$re['page']);break;
				}
				$this->assign('type2_'.$type,'active')->assign('nav4','active')->display('index');
				$this->display('Office:type2_'.$type);
				$this->display('Office:footer');
				break;
			case 3:
				if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<50) $this->redirect('/Login/index?relogin=1');
				$type=(int)$type;
				$re = get_approval_table_by_type_page($type);
				$this->assign('approval',$re['approval'])->assign('page',$re['page']);
				$this->assign('type3_'.$type,'active')->assign('nav4','active')->display('index');
				$this->display('Office:type3_'.$type);
				$this->display('Office:footer');
				break;
			default:
				$this->assign('nav4','active')->display();
				$this->display('Office:typeindex');
				$this->display('Office:footer');
			}
		}
		
		//显示细节页面
		public function ShowDetial($type,$gp,$index,$da){
			switch ($gp){
			case 1:
				if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<1) $this->redirect('/Login/index?relogin=0');
				$type=(int)$type;
				$this->assign('type1_'.$type,'active')->assign('nav4','active')->display('index');
				$this->display('Office:type1_'.$type.'_'.$index);
				$this->display('Office:footer');
				break;
			case 2:
				if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<20) $this->redirect('/Login/index?relogin=1');
				$type=(int)$type;
				switch ($type){
				case 11:
						$re = get_students_signup1_sid($da);
						if ($re)
							$this->assign('json',str_replace('"','\'',$re['json']))->assign('result',$re['result']);
						break;
				case 12:
						$re = get_approval_aid($da);
						if ($re){
							$this->assign('json',str_replace('"','\'',$re['json']))->assign('result',$re['result'])->assign('review',1);
							$this->assign('type2_'.$type,'active')->assign('nav4','active')->display('index');
							$this->display('Office:type2_'.$index);
							$this->display('Office:footer');
						}
						return;
				}
				$this->assign('type2_'.$type,'active')->assign('nav4','active')->display('index');
				$this->display('Office:type2_'.$type.'_'.$index);
				$this->display('Office:footer');
				break;
			case 3:
				if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<50) $this->redirect('/Login/index?relogin=1');
				$type=(int)$type;
				$re = get_approval_aid($da);
				if ($re){
					$this->assign('json',str_replace('"','\'',$re['json']))->assign('result',$re['result'])->assign('check',1)->assign('review',1);
					$this->assign('type2_'.$type,'active')->assign('nav4','active')->display('index');
					$this->display('Office:type2_'.$index);
					$this->display('Office:footer');
					break;
				}
			default:
				$this->assign('nav4','active')->display();
				$this->display('Office:typeindex');
				$this->display('Office:footer');
			}
		}
		
		//表格提交
		public function Submit($type,$gp){
			if (!IS_POST) halt('页面不存在',U('Index/index'));
			$functionname = "table_type".(int)$gp."_".(int)$type;
			switch ($gp){
				case 1:
					if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<1) $this->redirect('/Login/index?relogin=0');break;
				case 2:
					if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<20) $this->redirect('/Login/index?relogin=1');break;
				case 3:
					if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<50) $this->redirect('/Login/index?relogin=1');break;
			}
			if (function_exists($functionname)) {
				$data = array(
					'type'		=>	$type,
					'gp'		=>	$gp,
					'status'	=>	$functionname()
					);
				$this->aJaxReturn($data,'JSON');
			} else
				halt('页面不存在',U('Index/index'));
		}
		
		//社团审核报名表
		public function SignUp($id){
			if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<20) $this->redirect('/Login/index?relogin=1');
			$id=(int)$id;
			$result = M('signup')->where('sid = '.$id.' and cid = '.$_SESSION['user_xh'])->select();
			if ( $result ){
				$action = (int)I('post.action');
				if ( $action == 1 )
					$result[0]['sstatus'] = 1;
				else 
					$result[0]['sstatus'] = 2;
				$result[0]['ssuggestion'] = I('post.suggestion');
				if ( M('signup')->save($result[0]) ){
					echo "操作成功.";
					return ;
				}
			}
			echo "系统出现错误了!";
		}
		
		//获取社团报名表信息
		public function GetSignUp($id){
			if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<20) $this->redirect('/Login/index?relogin=1');
			$result = get_students_signup1_sid($id);
			if ($result){
				$this->aJaxReturn( array( 'json' => $result['json'], 'name' => a_getcname($result['result']['cid']), 'suggestion' => $result['result']['ssuggestion'] , 'status' =>	 $result['result']['sstatus'] ),'json');
			}
			$this->aJaxReturn('','json');
		}
		
		//修改申请表
		public function ReSubmit($type,$gp,$id){
			if (!IS_POST) halt('页面不存在',U('Index/index'));
			
			if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<20) $this->redirect('/Login/index?relogin=1');
			
			//对状态校验在  table_type_change 函数内
			$data = array(
				'type'		=>	$type,
				'gp'		=>	$gp,
				'status'	=>	table_type_change($id)
				);
			$this->aJaxReturn($data,'JSON');
		}
		
		//团联审核申请表
		public function Check(){
			if (!IS_POST) halt('页面不存在',U('Index/index'));
			if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<50) $this->redirect('/Login/index?relogin=1');
			
			$id = I('post.id');
			$type = I('post.type');
			$data = array(
				'aid'		=>	(int)$id,
				'asuggestion'	=>	chrTrans(I('post.s')),
				'astatus'	=>	'U'
			);
			switch($type){
				case 1:
					$data['astatus']='P';break;
				case 2:
					$data['astatus']='O';break;
				case 3:
					$data['astatus']='D';break;
				case 0:
					$data['astatus']='R';break;
			}
			if ( M('approval')->save($data) )
				$this->aJaxReturn(array('status' => 1),'JSON');
			$this->aJaxReturn(array('status' => 0),'JSON');	
		}
		
		//删除申请表
		public function DelTable(){
			if (!IS_POST) halt('页面不存在',U('Index/index'));
			if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<20) $this->redirect('/Login/index?relogin=1');
			$id=(int)I('post.id');
			$result = M('approval')->where('aid = '.(int)$id)->select();
			if ( $_SESSION['user_power']>=50 || $result[0]['cid'] == $_SESSION['user_xh']) { 
				unlink('./Data/'.$result[0]['apath']);
				M('approval')->where('aid = ' . $result[0]['aid'])->delete();
				$this->aJaxReturn(array('status'=>1),'JSON');
			}
			$this->aJaxReturn(array('status'=>0),'JSON');
		}
	}