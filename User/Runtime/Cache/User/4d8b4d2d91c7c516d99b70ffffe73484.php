<?php if (!defined('THINK_PATH')) exit();?><!-- 报名表审核 -->
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
	var Json=eval("(<?php echo ($json); ?>)");
	var dSuggestion="<?php echo ($result['ssuggestion']); ?>";
	var Sstatus="<?php echo ($result['sstatus']); ?>";
</script>

<div class="span8">

<div class="table-title">
  <h3>东南大学学生团体报名表</h3>
</div>

<div class="control-group">
    <table class="table table-bordered table-line-style">
      <tbody>
        <tr>
          <td id="table-lable" width="120px">姓名</td>
          <td width="200px">
          	<span name="xm" id="xm" value=""></span><br />
            <label class="radio inline">
              <input type="radio" name="xb" id="xbm" value="男">男
            </label>
            <label class="radio inline">
              <input type="radio" name="xb" id="xbf" value="女">女
            </label>
          </td>
          <td id="table-lable" width="120px">学号</td>
          <td width="120px"><span class="span2" name="xh" id="xh" value=""></span></td>
          <td id="table-lable" width="120px">籍贯</td>
          <td width="120px"><span class="span1" name="jg" id="jg"></span></td>
        </tr>
        <tr>
          <td id="table-lable">联系方式</td>
          <td><span class="span2" name="lxfs" id="lxfs"></span></td>
          <td id="table-lable">院系</td>
          <td><span class="span2" name="yx" id="yx"></span></td>
          <td id="table-lable">宿舍</td>
          <td ><span class="span1" name="ss" id="ss"></span></td>
        </tr>
        <tr>
          <td id="table-lable">已参加的社团</td>
          <td colspan="5"><span id="ycjst_alert"></span><span class="span8" name="ycjst" id="xstt"></span></td>
        </tr>
        <tr>
          <td id="table-lable">部门志愿</td>
          <td colspan="3"><span class="span5" name="bmzy" id="bmzy"></span></td>
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
          <td colspan="5"><span class="span8" name="ahtc" id="ahtc"></span></td>
        </tr>
        <tr>
          <td id="table-lable">曾获荣誉</td>
          <td colspan="5"><span class="span8" name="chry" id="chry"></span></td>
        </tr>
        <tr>
          <td rowspan="5" id="table-lable">个人简介</td>
          <td rowspan="5" colspan="5"><span name="grjj" id="grjj"></span></td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
          <td rowspan="3" id="table-lable">社团意见</td>
          <td rowspan="3" colspan="5"><span name="suggestion" id="suggestion"></span></td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
      </tbody>
    </table>

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