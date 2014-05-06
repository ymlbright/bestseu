<?php
class IndexAction extends Action {
    public function index(){
		$this->assign('nav1','active')->display();
    }
	
	public function login(){
		session(array('expire'=>3600,'domain'=>'127.0.0.1'));
		session('user_name','ymlbright');
		$this->display('index');
	}
}