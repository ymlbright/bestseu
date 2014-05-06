<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="__PUBLIC__/css/bootstrap.css" rel="stylesheet">
    <link href="__PUBLIC__/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="__PUBLIC__/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="__PUBLIC__/css/pagination.css" rel="stylesheet">
    <link href="__PUBLIC__/css/My.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="__PUBLIC__/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="__PUBLIC__/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="__PUBLIC__/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="__PUBLIC__/ico/apple-touch-icon-57-precomposed.png">
    
    <!-- Le Script -->
   	<script src="__PUBLIC__/js/jquery.js"></script>
    <!--<script src="__PUBLIC__/js/google-code-prettify/prettify.js"></script>-->
    <script src="__PUBLIC__/js/bootstrap-transition.js"></script>
    <script src="__PUBLIC__/js/bootstrap-alert.js"></script>
    <script src="__PUBLIC__/js/bootstrap-modal.js"></script>
    <script src="__PUBLIC__/js/bootstrap-dropdown.js"></script>
    <script src="__PUBLIC__/js/bootstrap-scrollspy.js"></script>
    <script src="__PUBLIC__/js/bootstrap-tab.js"></script>
    <script src="__PUBLIC__/js/bootstrap-tooltip.js"></script>
    <script src="__PUBLIC__/js/bootstrap-popover.js"></script>
    <script src="__PUBLIC__/js/bootstrap-button.js"></script>
    <script src="__PUBLIC__/js/bootstrap-collapse.js"></script>
    <script src="__PUBLIC__/js/bootstrap-carousel.js"></script>
    <script src="__PUBLIC__/js/bootstrap-typeahead.js"></script>
    <script src="__PUBLIC__/js/bootstrap-datepicker.js"></script>
	  <script src="__PUBLIC__/js/index.js"></script>
    <script src="__PUBLIC__/js/vote.js"></script>
    <script>
		var LoginURL="<?php echo U('/Login/Login');?>";
		var SignURL="<?php echo U('/Login/Sign');?>";
	</script>
  </head>
  
  <body data-spy="scroll" data-target=".subnav" data-offset="50">


  <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-default btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo U('/');?>">社团服务中心</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="<?php echo ($nav1); ?>">
                <a href="<?php echo U('/');?>" title="index">首页</a>
              </li>
              <li class="<?php echo ($nav2); ?>">
                <a href="<?php echo U('/Community');?>">社团</a>
              </li>
              <li class="<?php echo ($nav3); ?>">
                <a href="<?php echo U('/Activity');?>">活动</a>
              </li>
              <li class="<?php echo ($nav4); ?>">
                <a href="<?php echo U('/Office');?>">办公</a>
              </li>
            </ul>
            </div>
            <?php if($_SESSION['user_name'] != ''): ?><ul class="nav pull-right">
                  <li class="dropdown">
                    <a href="#"
                          class="dropdown-toggle"
                          data-toggle="dropdown">
                          <?php echo ($_SESSION['user_name']); ?>
                          <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                    	<?php if($_SESSION['user_power'] < 10): ?><li><a href="<?php echo U('/Community/ShowSignUp');?>">申请表查询</a></li>
                            <li class="divider"></li><?php endif; ?>
                        <li><a href="<?php echo U('/Login/Logout');?>">退出</a></li>
                    </ul>
                  </li>
                </ul>
            <?php else: ?>
              <form class="navbar-form pull-right" onsubmit="return LoginSubmit();">
                  <input id="user" type="text" class="span2" placeholder="一卡通/社团ID">
                  <input id="pwd" type="password" class="span2" placeholder="统一身份认证密码">
                  <button id="submit" type="submit" class="btn">登录</button>
              </form><?php endif; ?>
          
        </div>
      </div>
    </div>

    <div id="myModal" class="modal hide fade">
         <div class="modal-header">
              <a href="#" class="close" data-dismiss="modal">&times;</a>
              <h3>需要您的授权</h3>
         </div>
         <div id="modalcontent" class="modal-body">
              <p>我们将从学校同步您的以下信息至我们的服务器:</p>
              <ul>
              	<li>学号</li>
                <li>一卡通号</li>
                <li>姓名</li>
              </ul>
          </div>
          <div class="modal-footer">
              <button id="btn_refuse" class="btn">拒绝</button>
              <button id="btn_accept" data-loading-text="读取中..." class="btn btn-primary" autocomplete="off">授权</button>
          </div>
    </div>
    
    <br /><br /><br /><br />
<div class="container">

<script src="__PUBLIC__/js/office.js"></script>
<script>
	var IndexURL="<?php echo U('/Office/');?>";
</script>

