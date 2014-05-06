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

<script>
  var VoteSubmitURL = "<?php echo U('/Vote/Vote');?>"
  var VCodeURL = "<?php echo U('/Vote/Verify');?>"
</script>

<h4 style="text-align:center">我最喜爱的社团投票</h4>
<div class="span12">
    <table class="table table-striped">
    	<thead>
        	<tr>
            	<td >社团名称</td>
                <td >社长</td>
                <td >操作</td>
            </tr>
        </thead>
      <tbody>
      <?php if(is_array($c)): $i = 0; $__LIST__ = $c;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; if($v['cid'] != 107): ?><tr>
	        	<td><?php echo ($v['cname']); ?></td>
	        	<td><?php echo ($v['cchairman']); ?> </td>
	            <td><a href="#" id="btn_vote_2" class="btn btn-info" onclick="javascript:$('#cid').val('<?php echo ($v['cid']); ?>');$('#btn_vote_1').click();">投票</a></td>
	        </tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
</div>
<a href="#" id="btn_vote_1" class="btn hide"></a>
<input id="cid" type="text" class="hide">
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