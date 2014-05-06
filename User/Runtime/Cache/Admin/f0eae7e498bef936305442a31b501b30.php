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
	  <script src="__PUBLIC__/js/admin.js"></script>
    <script>var Index="<?php echo U('/Admin/Index');?>";</script>
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
          <a class="brand" href="<?php echo U('/');?>">管理后台</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="<?php echo ($nav1); ?>">
                <a href="<?php echo U('/Admin');?>" title="index">首页</a>
              </li>
              <li class="<?php echo ($nav2); ?>">
                <a href="<?php echo U('/Admin/User');?>">用户管理</a>
              </li>
              <li class="<?php echo ($nav3); ?>">
                <a href="<?php echo U('/Admin/Community');?>">社团管理</a>
              </li>
              <li class="<?php echo ($nav4); ?>">
                <a href="<?php echo U('/Admin/Approval');?>">审批管理</a>
              </li>
              <?php if($_SESSION[power] == 100): ?><li>
                  <a href="<?php echo U('/Admin/Index/logout');?>">退出</a>
                </li><?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <br /><br /><br /><br />
<div class="container">
<script>
	var UserAddURL="<?php echo U('/Admin/User/add');?>";
</script>
<div class="pull-right"><button class="btn btn-primary" id="add_user">添加用户</button></div>
<div class="span12">
    <table class="table table-striped">
    	<thead>
        	<tr>
            	<td width=50px>uid</td>
                <td width=50px>ykt</td>
                <td width=80px>name</td>
                <td width=100px>logintime</td>
                <td width=100px>loginip</td>
                <td width=100px>power</td>
                <td width=100px>action</td>
            </tr>
        </thead>
      <tbody>
      <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
        	<td><?php echo ($v['uid']); ?></td>
        	<td><?php echo ($v['ykt']); ?> </td>
        	<td><?php echo ($v['name']); ?> </td>
          	<td><?php echo (date('Y-m-d H:i:s',$v['logintime'])); ?></td>
          	<td><?php echo ($v['loginip']); ?> </td>
          	<td><?php echo ($v['power']); ?> </td>
          	<td><a href="<?php echo U('/Admin/User/del?id='.$v['uid']);?>">删除</a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
</div>
<div class="pagination span12"><?php echo ($page); ?></div>


<div id="userModal" class="modal hide fade">
    <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal">&times;</a>
        <h3>添加新用户</h3>
    </div>
    <div id="modalcontent" class="modal-body">
    	<div class="control-group">
		    <label class="control-label" for="sykt">一卡通</label>
		    <div class="controls">
		      <input type="text" id="sykt" placeholder="登录名">
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="sxh">学&nbsp;&nbsp;&nbsp;&nbsp;号</label>
		    <div class="controls">
		      <input type="text" id="sxh">
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="sxm">姓&nbsp;&nbsp;&nbsp;&nbsp;名</label>
		    <div class="controls">
		      <input type="text" id="sxm">
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="spwd">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
		    <div class="controls">
		      <input type="text" id="spwd">
		    </div>
		</div>
      	<div class="control-group">
		    <label class="control-label" for="sqx">权&nbsp;&nbsp;&nbsp;&nbsp;限</label>
		    <div class="controls">
		      <input type="text" id="sqx" value="5" placeholder="1-100"><br/>用户(1-10)|社团(20-40)|团联(50-90)|管理员(100)"
		    </div>
		</div>
    </div>
    <div class="modal-footer">
      <button id="btn_user_add" class="btn">添加</button>
    </div>
</div>


     <!-- Footer
      ================================================== -->
	<HR style="FILTER: alpha(opacity=100,finishopacity=0,style=3)" width="100%" color=#987cb9 SIZE=3>
            <footer class="footer">
            <p class="pull-right"><a href="#">返回顶部</a></p>
            <p>地址：南京市东南大学九龙湖校区大学生活动中心404室  电话：025-52090190  邮编：211189</p>
			<p>版权所有：东南大学学生团体联合会  Bright</p>
			<p>意见及问题反馈: webmaster@bestseu.com</p>
            </footer>
        </div>
    </body>
</html>