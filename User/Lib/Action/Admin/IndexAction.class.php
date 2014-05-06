<?php
class IndexAction extends Action {
    public function index(){
    	if ($_SESSION['power']==100)
			$this->assign('nav1','active')->display();
		else
			$this->redirect('/Admin/Index/login');
    }
	
	public function login(){
		$this->display();
	}

	public function logout(){
		session('[destroy]');
		$this->redirect('/Admin');
	}

	public function Verify(){
		import('ORG.Util.Image');
		Image::buildImageVerify(4,3,'png');
	}

	public function check(){
		$user = I('post.user');
		$pwd = I('post.pwd');
		if (!ctype_alnum($user) || !ctype_alnum($pwd)) $this->aJaxReturn(array('status'=>0),'json');
		if ($_SESSION['verify'] != md5(I('post.vcode')) ) $this->aJaxReturn(array('status'=>-1),'json');
		if (md5(I('post.vcode')) == $_SESSION['vcode'])  $this->aJaxReturn(array('status'=>-1),'json');

		$result = M('user')->where("ykt = '".$user."'")->select();
		if ($result && $result[0]['pwd'] == md5($pwd) && $result[0]['power']==100) {
			session('power',$result[0]['power']);
			$data = array(
				'uid'		=>	$result[0]['uid'],
				'logintime'	=>	time(),
				'loginip'	=>	get_client_ip(),
			);
			M('user')->save($data);
			$this->aJaxReturn(array('status'=>1),'json');
		}
		session('vcode',$_SESSION['verify']);
		$this->aJaxReturn(array('status'=>0),'json');
	}
}