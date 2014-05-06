<?php if (!defined('THINK_PATH')) exit();?><!-- <h3>常规活动申请</h3> -->
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
	var app_type=13;
	var Json=eval("(<?php echo ($json); ?>)");
	var dSuggestion="<?php echo ($result['asuggestion']); ?>";
	var Sstatus="<?php echo ($result['astatus']); ?>";
	var id="<?php echo ($result['aid']); ?>";
</script>

<div class="span8">
<div class="table-title">
	<h3>东南大学学生团体文体专项活动登记表</h3>
</div>

<div class="control-group">
    <table class="table table-bordered table-line-style">
      <tbody>
        <tr>
          <td id="table-lable" width="120px">学生团体</td>
          <td width="300px"><span name="xstt" id="xstt"></span></td>
          <td id="table-lable" width="120px">活动名称</td>
          <td width="300px"><span name="hdmc" id="hdmc"></span></td>
        </tr>
        <tr>
          <td id="table-lable">活动主办方</td>
          <td><span name="hdzbf" id="hdzbf"></span></td>
          <td id="table-lable">活动承办方</td>
          <td><span name="hdcbf" id="hdcbf"></span></td>
        </tr>
        <tr>
          <td id="table-lable">活动时间</td>
          <td><span name="hdsj" id="hdsj"></span></td>
          <td id="table-lable">负责人</td>
          <td><span name="hdcbf" id="hdcbf"></span>&nbsp;手机:<span name="sj" id="sj"></span></td>
        </tr>
        <tr>
          <td id="table-lable">外来人员或组织</td>
          <td colspan="3"><span name="wlryhzz" id="wlryhzz"></span></td>
        </tr>
        <tr>
          <td id="table-lable">活动意义及预期效果</td>
          <td colspan="3"><span name="hdyyjyqxg" id="hdyyjyqxg"></span></td>
        </tr>
        <tr>
          <td id="table-lable">活动形式</td>
          <td colspan="3">
            <label class="radio inline">
              <input type="radio" name="hdxsop" id="hdxsby" value="表演类" checked>表演类
            </label>
            <label class="radio inline ">
              <input type="radio" name="hdxsop" id="hdxsjs" value="竞赛类">竞赛类
            </label>
            <label class="radio inline ">
              <input type="radio" name="hdxsop" id="hdxsjz" value="讲座类">讲座类
            </label>
            <label class="radio inline ">
              <input type="radio" name="hdxsop" id="hdxsqt" value="其它">其它:
            </label>
            <span name="hdxs" id="hdxs"></span>
          </td>
        </tr>
        <tr>
          <td id="table-lable">活动对象</td>
          <td><span name="hddx" id="hddx"></span></td>
          <td id="table-lable">预计参与人数</td>
          <td><span name="yjcyrs" id="yjcyrs"></span></td>
        </tr>
        <tr>
          <td id="table-lable">活动内容</td>
          <td colspan="3"><span name="hdnr" id="hdnr"></span></td>
        </tr>
        <tr>
          <td id="table-lable">备注</td>
          <td colspan="3"><span name="bz" id="bz"></span></td>
        </tr>
        <tr>
          <td id="table-lable">审批金额</td>
          <td><span name="spje" id="spje"></span></td>
          <td id="table-lable">实际报销</td>
          <td><span name="sjbx" id="sjbx"></span></td>
        </tr>
        <tr>
          <td id="table-lable">场地申请</td>
          <td colspan="3"><span name="cdsq" id="cdsq"></span></td>
        </tr>
          <td id="table-lable" rowspan="2">学生团体联合会意见</td>
          <td rowspan="2" colspan="3"></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td id="table-lable" rowspan="2">校团委意见</td>
          <td rowspan="2" colspan="3"></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td id="table-lable" rowspan="2">备注</td>
          <td rowspan="2" colspan="3"></td>
        </tr>
        <tr>
        </tr>
        <?php if(($check == 1) AND ($result['astatus'] == 'U')): ?><tr>
            <td id="table-lable">审批意见</td>
            <td colspan="3"><span name="spyj" id="spyj"></span></td>
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