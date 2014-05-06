<?PHP

require( APP_PATH . 'Common/Office.php');	//社团办公类处理函数
require( APP_PATH . 'Common/Vote.php');	//社团办公类处理函数

	//社团类型转换函数
	function c_gettype($type){
		switch ($type) {
		case 1:
			return "学术实践类";
		case 2:
			return "体育健身类";
		case 3:
			return "艺术娱乐类";
		case 4:
			return "文学传媒类";
		case 5:
			return "志愿服务类";
		default:
			return "未知的类别";
		}
	}

	//社团星级转换函数
	function c_getstars($point){
		if ($point >= 80 )
			return "★★★★★";
		else if($point >= 60 )
			return "★★★★☆";
		else if($point >= 40 )
			return "★★★☆☆";
		else if($point >= 20 )
			return "★★☆☆☆";
		else if ($point >= 10)
			return "★☆☆☆☆";
		else
			return "☆☆☆☆☆";
	}
	
	//社团名称获取函数
	function a_getcname($cid){
		$result = M('community')->where('cid = ' . (int)$cid)->select();
		return $result[0]['cname'];
	}
	
	//用户名称获取函数
	function a_getuname($uid){
		$result = M('user')->where('uid = ' . (int)$uid)->select();
		return $result[0]['name'];
	}

	//获取社团活动图片
	function c_getpic($fid){
		if ($fid==0)  return __PUBLIC__."/img/none.jpg";

		$result = M('file')->where('fid = '.(int)$fid)->select();
		return __PUBLIC__."/Upload/Photo/".$result[0]['fpath'];
	}

	//获取社团活动图片缩略图
	function c_getpicl($fid){
		if ($fid==0)  return '';

		$result = M('file')->where('fid = '.(int)$fid)->select();
		return __PUBLIC__."/Upload/Photo/pic_".$result[0]['fpath'];
	}
	
	//POST请求发送模块
	function send_post($url, $post_data) {   
	  	$postdata = http_build_query($post_data);   
	  	$options = array(   
			'http' => array(   
		 	'method' => 'POST',   
		  	'header' => 'Content-type:application/x-www-form-urlencoded',   
		  	'content' => $postdata,   
		  	'timeout' => 15 * 60 // 超时时间（单位:s）   
			)   
	 	 );   
	  	$context = stream_context_create($options);   
	  	$result = file_get_contents($url, false, $context);   
	  	return $result;   
	}   
	
	//获取社团帐号
	function c_getaccountid($cid){
		$result = M('user')->where("xh = '".(int)$cid."'")->select();
		return $result[0]['uid'];
	}