<div class="container-fluid row-fluid">
<div class="span2">
    <ul class="nav nav-list">
    
    <?php if(($_SESSION['user_power'] > 19) AND ($_SESSION['user_power'] < 41)): ?><!-- 社团用户组 -->
      <li class="nav-header">
        <h5>社团办公</h5>
      </li>
      <li class="<?php echo ($type2_1); ?>">
        <a href="<?php echo U('/Office/Show?type=1&gp=2');?>">常规活动申请</a>
      </li>
      <li class="<?php echo ($type2_13); ?>">
        <a href="<?php echo U('/Office/Show?type=13&gp=2');?>">文体专项申请</a>
      </li>
      <li class="<?php echo ($type2_2); ?>">
        <a href="<?php echo U('/Office/Show?type=2&gp=2');?>">电子屏申请</a>
      </li>
      <!--
      <li class="<?php echo ($type2_3); ?>">
        <a href="<?php echo U('/Office/Show?type=3&gp=2');?>">活动经费审批</a>
      </li>
      -->
      <li class="<?php echo ($type2_4); ?>">
        <a href="<?php echo U('/Office/Show?type=4&gp=2');?>">室内活动场地申请</a>
      </li>
      <li class="<?php echo ($type2_5); ?>">
        <a href="<?php echo U('/Office/Show?type=5&gp=2');?>">室外活动场地申请</a>
      </li>
      <li class="<?php echo ($type2_6); ?>">
        <a href="<?php echo U('/Office/Show?type=6&gp=2');?>">宣传场地申请</a>
      </li>
      <!--
      <li class="<?php echo ($type2_7); ?>">
        <a href="<?php echo U('/Office/Show?type=7&gp=2');?>">教室长期借用申请</a>
      </li>-->
      <li class="nav-header">
        <h5>社团管理</h5>
      </li>
      <li class="<?php echo ($type2_8); ?>">
        <a href="<?php echo U('/Office/Show?type=8&gp=2');?>">基本信息维护</a>
      </li>
      <li class="<?php echo ($type2_9); ?>">
        <a href="<?php echo U('/Office/Show?type=9&gp=2');?>">活动图片管理</a>
      </li>
      <li class="<?php echo ($type2_11); ?>">
        <a href="<?php echo U('/Office/Show?type=11&gp=2');?>">社团报名审核</a>
      </li>
      <li class="<?php echo ($type2_12); ?>">
        <a href="<?php echo U('/Office/Show?type=12&gp=2');?>">申请表管理</a>
      </li>
      <li class="<?php echo ($type2_10); ?>">
        <a href="<?php echo U('/Office/Show?type=10&gp=2');?>">密码修改</a>
      </li><?php endif; ?>
    
    <?php if($_SESSION['user_power'] > 49): ?><!-- 团联用户组 -->
      <li class="nav-header">
        <h5>团联办公</h5>
      </li>
      <li class="<?php echo ($type3_1); ?>">
        <a href="<?php echo U('/Office/Show?type=1&gp=3');?>">常规活动申请审批</a>
      </li>
      <li class="<?php echo ($type3_9); ?>">
        <a href="<?php echo U('/Office/Show?type=9&gp=3');?>">文体专项申请审批</a>
      </li>
      <li class="<?php echo ($type3_2); ?>">
        <a href="<?php echo U('/Office/Show?type=2&gp=3');?>">电子屏申请审批</a>
      </li>
      <!--
      <li class="<?php echo ($type3_3); ?>">
        <a href="<?php echo U('/Office/Show?type=3&gp=3');?>">活动经费审批</a>
      </li>
      -->
      <li class="<?php echo ($type3_4); ?>">
        <a href="<?php echo U('/Office/Show?type=4&gp=3');?>">室内活动场地申请审批</a>
      </li>
      <li class="<?php echo ($type3_5); ?>">
        <a href="<?php echo U('/Office/Show?type=5&gp=3');?>">室外活动场地申请审批</a>
      </li>
      <li class="<?php echo ($type3_6); ?>">
        <a href="<?php echo U('/Office/Show?type=6&gp=3');?>">宣传场地申请审批</a>
      </li>
      <li class="<?php echo ($type3_7); ?>">
        <a href="<?php echo U('/Office/Show?type=7&gp=3');?>">教室长期借用申请审批</a>
      </li>
      <li class="<?php echo ($type3_8); ?>">
        <a href="<?php echo U('/Office/Show?type=8&gp=3');?>">社团成立审批</a>
      </li><?php endif; ?>
     
    <?php if(($_SESSION['user_power'] < 11)): ?><li class="nav-header">
        <h5>其它</h5>
      </li>
      <li class="<?php echo ($type1_1); ?>">
        <a href="<?php echo U('/Office/Show?type=1&gp=1');?>">社团成立申请</a>
      </li>
      <li class="<?php echo ($type1_2); ?>">
        <a href="<?php echo U('/Office/Show?type=2&gp=1');?>">社团投票统计</a>
      </li><?php endif; ?>
    </ul>
</div>
<div class="span10">