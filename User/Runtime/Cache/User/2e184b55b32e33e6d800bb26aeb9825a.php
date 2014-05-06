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

<div class="page-header">
    <h3><span id='t_name'></span> 报名表</h3> 
</div>

<script>
$(document).ready(function(){
	$.get("<?php echo U('/Community/GetSignUpDetial?cid='.$cid);?>", function (data){
			if (data){
				if ( data.status != 0 ) {
					$('#styy').append("<tr><td rowspan='3' id='table-lable'>社团意见</td><td rowspan='3' colspan='5'><textarea class='input-xlarge span8' name='suggestion' id='suggestion' rows='6'></textarea></td></tr>");
					$('body').find('input[type=text]').each(function (){
						$(this).attr('readonly',true);
					});
					$('#grjj').attr('readonly',true);
					$('#suggestion').attr('readonly',true);
				}
				else
					$('#bdtj').html("<div class='form-actions'><div class='pull-right'><button type='submit' class='btn btn-primary'>修改</button> <button type='reset' class='btn'>重置</button></div></div>");
				
				
				$('#t_name').text(data.name);
				data.json.replace('/(/g','');
				data.json.replace('/)/g','');
				var da = eval("(" + data.json + ")");
				$('body').find('input[type=text]').each(function (){
					$(this).val(da[$(this).attr('name')]);
				});
				
				$('#suggestion').text(da.grjj);
				
				if ( $("input[name='xb'][value='男']").val() == da['xb'] )
					$("input[name='xb'][value='男']").attr("checked",true); 
				else
					$("input[name='xb'][value='女']").attr("checked",true); 
					
				if ( $("input[name='fctj'][value='是']").val() == da['fctj'] )
					$("input[name='fctj'][value='是']").attr("checked",true); 
				else
					$("input[name='fctj'][value='否']").attr("checked",true); 
			}
		},'json');
});

function Do_Check(){
	$.post("<?php echo U('/Community/Submit?type=2');?>", $("#submitForm").serialize(),function (data){
			switch (data.status){
				case 1:
					alert("修改成功,请等待社团审核.");break;
				case 0:
					alert("抱歉,系统出现故障了~");break;
				case -1:
					alert("越权操作!");break;
			}
		},'json');
	return false;
}
</script>

<div class="control-group">
<form id="submitForm" class="form-horizontal" action="#" onsubmit="return Do_Check();">
	<input type="text" class="hide" name="cid" id="cid" value="<?php echo ($cid); ?>">
    <table class="table table-striped table-bordered table-condensed table-line-style" id="styy">
      <tbody>
        <tr>
          <td id="table-lable" width="120px">姓名</td>
          <td width="100px">
          	<input type="text" class="input-mini" name="xm" id="xm" value="">&nbsp;&nbsp;&nbsp;&nbsp;性别:
            <label class="radio inline">
              <input type="radio" name="xb" id="xbm" value="男">男
            </label>
            <label class="radio inline">
              <input type="radio" name="xb" id="xbf" value="女">女
            </label>
          </td>
          <td id="table-lable" width="120px">学号</td>
          <td width="200px"><input type="text" class="input-xlarge" name="xh" id="xh" value=""></td>
          <td id="table-lable" width="120px">籍贯</td>
          <td width="200px"><input type="text" class="input-xlarge" name="jg" id="jg"></td>
        </tr>
        <tr>
          <td id="table-lable">联系方式</td>
          <td><input type="text" class="input-xlarge" name="lxfs" id="lxfs"></td>
          <td id="table-lable">院系</td>
          <td><input type="text" class="input-xlarge" name="yx" id="yx"></td>
          <td id="table-lable">宿舍</td>
          <td ><input type="text" class="input-xlarge" name="ss" id="ss"></td>
        </tr>
        <tr>
          <td id="table-lable">已参加的社团</td>
          <td colspan="5"><span id="ycjst_alert"></span><input type="text" class="span5" name="ycjst" id="xstt"></td>
        </tr>
        <tr>
          <td id="table-lable">部门志愿</td>
          <td colspan="3"><input type="text" class="span5" name="bmzy" id="bmzy"></td>
          <td id="table-lable">服从调剂</td>
          <td>
            <label class="radio inline">
              <input type="radio" name="fctj" id="fctjy" value="是" checked>是
            </label>
            <label class="radio inline">
              <input type="radio" name="fctj" id="fctjf" value="否">否
            </label>
          </td>
        </tr>
        <tr>
          <td id="table-lable">爱好特长</td>
          <td colspan="5"><input type="text" class="span5" name="ahtc" id="ahtc"></td>
        </tr>
        <tr>
          <td id="table-lable">曾获荣誉</td>
          <td colspan="5"><input type="text" class="span5" name="chry" id="chry"></td>
        </tr>
        <tr>
          <td rowspan="5" id="table-lable">个人简介</td>
          <td rowspan="5" colspan="5"><textarea class="input-xlarge span8" name="grjj" id="grjj" rows="6"></textarea></td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
      </tbody>
    </table>
    
    <div id="bdtj">
    </div>
</form>
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