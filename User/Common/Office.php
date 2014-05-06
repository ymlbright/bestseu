<?PHP
		//活动ID检查
		function actID_check($id){
			$re = M('approval')->where('adate = '.(int)$id)->select();
			if ($re)
				return $re[0]['adate'];
			else
				return '';
		}

		//回车字符过滤
		function chrTrans($str){
			return str_replace("\r\n", "\\r\\n", $str);
		}

		//常规活动申请提交 21
		function table_type2_1(){
			if ( $_SESSION['user_power'] < 10 || $_SESSION['user_power'] > 50) return -1;	//只有社团管理员可以提交表单
			$json = I('post.');
			$filename = save_json2file($json);
			$ch = time();
			if ( $filename ){
				$data = array(
					'cid'			=>	$_SESSION['user_xh'],
					'aidentifier'	=>	$ch,
					'adate'			=>	$ch,
					'atype'			=>	21,
					'apath'			=>	$filename,
					'astatus'		=>	'U',
					'aname'			=>	$json['hdmc'],
					'acontent5'		=>	$json['hdmc']
				);
				if (M('approval')->add($data))
					return 1;			//添加申请成功
			}
			return 0;		//添加申请失败
		}
		
		//电子屏申请提交  22
		function table_type2_2(){
			if ( $_SESSION['user_power'] < 10 || $_SESSION['user_power'] > 50) return -1;	//只有社团管理员可以提交表单
			$json = I('post.');
			$json['hdcd']=chrTrans($json['hdcd']);
			$ch = actID_check($json['hdid']);
			if ($ch == '') return -2;
			$filename = save_json2file($json);
			if ( $filename ){
				$data = array(
					'cid'			=>	$_SESSION['user_xh'],
					'aidentifier'	=>	$ch,
					'adate'			=>	time(),
					'atype'			=>	22,
					'apath'			=>	$filename,
					'astatus'		=>	'U',
					'aname'			=>	$json['hdmc']
				);
				if (M('approval')->add($data))
					return 1;			//添加申请成功
			}
			return 0;		//添加申请失败
		}
		
		//活动经费审批提交 23
		function table_type2_3(){
			if ( $_SESSION['user_power'] < 10 || $_SESSION['user_power'] > 50) return -1;	//只有社团管理员可以提交表单
			$json = I('post.');
			$ch = actID_check($json['hdid']);
			if ($ch == '') return -2;
			$filename = save_json2file($json);
			if ( $filename ){
				$data = array(
					'cid'			=>	$_SESSION['user_xh'],
					'aidentifier'	=>	$ch,
					'adate'			=>	time(),
					'atype'			=>	23,
					'apath'			=>	$filename,
					'astatus'		=>	'U',
					'aname'			=>	$json['hdmc']
				);
				if (M('approval')->add($data))
					return 1;			//添加申请成功
			}
			return 0;		//添加申请失败
		}
		
		//室内活动场地申请提交 24
		function table_type2_4(){
			if ( $_SESSION['user_power'] < 10 || $_SESSION['user_power'] > 50) return -1;	//只有社团管理员可以提交表单
			$json = I('post.');
			$ch = actID_check($json['hdid']);
			if ($ch == '') return -2;
			$filename = save_json2file($json);
			if ( $filename ){
				$data = array(
					'cid'			=>	$_SESSION['user_xh'],
					'aidentifier'	=>	$ch,
					'adate'			=>	time(),
					'atype'			=>	24,
					'apath'			=>	$filename,
					'astatus'		=>	'U',
					'aname'			=>	$json['hdmc'],
					'acontent2'		=>  strtotime($json['sj'])
				);
				if (M('approval')->add($data))
					return 1;			//添加申请成功
			}
			return 0;		//添加申请失败
		}
		
		//室外活动场地申请提交 25
		function table_type2_5(){
			if ( $_SESSION['user_power'] < 10 || $_SESSION['user_power'] > 50) return -1;	//只有社团管理员可以提交表单
			$json = I('post.');
			$json['qtsm']=chrTrans($json['qtsm']);
			$ch = actID_check($json['hdid']);
			if ($ch == '') return -2;
			$filename = save_json2file($json);
			if ( $filename ){
				$data = array(
					'cid'			=>	$_SESSION['user_xh'],
					'aidentifier'	=>	$ch,
					'adate'			=>	time(),
					'atype'			=>	25,
					'apath'			=>	$filename,
					'astatus'		=>	'U',
					'aname'			=>	$json['hdmc'],
					'acontent2'		=>  strtotime($json['hdsj'])
				);
				if (M('approval')->add($data))
					return 1;			//添加申请成功
			}
			return 0;		//添加申请失败
		}
		
		//宣传场地申请提交 26
		function table_type2_6(){
			if ( $_SESSION['user_power'] < 10 || $_SESSION['user_power'] > 50) return -1;	//只有社团管理员可以提交表单
			$json = I('post.');
			$ch = actID_check($json['hdid']);
			if ($ch == '') return -2;
			$filename = save_json2file($json);
			if ( $filename ){
				$data = array(
					'cid'			=>	$_SESSION['user_xh'],
					'aidentifier'	=>	$ch,
					'adate'			=>	time(),
					'atype'			=>	26,
					'apath'			=>	$filename,
					'astatus'		=>	'U',
					'aname'			=>	$json['hdmc']
				);
				if (M('approval')->add($data))
					return 1;			//添加申请成功
			}
			return 0;		//添加申请失败
		}
		
		//社团信息修改
		function table_type2_8(){
			if ( $_SESSION['user_power'] < 10 || $_SESSION['user_power'] > 50) return -1;	//只有社团管理员可以提交表单
			$data = array(
				'cid' 		=> 	$_SESSION['user_xh'],
				'cchairman'	=>	I('post.xrzx'),
				'ccontact'	=>	I('post.lxfs'),
				'cbrief'	=>	I('post.jj'),
				);
			if ( M('community')->save($data) )
				return 1;	//修改成功
			else
				return 0;	//修改失败
		}
		
		//密码修改
		function table_type2_10(){
			$cid = $_SESSION['user_xh'];
			$pwdold = I('post.ymm');
			$pwdnew = I('post.xmm');
			$result = M('user')->where('xh = '.$cid)->select();
			if ($result){
				if ( md5($pwdold) == $result[0]['pwd']){
					$result[0]['pwd'] = md5($pwdnew);
					if ( M('user')->save($result[0]) )
						return 2;	//修改成功
				}else
					return 1;	//密码错误
			}
			return 0;	//不存在的用户
		}

		//文体专项 29
		function table_type2_13(){
			if ( $_SESSION['user_power'] < 10 || $_SESSION['user_power'] > 50) return -1;	//只有社团管理员可以提交表单
			$json = I('post.');
			$json['wlryhzz']=chrTrans($json['wlryhzz']);
			$json['hdyyjyqxg']=chrTrans($json['hdyyjyqxg']);
			$json['hdnr']=chrTrans($json['hdnr']);
			$json['bz']=chrTrans($json['bz']);
			$ch = time();
			$filename = save_json2file($json);
			if ( $filename ){
				$data = array(
					'cid'			=>	$_SESSION['user_xh'],
					'aidentifier'	=>	$ch,
					'adate'			=>	$ch,
					'atype'			=>	29,
					'apath'			=>	$filename,
					'astatus'		=>	'U',
					'aname'			=>	$json['hdmc'],
					'acontent2'		=>  strtotime($json['hdsj']),
					'acontent5'		=>  $json['hdmc']
				);
				if (M('approval')->add($data))
					return 1;			//添加申请成功
			}
			return 0;		//添加申请失败
		}
		
		//社团申请表修改处理函数
		function table_type_change($aid){
			$result = M('approval')->where('aid = '.(int)$aid.' and cid = '.$_SESSION['user_xh'])->select();
			$json = I('post.');
			$ch = actID_check($json['hdid']);
			if ($ch == '') return -2;
			if (!$result[0]) return -11;

			//禁止修改已申请的活动
			if ($result[0]['astatus']!='U') return -11;
			$result[0]['aidentifier']=$ch;
			unlink('./Data/'.$result[0]['apath']);
			
			$filename = save_json2file($json);
			$result[0]['adate'] = time();
			$result[0]['apath'] = $filename;
			switch($result[0]['atype']){
				case 29:
					$result[0]['acontent2'] = strtotime($json['hdsj']);
				case 21: 
					$result[0]['acontent5'] = $json['hdmc'];
				case 22:
				case 23:
				case 26:
					$result[0]['aname'] = $json['hdmc'];
					break;
				case 24:
				case 25:
					$result[0]['aname'] = $json['hdmc'];
					$result[0]['acontent2'] = strtotime($json['hdsj']);
					break;
			}
			
			if ( M('approval')->save($result[0]) )
				return 11;
			return 10;
		}
		
		//头像文件名生成函数
		function FileName_cid(){
			return $_SESSION['user_xh'];
		}
		
		function Random($length) {
			$hash = '';
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
			$max = strlen($chars) - 1;
			mt_srand((double)microtime() * 1000000);
					
			for($i = 0; $i < $length; $i++) {
			   $hash .= $chars[mt_rand(0, $max)];
			}
			return $hash;
		}
		
		//社团图标上传对象初始化函数
		
		
		//存储json文件,返回文件名
		function save_json2file($json){	
			$filename = date('Y_m_d') . '_' . Random(8) . '.dat';
			while (file_exists('./Data/'. $filename)) {
				$filename = date('Y_m_d') . '_' . Random(8) . '.dat';
			}
			$fp = fopen('./Data/'. $filename,'w+');
			if ($fp) {
				fwrite($fp,json_encode($json));
				fclose($fp);
				return $filename;
			}
			return null;
		}
		
		//社团报名1
		function students_signup1(){
			$pdata = I('post.');
			if ( $_SESSION['user_power'] > 10) return -1;	//社团管理帐号不能报名社团
			$result = M('signup')->where('cid = ' . (int)$pdata['cid'] . ' and uid = ' . $_SESSION['user_uid'])->select();
			if ( $result[0] ) return -2;			//重复报名
			
			$filename = date('Y_m_d') . '_' . Random(8) . '.dat';
			while (file_exists('./Data/'. $filename)) {
				$filename = date('Y_m_d') . '_' . Random(8) . '.dat';
			}
			$fp = fopen('./Data/'. $filename,'w+');
			if ($fp) {
				fwrite($fp,json_encode($pdata));
				fclose($fp);
				$data = array(
					'uid'		=>	$_SESSION['user_uid'],
					'cid'		=>	$pdata['cid'],
					'sdate'		=>	time(),
					'spath'		=>	$filename,
					'sstatus'	=>	0,
					'scontent1'	=>	$pdata['xb'],
					'scontent2'	=>	$pdata['yx'],
					'scontent3'	=>	$pdata['lxfs'],
				);
				if (M('signup')->add($data))
					return 1;
			}
			return 0;
		}
		
		//社团报名1修改
		function students_signup1_change(){
			$pdata = I('post.');
			if ( $_SESSION['user_power'] > 10) return -1;	//社团管理帐号不能报名社团
			$result = M('signup')->where('cid = ' . (int)$pdata['cid'] . ' and uid = ' . $_SESSION['user_uid'])->select();
			if ( (!$result[0]) || $result['status']!=0 ) return -1;			//越权操作
			
			unlink('./Data/'.$result[0]['spath']);
			
			$filename = date('Y_m_d') . '_' . Random(8) . '.dat';
			while (file_exists('./Data/'. $filename)) {
				$filename = date('Y_m_d') . '_' . Random(8) . '.dat';
			}
			$fp = fopen('./Data/'. $filename,'w+');
			if ($fp) {
				fwrite($fp,json_encode($pdata));
				fclose($fp);
				$data = array(
					'sid'		=>	$result[0]['sid'],
					'sdate'		=>	time(),
					'spath'		=>	$filename,
					'sstatus'	=>	0,
					'scontent1'	=>	$pdata['xb'],
					'scontent2'	=>	$pdata['yx'],
					'scontent3'	=>	$pdata['lxfs'],
				);
				if (M('signup')->save($data))
					return 1;
			}
			return 0;
		}
		
		//查看用户报名信息(普通用户用)
		function get_students_signup1($cid){
			$result = M('signup')->where('cid = ' . (int)$cid . ' and uid = ' . $_SESSION['user_uid'])->select();
			if ($result){
				$fp = fopen('./Data/'. $result[0]['spath'],'r');
				$json = fread($fp,filesize('./Data/'. $result[0]['spath']));
				if ( $json ){
					return array(
						'result'	=>	$result[0],
						'json'		=>	$json,
						);
				}
			}
			return null;
		}
		
		//读取用户报名详细信息(社团管理员用)
		function get_students_signup1_sid($sid){
			$result = M('signup')->where('sid = ' . (int)$sid . ' and cid = '. $_SESSION['user_xh'])->select();
			if ($result){
				$fp = fopen('./Data/'. $result[0]['spath'],'r');
				$json = fread($fp,filesize('./Data/'. $result[0]['spath']));
				if ( $json ){
					return array(
						'result'	=>	$result[0],
						'json'		=>	$json,
						);
				}
			}
			return null;
		}
		
		//获取社团申请表详细信息(社团用)
		function get_approval_aid($aid){
			$result = M('approval')->where('aid = ' . (int)$aid)->select();
			if ($result){
				$fp = fopen('./Data/'. $result[0]['apath'],'r');
				$json = fread($fp,filesize('./Data/'. $result[0]['apath']));
				if ( $json ){
					return array(
						'result'	=>	$result[0],
						'json'		=>	$json,
						);
				}
			}
			return null;
		}
		
		//获取社团报名表,社团用(分页)
		function get_signup_table_page($id){
			$data = M('signup'); // 实例化Data数据对象
    		import('ORG.Util.Page');// 导入分页类
			$count = $data->where('cid = ' . (int)$id)->count();
			$page = new Page($count,30);
			$show = $page->show(); //分页显示输出
			$signup = $data->order('sdate desc')->where('cid = ' . (int)$id)->limit($page->firstRow.','.$page->listRows)->select();
			return array('page' => $show,'signup' =>$signup);
		}
		
		//获取社团报名表,(危险)
		function get_signup_table($name,$id){
			return M('signup')->where( $name . ' = ' . (int)$id)->select();
		}
		
		//获取社团申请表,社团用(分页)
		function get_approval_table_page($cid){
			$data = M('approval'); // 实例化Data数据对象
    		import('ORG.Util.Page');// 导入分页类
			$count = $data->where('cid = ' . (int)$cid)->count();
			$page = new Page($count,30);
			$show = $page->show(); //分页显示输出
			$approval = $data->where('cid = ' . (int)$cid)->order('adate desc')->limit($page->firstRow.','.$page->listRows)->select();
			return array('page' => $show,'approval' =>$approval);
		}
		
		//获取社团申请表,社团用
		function get_approval_table($cid){
			return M('approval')->where('cid = ' . (int)$cid)->select();
		}
		
		//获取社团申请表,团联用(分页)
		function get_approval_table_by_type_page($type){
			$data = M('approval'); // 实例化Data数据对象
    		import('ORG.Util.Page');// 导入分页类
			$count = $data->where("atype = 2" . (int)$type)->count();
			$page = new Page($count,30);
			$show = $page->show(); //分页显示输出
			$approval = $data->order('adate desc')->where("atype = 2" . (int)$type)->limit($page->firstRow.','.$page->listRows)->select();
			return array('page' => $show,'approval' =>$approval);
		}