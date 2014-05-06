<?php if (!defined('THINK_PATH')) exit();?><!-- <h3>宣传场地申请</h3> -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="printer">
    <meta name="author" content="">
  	<link href="__PUBLIC__/css/bootstrap.css" rel="stylesheet">
  	<link href="__PUBLIC__/css/My.css" rel="stylesheet">
  	<script src="__PUBLIC__/js/jquery.js"></script>
    <OBJECT classid="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2" height="0" id="wb" name="wb" width="3"></OBJECT> 
    <style media="print">.noprint { DISPLAY: none }</style>
  </head>

  <body>
  	<div class="span10">
  		<div class="pull-right noprint">
        <button onclick="doPrint();">打印</button>
        <button onclick="doPreview();">打印预览</button>
        <button onclick="doSet();">页面设置</button>
      </div>
      <!--startprint-->

<script>
	var app_type=6;
	var Json=eval("(<?php echo ($json); ?>)");
	var dSuggestion="<?php echo ($result['asuggestion']); ?>";
	var Sstatus="<?php echo ($result['astatus']); ?>";
	var id="<?php echo ($result['aid']); ?>";
</script>


<div class="span8">

<div class="table-title">
	<h3>学生团体宣传场地申请表</h3>
</div>

<div class="control-group">
      <table class="table table-bordered table-line-style">
      <tbody>
      	
        <tr>
          <td id="table-lable" width="120px">学生团体</td>
          <td ><span name="xstt" id="xstt"></span></td>
        </tr>
        <tr>
          <td id="table-lable">活动名称</td>
          <td><span name="hdmc" id="hdmc"></span></td>
        </tr>
        <tr>
          <td id="table-lable" width="120px">负责人</td>
          <td width="300px">
          	<span name="fzr" id="fzr"></span>
            联系方式:<span name="lxfs" id="lxfs"></span>
          </td>
         </tr>
         <tr>
          <td id="table-lable">宣传方式</td>
          <td>
            <label class="radio inline">
              <input type="radio" name="xcfs" id="xcfshf" value="横幅" checked>横幅
            </label>
            <label class="radio inline ">
              <input type="radio" name="xcfs" id="xcfsph" value="喷绘">喷绘
            </label>
          </td>
        </tr>
        <tr>
          <td id="table-lable">悬挂场地</td>
          <td><span name="xgcd" id="xgcd"></span></td>
        </tr>
        <tr>
          <td id="table-lable">起迄时间</td>
          <td>
            <span name="qqsj" id="qqsj"></span>至
            <span name="qqsj" id="qqsj"></span>
          </td>
        </tr>
        <tr>
          <td id="table-lable" rowspan="2">校团委意见</td>
          <td rowspan="2"></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td id="table-lable" rowspan="2">保卫处意见</td>
          <td rowspan="2"></td>
        </tr>
        <tr>
        </tr>
        <?php if(($check == 1) AND ($result['astatus'] == 'U')): ?><tr>
            <td id="table-lable">审批意见</td>
            <td colspan="3"><span name="spyj" id="spyj" rows="6"></span></td>
          </tr><?php endif; ?>
      </tbody>
    </table>
    

</div>
</div>

		<div class="span8">
		源自:网络社团服务中心(http://www.bestseu.com/)
		</div>
		<!--endprint-->
		<script>
			$('body').find('span').each(function (){
				$(this).text(Json[$(this).attr('id')]);
			});
			$('body').find('input[type=radio]').each(function (){
				if ( typeof(Json[$(this).attr('name')]) != 'undefined')
					if ( Json[$(this).attr('name')] == $(this).val() )
						$(this).attr("checked",true);
			});

			function doPrint() { 
				bdhtml=window.document.body.innerHTML; 
				sprnstr="<!--startprint-->"; 
				eprnstr="<!--endprint-->"; 
				prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+17); 
				prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr)); 
				window.document.body.innerHTML=prnhtml; 
				window.print(); 			
			}
			function doPreview() { 
				wb.execwb(7,1);
			}
			function doSet() { 
				wb.execwb(8,1);
			}
		</script>
	</div>
  </body>
 </html>