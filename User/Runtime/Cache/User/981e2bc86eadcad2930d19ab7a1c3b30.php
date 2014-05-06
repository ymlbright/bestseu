<?php if (!defined('THINK_PATH')) exit();?><!-- <h3>室内活动场地申请</h3> -->
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
	var app_type=4;
	var Json=eval("(<?php echo ($json); ?>)");
	var dSuggestion="<?php echo ($result['asuggestion']); ?>";
	var Sstatus="<?php echo ($result['astatus']); ?>";
	var id="<?php echo ($result['aid']); ?>";
</script>

<div class="span8">

<div class="table-title">
	<h3>东南大学学生团体室内场地申请书</h3>
</div>

<div class="control-group">
    <div class="control-group">
    	<p>尊敬的校办老师：</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您好！<span name="st" id="st" ></span>将于<span name="sj" id="sj" ></span>举办<span name="hd" id="hd" ></span>，预计参与人数<span name="rs" id="rs"></span>人，现需申请<span name="js" id="js"></span>举办活动。特此申请，望请批准。谢谢！</p>
        <p>此致</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;敬礼</p>
          <div class="pull-right">
        	<div class="control-group">
              <label class="control-label" for="sq">申请人：</label>
              <div class="controls">
                <span class="input-xlarge">东南大学学生团体联合会</span>
                <p class="help-block"></p>
              </div>
        	</div>
        	<div class="control-group">
              <label class="control-label" for="sqr"></label>
              <div class="controls">
                <span name="sqr" id="sqr"></span>
                <p class="help-block"></p>
              </div>
        	</div>
        	<div class="control-group">
              <label class="control-label" for="lxr">联系人:</label>
              <div class="controls">
                <span name="lxr" id="lxr"></span>
                <p class="help-block"></p>
              </div>
        	</div>
        	<div class="control-group">
              <label class="control-label" for="rq">日期:</label>
              <div class="controls">
                <span name="rq" id="rq"></span>
                <p class="help-block"></p>
              </div>
        	</div>
          </div>
    </div>
    
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