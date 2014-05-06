<?php
class PrintAction extends Action {
    public function index(){
		$this->display();
    }
	
//显示细节页面
		public function ShowDetial($type,$gp,$index,$da){
			switch ($gp){
			case 1:
				$this->redirect('/Login/index?relogin=0');
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
							$this->assign('json',str_replace('"','\'',$re['json']))->assign('result',$re['result']);
							$this->display('Print:type2_'.$index);
						}
						return;
				}
				$this->display('Print:type2_'.$type.'_'.$index);
				break;
			case 3:
				if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<50) $this->redirect('/Login/index?relogin=1');
				$type=(int)$type;
				$re = get_approval_aid($da);
				if ($re){
					$this->assign('json',str_replace('"','\'',$re['json']))->assign('result',$re['result']);
					$this->display('Print:type2_'.$index);
					break;
				}
			default:
				$this->display('Print:index');
			}
		}
}