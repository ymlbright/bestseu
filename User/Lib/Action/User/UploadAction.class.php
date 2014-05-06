<?php
class UploadAction extends Action {

	public function Updata(){
		if ( !isset($_SESSION['user_power']) || $_SESSION['user_power']<20) $this->redirect('/Login/index?relogin=1');
		if (!IS_POST) halt('页面不存在',U('Index/index'));

		$data = array(
			'cid'		=>	$_SESSION['user_xh'],
			'dis1'		=>	I('post.dis1'),
			'dis2'		=>	I('post.dis2'),
			'dis3'		=>	I('post.dis3')
			);
		M('filemap')->save($data);
		$this->aJaxReturn(array('status' => 1),'json');
	}

	public function Pic(){
		$upload = $this->up_headphoto();
		if ( $upload->upload() ){
			$info =  $upload->getUploadFileInfo();
			$result = M('community')->where('cid = ' . $_SESSION['user_xh'])->select();
			if ($result[0]){
				$data = array(
				'cid' 		=> 	$_SESSION['user_xh'],
				'clogo'		=>	$info[0]['savename'],
				);
				if ( M('community')->save($data) )
					$this->aJaxReturn(array('file' => $info[0]['savename'],'status' => 1),'json');
				else
					$this->aJaxReturn(array('file' => '内部错误!','status' => 0),'json');
			}
			$this->aJaxReturn(array('file' => '参数错误!','status' => 0),'json');
		}
		$this->aJaxReturn(array('file' => $upload->getErrorMsg(),'status' => 0),'json');
	}

	public function Photo($id){
		if (!IS_POST) halt('页面不存在',U('Index/index'));
		if ( $id!=1 && $id!=2 && $id!=3)  halt('页面不存在',U('Index/index'));
		$upload = $this->up_photo();
		if ( $upload->upload() ){
			$info =  $upload->getUploadFileInfo();

			//创建社团文件映射
			if ( M('filemap')->where('cid = '.$_SESSION['user_xh'])->count() == 0 ){
				$nmap = array(
					'cid'		=>	$_SESSION['user_xh'],
					'scur'		=>	0,
					);
				M('filemap')->add($nmap);
			} 
			$result = M('filemap')->where('cid = '.$_SESSION['user_xh'])->select();

			//写入文件信息
			$data = array(
					'fpath'		=>	$info[0]['savename'],
					'fname'		=>	'',
					'fdata'		=>	time(),
					);
			if ( $id == 1) {
				$data['fname'] = $_FILES['p1']['name'];
				if ( $result[0]['p1'] ){
					$fdel = M('file')->where('fid = '. $result[0]['p1'])->select();
					if ( $fdel ){
						unlink('./Public/Upload/Photo/pic_' . $fdel[0]['fpath']);
						unlink('./Public/Upload/Photo/' . $fdel[0]['fpath']);
						M('file')->where($fdel)->delete();
					}
				}
				$re = M('file')->add($data);
				$result[0]['p1'] = $re;
				M('filemap')->save($result[0]);
			} 
			if ( $id == 2) {
				$data['fname'] = $_FILES['p2']['name'];
				if ( $result[0]['p2'] ){
					$fdel = M('file')->where('fid = '. $result[0]['p2'])->select();
					if ( $fdel ){
						unlink('./Public/Upload/Photo/pic_' . $fdel[0]['fpath']);
						unlink('./Public/Upload/Photo/' . $fdel[0]['fpath']);
						M('file')->where($fdel)->delete();
					}
				}
				$re = M('file')->add($data);
				$result[0]['p2'] = $re;
				M('filemap')->save($result[0]);
			} 
			if ( $id == 3) {
				$data['fname'] = $_FILES['p3']['name'];
				if ( $result[0]['p3'] ){
					$fdel = M('file')->where('fid = '. $result[0]['p3'])->select();
					if ( $fdel ){
						unlink('./Public/Upload/Photo/pic_' . $fdel[0]['fpath']);
						unlink('./Public/Upload/Photo/' . $fdel[0]['fpath']);
						M('file')->where($fdel)->delete();
					}
				}
				$re = M('file')->add($data);
				$result[0]['p3'] = $re;
				M('filemap')->save($result[0]);
			}
			$this->aJaxReturn(array('file' => $info[0]['savename'],'status' => 1),'json');
		} else {
			$this->aJaxReturn(array('file' => $upload->getErrorMsg(),'status' => 0),'json');
		}
	}
	
