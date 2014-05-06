<?php if (!defined('THINK_PATH')) exit();?><!-- <h3>宣传场地申请</h3> -->
<script src="__PUBLIC__/js/ajaxfileupload.js"></script>
<?php if($review == 1): ?><script>
	var app_type=6;
	var Json=eval("(<?php echo ($json); ?>)");
	var dSuggestion="<?php echo ($result['asuggestion']); ?>";
	var Sstatus="<?php echo ($result['astatus']); ?>";
	var id="<?php echo ($result['aid']); ?>";
	var FormSubmitURL="<?php echo U('/Office/ReSubmit?type=6&gp=2&id='.$result['aid']);?>";
  var FormUploadURL="<?php echo U('/Upload/File');?>";
</script>
<?php else: ?>
<script>
	var FormSubmitURL="<?php echo U('/Office/Submit?type=6&gp=2');?>";
  var FormUploadURL="<?php echo U('/Upload/File');?>";
</script><?php endif; ?>

<div class="table-title">
	<h3>学生团体宣传场地申请表</h3>
</div>

<div class="control-group">
<form id="submitForm" class="form-horizontal" action="#" onsubmit="return Do_Check();">
    <table class="table table-striped table-bordered table-condensed table-line-style">
      <tbody>
      	
        <tr>
          <td id="table-lable" width="120px">学生团体</td>
          <td ><input type="text" class="input-xlarge" name="xstt" id="xstt" value="<?php echo a_getcname($_SESSION['user_xh']);?>" readonly="readonly"></td>
        </tr>
        <tr>
          <td id="table-lable">活动名称</td>
          <td><input type="text" class="input-xlarge" name="hdmc" id="hdmc" placeholder="所对应活动的ID"></td>
        </tr>
        <tr>
          <td id="table-lable">活动编号</td>
          <td><input type="text" class="input-xlarge" name="hdid" id="hdid"></td>
        </tr>
        <tr>
          <td id="table-lable" width="120px">负责人</td>
          <td width="300px">
          	<input type="text" class="span2" name="fzr" id="fzr">
            联系方式:<input type="text" style="width:240px" name="lxfs" id="lxfs">
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
          <td><input type="text" class="input-xlarge"  name="xgcd" id="xgcd"></td>
        </tr>
        <tr>
          <td id="table-lable">起迄时间</td>
          <td>
            <input type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="input-xlarge datepicker" name="qqsj" id="qqsj">至
            <input type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="input-xlarge datepicker" name="qqsj" id="qqsj">
          </td>
        </tr>
        <tr>
          <td id="table-lable">电子版审核</td>
          <td>
            <input type="text" name="fname" id="fname" class="hide">
            <input type="text" name="frname" id="frname" class="hide">
            <a href="#" id="filename"></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php if(($check != 1)): ?><button id="btn_uploadfile" type="button" class="btn">上传电子版文件</button>&nbsp;&nbsp;&nbsp;&nbsp;
              支持类型 *.rar *.zip (请勿使用IE浏览器上传)<?php endif; ?>
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
        <?php if(($check == 1) AND $result['astatus'] != 'P'): ?><tr>
            <td id="table-lable">审批意见</td>
            <td colspan="3"><textarea class="input-xlarge span8" name="spyj" id="spyj" rows="6"></textarea></td>
          </tr><?php endif; ?>
      </tbody>
    </table>
    
    <?php if($result['astatus'] == 'R' || $result['astatus'] == 'P'): ?><fieldset>
        	<button id="btn_pass_app" class="btn hide">确定</button>
    		<legend>审批结果</legend>
            <p><?php echo ($result['asuggestion']); ?></p>
        </fieldset><?php endif; ?>
    <?php if($result['astatus'] == 'U' || ($result['astatus'] != 'P' && $_SESSION['user_power'] > 69)): ?><div class="form-actions">
    	<div class="pull-right">
          <?php if($check == 1): ?><button id="btn_pass_app" class="btn btn-success">通过申请</button>
              <button id="btn_refuse_app" class="btn btn-warning">拒绝申请</button>
              <button id="btn_del" class="btn btn-danger">删除</button><?php endif; ?>
          <?php if(($review == 1) AND ($check != 1)): ?><button type="submit" class="btn btn-primary">修改</button>
              <button id="btn_del" class="btn btn-danger">删除</button><?php endif; ?>
          <?php if(($review != 1) AND ($check != 1)): ?><button type="submit" class="btn btn-primary">提交申请</button>
            <button type="reset" class="btn">重置</button><?php endif; ?>
        </div>
	   </div><?php endif; ?>
</form>

<form id="uploadForm" class="hide" action="#" enctype="multipart/form-data">
  <input type="file" name="file" id="file" accept="application/x-rar-compressed, application/x-zip-compressed">
</form>

<div class="modal hide" id="uploadModal">
  <div class="modal-header">
    <h3>正在上传</h3>
  </div>
  <div class="modal-body">
    <div class="progress progress-striped
         active">
      <div class="bar"
           style="width: 100%;"></div>
    </div>
  </div>
</div>

</div>