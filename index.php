<?php
// 检测PHP环境

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);

// 定义应用目录
define('APP_PATH','./User/');
//定义应用组
define('APP_NAME','User');
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';