	public function File(){
		if (!IS_POST) halt('页面不存在',U('Index/index'));
		
		$upload = $this->up_file();
		if ( $upload->upload() ){
			$info =  $upload->getUploadFileInfo();
			
			//创建社团文件映射
			if ( M('filemap')->where('cid = '.$_SESSION['user_xh'])->count() == 0 ){
				$nmap = array(
					'cid'		=>	$_SESSION['user_xh'],
					'scur'		=>	0,
					);
				M('filemap')->add($nmap);
			} 
			$result = M('filemap')->where('cid = '.$_SESSION['user_xh'])->select();

			if ( !$result ){
				unlink('./Public/Upload/File/' . $info[0]['savename']);
				$this->aJaxReturn(array('file' => '读取文件列表失败!','status' => 0),'json');
			}

			$i = (int)$result[0]['scur']+1;

			if ( $i==6 ) $i=1;

			//删除原先文件
			if ( $result[0]['s'.$i] != ''){
				$fdel = M('file')->where('fid = ' . $result[0]['s'.$i])->select();
				unlink('./Public/Upload/File/' . $fdel[0]['fpath']);
				M('file')->where($fdel)->delete();
			}

			//写入新文件
			$data = array(
					'fpath'		=>	$info[0]['savename'],
					'fname'		=>	$_FILES['file']['name'],
					'fdata'		=>	time(),
					);
			$result[0]['s'.$i] = M('file')->add($data);
			$result[0]['scur'] = $i;

			M('filemap')->save($result[0]);
			$this->aJaxReturn(array('file' => $info[0]['savename'],'status' => 1),'json');
		} else {
			$this->aJaxReturn(array('file' => $upload->getErrorMsg(),'status' => 0),'json');
		}
	}

	private function up_photo(){  
		//完成与thinkphp相关的，文件上传类的调用     
        import('ORG.Net.UploadFile');//将上传类UploadFile.class.php拷到Lib/Org文件夹下  
        $upload=new UploadFile();  
        $upload->maxSize='1048576';//默认为-1，不限制上传大小  限制大小 1MB
        $upload->savePath='./Public/Upload/Photo/';//保存路径建议与主文件平级目录或者平级目录的子目录来保存     
        $upload->saveRule=uniqid();//上传文件的文件名保存规则  
        $upload->uploadReplace=false;//如果存在同名文件是否进行覆盖  
        $upload->allowExts=array('jpg','jpeg','png');//准许上传的文件类型  
        $upload->allowTypes=array('image/png','image/jpg','image/jpeg');//检测mime类型  
        $upload->thumb=true;//是否开启图片文件缩略图  
        $upload->thumbMaxWidth='160';  
        $upload->thumbMaxHeight='120';  
        $upload->thumbPrefix='pic_';//缩略图文件前缀  
        $upload->thumbRemoveOrigin=0;//如果生成缩略图，是否删除原图  
         
        return $upload;   
    }
	private function up_file(){  
        //完成与thinkphp相关的，文件上传类的调用     
        import('ORG.Net.UploadFile');//将上传类UploadFile.class.php拷到Lib/Org文件夹下  
        $upload=new UploadFile();  
        $upload->maxSize='20971520';//默认为-1，不限制上传大小  限制20MB
        $upload->savePath='./Public/Upload/File/';//保存路径建议与主文件平级目录或者平级目录的子目录来保存     
        $upload->saveRule=uniqid();//上传文件的文件名保存规则  
        $upload->uploadReplace=false;//如果存在同名文件是否进行覆盖  
        $upload->allowExts=array('rar','zip');//准许上传的文件类型   
         
        return $upload;   
    } 

    private function up_headphoto(){  
			//完成与thinkphp相关的，文件上传类的调用     
			import('ORG.Net.UploadFile');//将上传类UploadFile.class.php拷到Lib/Org文件夹下  
			$upload=new UploadFile();  
			$upload->maxSize='524288';//默认为-1，不限制上传大小  512KB
			$upload->savePath='./Public/Upload/HeadPhoto/';//保存路径建议与主文件平级目录或者平级目录的子目录来保存     
			$upload->saveRule=FileName_cid;//上传文件的文件名保存规则  
			$upload->uploadReplace=true;//如果存在同名文件是否进行覆盖  
			$upload->allowExts=array('jpg','jpeg','png','gif');//准许上传的文件类型  
			$upload->allowTypes=array('image/png','image/jpg','image/jpeg','image/gif');//检测mime类型  
			$upload->thumb=true;//是否开启图片文件缩略图  
			$upload->thumbMaxWidth='160';  
			$upload->thumbMaxHeight='120';  
			$upload->thumbPrefix='pic_';//缩略图文件前缀  
			$upload->thumbRemoveOrigin=1;//如果生成缩略图，是否删除原图  
			 
			return $upload;   
    } 
}