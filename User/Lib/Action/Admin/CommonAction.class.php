<?PHP
class CommonAction extends Action{
	public function _initialize(){
		if ($_SESSION['power']!=100)
			$this->redirect('/Admin/Index/login');
	}
}