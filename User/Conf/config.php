<?php

$config = array(
	//'配置项'=>'配置值'
	'URL_MODEL'				=>	2,
	'URL_HTML_SUFFIX'		=>	'.html',
	//'ACTION_SUFFIX'			=>	'html',
	//项目分组
	'APP_GROUP_LIST'		=>	'User,Admin',
	'DEFAULT_GROUP'			=>	'User',
);
return array_merge(include './Conf/config.php',$config);
?>