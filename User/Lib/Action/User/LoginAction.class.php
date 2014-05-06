<?php
	class LoginAction extends Action {
		public function index($relogin){
			if ($relogin==1)
				$this->assign('msg','您的权限不足或未登录.');
			else
				$this->assign('msg','请先登录.');
			$this->display();
		}
		
		//验证码
		public function Verify(){
			import('ORG.Util.Image');
			Image::buildImageVerify(4,3,'png');
		}
		
		//登录
		public function Login(){
			if (!IS_AJAX) halt('页面不存在',U('Index/index'));
			$user = I('post.user');
			$pwd = I('post.pwd');
			if ($this->login_f($user,$pwd,90))
				$this->aJaxReturn(array('status'=>1),'json');
			else {
				preg_match("/^\d{9}$/",$user,$ret);
				if ($ret)
					$this->aJaxReturn(array('status'=>2),'json');
				else
					$this->aJaxReturn(array('status'=>0),'json');
			}
		}
		
		//注册
		public function Sign(){
			if (!IS_AJAX) halt('页面不存在',U('Index/index'));
			$user = I('post.user');
			$pwd = I('post.pwd');
			$this->aJaxReturn(array('status'=>$this->sign_f($user,$pwd)),'json');
		}
		
		//退出登录
		public function Logout(){
			session('[destroy]');
			U('/','','',1);
		}
		
		//登录模块
		private function login_f($user,$pwd,$power){
			if (!ctype_alnum($user) || !ctype_alnum($pwd)) return false;
			$result = M('user')->where("ykt = '".$user."'")->select();
			if ($result && $result[0]['power']<=$power && $result[0]['pwd'] == md5($pwd) && $result[0]['power']!=0 ) {
				$this->session_reg($result[0]);
				$data = array(
					'uid'		=>	$result[0]['uid'],
					'logintime'	=>	time(),
					'loginip'	=>	get_client_ip(),
				);
				M('user')->save($data);
				return true;
			}
			else 
				return false;
		}
		
		//用户密码验证模块
		private function login_check($user,$pwd){
			$post_data = array(   
				'ctl00$ScriptManager1'	=>	'ctl00$cphSltMain$UpdatePanel1|ctl00$cphSltMain$UserLogin1$btnLogin',
              	'__EVENTTARGET'			=>	'',
				'__EVENTARGUMENT'		=>	'',
				'__LASTFOCUS'			=>	'',
             	'__VIEWSTATE'			=>'/wEPDwUKLTQ4NDQyNDg4Nw9kFgJmD2QWAgIDD2QWBAIHD2QWAgIBD2QWAmYPZBYCAgEPZBYCAgQPZBYEAgEPEGRkFgFmZAIDDw8WAh4EVGV4dAUM5Y2h44CA5Y+377yaZGQCCQ9kFgICAg88KwAJAQAPFgQeCERhdGFLZXlzFgAeC18hSXRlbUNvdW50AgFkFgJmD2QWAgIBDw8WAh8ABZMB5a2m5Lmg6L+H56iL5Lit77yM5ZCM5a2m5Lus5aaC5pyJ6Zeu6aKY6ZyA5LiO5a6e6aqM5Lit5b+D5oiW5Lu76K++5pWZ5biI6IGU57O777yM6K+35LuO6aaW6aG16L+b5YWl4oCc55WZ6KiA5p2/4oCd55WZ6KiA77yM5oiR5Lus5Lya5Y+K5pe25YWz5rOo44CCZGRkKxkEVLSbsP4Q89+B39eC0gAAAAA=',
              	'ctl00$cphSltMain$UserLogin1$rblUserType'	=>	'Stu',
              	'ctl00$cphSltMain$UserLogin1$txbUserCodeID'	=>	$user,
              	'ctl00$cphSltMain$UserLogin1$txbUserPwd'	=>	$pwd,
             	'__EVENTVALIDATION'							=>	'/wEWBwKR4pj0BwKGz+fmBQLWi8GnBALIoPqxBgL6uOCYDALS7JivDAKPku6gDmbTgOYVut4URau4qec7eVYAAAAA',
              	'ctl00$cphSltMain$UserLogin1$btnLogin'		=>	'登录'
			); 
			
			$re = send_post("http://phylab.seu.edu.cn/plms/UserLogin.aspx?ReturnUrl=%2fplms%2fSelectLabSys%2fDefault.aspx",$post_data);
			return false == strpos($re,"用户名或密码错误");
		}
		
		//个人信息抓去模块
		private function login_profile($user,$pwd){
			$data = array(
				'ykt'		=>	$user,
				'xh'		=>	'',
				'name'		=>	'',
				'pwd'		=>	md5($pwd),
				'logintime'	=>	time(),
				'loginip'	=>	get_client_ip(),
				'power'		=>	5
			);
			$post_data = array(
				'returnStr'			=>	'',
				'queryStudentId'	=>	$user,
				'queryAcademicYear'	=>	'13-14-1'
			);
			
			$re = send_post("http://xk.urp.seu.edu.cn/jw_service/service/stuCurriculum.action",$post_data);
			
			if ( $p = strpos($re, "学号:") )
				$data['xh'] = substr($re,$p + 7,8);
			else
				return null;
			if ( $p = strpos($re, "姓名:") ){
				$p2 = strpos($re,"</td>",$p);
				$data['name'] = substr($re,$p +7,$p2 - $p - 7);	
				return $data;
			}
			return null;
		}
		
		//用户注册模块
		private function sign_f($user,$pwd){
			if ( $this->login_check($user,$pwd) ){
				if ( $data = $this->login_profile($user,$pwd) ){
					$re = M('user')->where('ykt = '.$user)->select();
					if ( $re ){
						M('user')->save(array_merge($data,array('uid' => $re[0]['uid'])));
						$this->session_reg($re[0]);
					}
					else{
						$re = M('user')->add($data);
						$this->session_reg_full($re,$data['xh'],$data['ykt'],$data['name'],$data['power']);
					}
					return 1;
				}
				return 2;
					
			}
			return 0;
		}
		
		//SESSION注册模块
		private function session_reg($result){
			session('user_uid',$result['uid']);
			session('user_xh',$result['xh']);
			session('user_ykt',$result['ykt']);
			session('user_name',$result['name']);
			session('user_power',$result['power']);
		}
		private function session_reg_full($uid,$xh,$ykt,$name,$power){
			session('user_uid',$uid);
			session('user_xh',$xh);
			session('user_ykt',$ykt);
			session('user_name',$name);
			session('user_power',$power);
		}
	}