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
	var AddURL="<?php echo U('/Admin/Community/add');?>";
	var GetURL="<?php echo U('/Admin/Community/get');?>";
	var EditURL="<?php echo U('/Admin/Community/edit');?>";
</script>
<div class="pull-right"><button class="btn btn-primary" id="add_community">添加社团</button></div>
<div class="span12">
    <table class="table table-striped">
    	<thead>
        	<tr>
            	<td width=50px>cid</td>
                <td width=50px>name</td>
                <td width=80px>type</td>
                <td width=100px>point</td>
                <td width=100px>createtime</td>
                <td width=100px>status</td>
                <td width=100px>action</td>
            </tr>
        </thead>
      <tbody>
      <?php if(is_array($community)): $i = 0; $__LIST__ = $community;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
        	<td><?php echo ($v['cid']); ?></td>
        	<td><?php echo ($v['cname']); ?> </td>
        	<td><?php echo ($v['ctype']); ?> </td>
        	<td><?php echo ($v['cpoint']); ?> </td>
          	<td><?php echo (date('Y-m-d H:i:s',$v['ccreatetime'])); ?></td>
          	<td><?php echo ($v['cstatus']); ?> </td>
          	<td>
          		<a href="<?php echo U('/Admin/Community/del?id='.$v['cid']);?>">删除</a>&nbsp;&nbsp;
          		<a href="#" onclick="DoEdit(<?php echo ($v['cid']); ?>);">修改</a>&nbsp;&nbsp;
          		<?php switch($v['cstatus']): case "1": ?><a href="<?php echo U('/Admin/Community/hide?id='.$v['cid']);?>">隐藏</a>&nbsp;&nbsp;
          			<a href="<?php echo U('/Admin/Community/lock?id='.$v['cid']);?>">锁定</a>&nbsp;&nbsp;<?php break;?>
          		<?php case "0": ?><a href="<?php echo U('/Admin/Community/show?id='.$v['cid']);?>">显示</a>&nbsp;&nbsp;<?php break;?>
          		<?php case "2": ?><a href="<?php echo U('/Admin/Community/unlock?id='.$v['cid']);?>">解锁</a><?php break; endswitch;?>
          	</td>		
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
</div>
<div class="pagination span12"><?php echo ($page); ?></div>



<div id="caddModal" class="modal hide fade">
    <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal">&times;</a>
        <h3>添加新社团</h3>
    </div>
    <div id="modalcontent" class="modal-body">
    	<div class="control-group">
		    <label class="control-label" for="stmc">社团名称</label>
		    <div class="controls">
		      <input type="text" id="stmc">
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="lx">类&nbsp;&nbsp;&nbsp;&nbsp;型</label>
		    <div class="controls">
		      <input type="text" id="lx" placeholder="1-5"><bt/>
		      1:"学术实践类"; 2:"体育健身类"; 3:"艺术娱乐类"; 4:"文学传媒类"; 5:"志愿服务类";
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="xj">星&nbsp;&nbsp;&nbsp;&nbsp;级</label>
		    <div class="controls">
		      <input type="text" id="xj" placeholder="1-100"><br/>
		      0-9:没星; 10-19:一星; 20-39:二星; 40-59:三星; 60-79:四星; 80-100:五星;
		    </div>
		</div>
      	<div class="control-group">
		    <label class="control-label" for="cjsj">创建时间</label>
		    <div class="controls">
		      <input type="text" id="cjsj" placeholder="例如:2014-04-20">
		    </div>
		</div>
    </div>
    <div class="modal-footer">
      <button id="btn_c_add" class="btn">添加</button>
    </div>
</div>

<div id="ceditModal" class="modal hide fade">
    <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal">&times;</a>
        <h3>修改社团信息</h3>
    </div>
    <div id="modalcontent" class="modal-body">
    	<div class="control-group">
		    <label class="control-label" for="cname">社团名称</label>
		    <div class="controls">
		      <input type="text" name="cname" id="cname">
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="ctype">类&nbsp;&nbsp;&nbsp;&nbsp;型</label>
		    <div class="controls">
		      <input type="text" name="ctype" id="ctype" placeholder="1-5"><bt/>
		      1:"学术实践类"; 2:"体育健身类"; 3:"艺术娱乐类"; 4:"文学传媒类"; 5:"志愿服务类";
		    </div>
		</div>
		<div class="control-group">
		    <label class="control-label" for="cpoint">星&nbsp;&nbsp;&nbsp;&nbsp;级</label>
		    <div class="controls">
		      <input type="text" name="cpoint" id="cpoint" placeholder="1-100"><br/>
		      0-9:没星; 10-19:一星; 20-39:二星; 40-59:三星; 60-79:四星; 80-100:五星;
		    </div>
		</div>
      	<div class="control-group">
		    <label class="control-label" for="ccreatetime">创建时间</label>
		    <div class="controls">
		      <input type="text" name="ccreatetime" id="ccreatetime" placeholder="例如:2014-04-20">
		    </div>
		</div>
    </div>
    <div class="modal-footer">
      <button id="btn_c_edit" class="btn">修改</button>
    </div>
</div>
<input class="hide" id="cid">
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