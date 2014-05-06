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
              <li class="<?php echo ($nav5); ?>">
                <a href="<?php echo U('/Help');?>">帮助</a>
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
<div class="container-fluid row-fluid">
<div class="tabbable tabs-left span2">
  <ul class="nav nav-tabs">
  	<li class="<?php echo ($tab0); ?>">
      <a href="<?php echo U('/Community/Show?type=0');?>">全部</a>
    </li>
    <li class="<?php echo ($tab1); ?>">
      <a href="<?php echo U('/Community/Show?type=1');?>">学术实践类</a>
    </li>
    <li class="<?php echo ($tab2); ?>">
      <a href="<?php echo U('/Community/Show?type=2');?>">体育健身类</a>
    </li>
    <li class="<?php echo ($tab3); ?>">
      <a href="<?php echo U('/Community/Show?type=3');?>">艺术娱乐类</a>
    </li>
    <li class="<?php echo ($tab4); ?>">
      <a href="<?php echo U('/Community/Show?type=4');?>">文学传媒类</a>
    </li>
    <li class="<?php echo ($tab5); ?>">
      <a href="<?php echo U('/Community/Show?type=5');?>">志愿服务类</a>
    </li>
  </ul>
</div>
<div class="span8 offest1">
	<ul class="thumbnails">
    	<?php if(is_array($community)): $i = 0; $__LIST__ = $community;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="span2">
                <a href="<?php echo U('/Community/ShowDetial?id='.$v['cid']);?>" class="thumbnail">
                	<?php if(($v['clogo'] == '')): ?><img src="__PUBLIC__/img/160x120.gif" alt="">
                     <?php else: ?>
                     	<img src="__PUBLIC__/Upload/HeadPhoto/pic_<?php echo ($v['clogo']); ?>" alt="" width="160" height="120"><?php endif; ?>
                    <h5><?php echo ($v['cname']); ?></h5>
                    <p><?php echo ($v['cslogan']); ?></p>
                </a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>

<div class="pagination"><?php echo ($page); ?></div>
</div>
</div>
     <!-- Footer
      ================================================== -->
	<HR style="FILTER: alpha(opacity=100,finishopacity=0,style=3)" width="100%" color=#987cb9 SIZE=3>
            <footer class="footer">
            <p class="pull-right"><a href="#">返回顶部</a></p>
            <p>地址：南京市东南大学九龙湖校区大学生活动中心404室  电话：025-52090190  邮编：211189</p>
			<p>版权所有：东南大学学生团体联合会  Bright</p>
			<p>意见及问题反馈: webmaster@bestseu.com     <a href="http://www.bestseu.com/main">学团联主页</a></p>
            </footer>
        </div>
    </body>
</html>