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

<div class="row-fluid">
<div class="span2">
    <ul class="thumbnails">
        <li class="span2">
        <div class="thumbnail pull-left">
        	<?php if(($community['clogo'] == '')): ?><img src="__PUBLIC__/img/160x120.gif" alt="">
            <?php else: ?>
                 <img src="__PUBLIC__/Upload/HeadPhoto/pic_<?php echo ($community['clogo']); ?>" alt=""><?php endif; ?>
            <h4 style="text-align:center"><?php echo ($community['cname']); ?></h4>
        </div>
        </li>
    </ul>
</div>
<div class="span10 offset3">
    <table class="table table-striped">
      <tbody>
      	<tr>
        	<td width=60px> <p>现任主席:</p></td>
        	<td> <p><?php echo ($community['cchairman']); ?></p> </td>
            <td width=60px> <p>联系方式:</p></td>
            <td> <p><?php echo ($community['ccontact']); ?></p>  </td>
        </tr>
        <tr>
        	<td> <p>类&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别:</p></td>
        	<td> <p><?php echo c_gettype($community['ctype']);?> </p> </td>
            <td> <p>星&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;级:</p></td>
            <td> <p><?php echo c_getstars($community['cpoint']);?></p></td>
        </tr>
        <tr>
        	<td> <p>创建时间:</p></td>
        	<td> <p><?php echo (date('Y-m-d',$community['ccreatetime'])); ?></p> </td>
            <td colspan=2> 
              <a href="<?php echo U('/Community/SignUp?id='.$community['cid']);?>" class="btn btn-primary">我要报名</a> &nbsp;
              <input id="cid" type="text" class="hide" value="<?php echo ($community['cid']); ?>">
              <?php if($community['cid'] != 107): ?><a href="#" id="btn_vote_1" class="btn btn-info">我最喜爱的社团投票(测试)</a><?php endif; ?>
            </td>
        </tr>
         <tr>
         	<td> <p>简&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;介:</p></td>
            <td colspan=3> <p><?php echo ($community['cbrief']); ?></p> </td>
        </tr>
      </tbody>
    </table>
	
    
    
    
    
</div>
</div>

<div class="row">
<div class="span2" style="text-align:center">
	<h4>社团风采展示:</h4>
</div>


<div id="myCarousel" class="carousel span10 offest2 ">
  <!-- Carousel items -->
  <div class="carousel-inner">
    <div class="item active">
      <?php if($compic['p1'] == ''): ?><img src="<?php echo c_getpic(0);?>" alt="">
          <div class="carousel-caption">
            <h4>图片1</h4>
          </div>
      <?php else: ?>
          <img src="<?php echo c_getpic($compic['p1']);?>" alt="">
          <div class="carousel-caption">
            <h4><?php echo ($compic['dis1']); ?></h4>
         </div><?php endif; ?>
    </div>
    <div class="item next">
          <?php if($compic['p2'] == ''): ?><img src="<?php echo c_getpic(0);?>" alt="">
            <div class="carousel-caption">
              <h4>图片2</h4>
            </div>
          <?php else: ?>
            <img src="<?php echo c_getpic($compic['p2']);?>" alt="">
            <div class="carousel-caption">
              <h4><?php echo ($compic['dis2']); ?></h4>
            </div><?php endif; ?>
    </div>
    <div class="item">
          <?php if($compic['p3'] == ''): ?><img src="<?php echo c_getpic(0);?>" alt="">
            <div class="carousel-caption">
              <h4>图片3</h4>
            </div>
          <?php else: ?>
            <img src="<?php echo c_getpic($compic['p3']);?>" alt="">
            <div class="carousel-caption">
              <h4><?php echo ($compic['dis3']); ?></h4>
            </div><?php endif; ?>
    </div>
  </div>
	<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>

<script>
$(document).ready(function(){
	$('#myCarousel').carousel({
  		interval: 5000
	});
});
</script>


</div>


<div id="voteModal" class="modal hide fade">
    <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal">&times;</a>
        <h3>请输入验证码</h3>
    </div>
    <div id="modalcontent" class="modal-body">
      <input id="vcode" type="text" onclick='GetIMG()' class="span2" placeholder="请输入验证码">
      <img onclick='GetIdcode()' id="vcodeimg" onfocus=this.blur()/>
    </div>
    <div class="modal-footer">
      <button id="btn_revote" class="btn">投票</button>
    </div>
</div>

     <!-- Footer
      ================================================== -->
	<HR style="FILTER: alpha(opacity=100,finishopacity=0,style=3)" width="100%" color=#987cb9 SIZE=3>
            <footer class="footer">
            <p class="pull-right"><a href="#">返回顶部</a></p>
            <p>地址：南京市东南大学九龙湖校区大学生活动中心404室  电话：025-52090190  邮编：211189</p>
			<p>版权所有：东南大学学生团体联合会  Bright</p>
			<p>意见及问题反馈: bestseuxc@163.com</p>
            </footer>
        </div>
    </body>
</html>