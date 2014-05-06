<?php
class HelpAction extends Action {
    public function index(){
		$this->assign('nav5','active')->display();
    }
}