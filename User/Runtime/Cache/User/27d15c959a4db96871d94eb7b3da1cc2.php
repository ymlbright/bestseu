<?php if (!defined('THINK_PATH')) exit();?><!-- <h3>室外活动场地申请</h3> -->

<?php if($review == 1): ?><script>
	var app_type=5;
	var Json=eval("(<?php echo ($json); ?>)");
	var dSuggestion="<?php echo ($result['asuggestion']); ?>";
	var Sstatus="<?php echo ($result['astatus']); ?>";
	var id="<?php echo ($result['aid']); ?>";
	var FormSubmitURL="<?php echo U('/Office/ReSubmit?type=5&gp=2&id='.$result['aid']);?>";
</script>
<?php else: ?>
<script>
	var FormSubmitURL="<?php echo U('/Office/Submit?type=5&gp=2');?>";
</script><?php endif; ?>

<div class="table-title">
	<h3>东南大学学生团体户外活动场地申请表</h3>
</div>

<div class="control-group">
<form id="submitForm" class="form-horizontal" action="#" onsubmit="return Do_Check();">
    <table class="table table-striped table-bordered table-condensed table-line-style">
      <tbody>
        <tr>
          <td id="table-lable" width="120px">学生团体</td>
          <td width="300px"><input type="text" class="input-xlarge" name="xstt" id="xstt" value="<?php echo a_getcname($_SESSION['user_xh']);?>" readonly="readonly"></td>
          <td id="table-lable" width="120px">活动编号</td>
          <td width="300px"><input type="text" class="input-xlarge" name="hdid" id="hdid" placeholder="所对应活动的ID"></td>
        </tr>
        <tr>
          <td id="table-lable">负责人</td>
          <td><input type="text" class="input-xlarge" name="fzr" id="fzr"></td>
          <td id="table-lable">联系方式</td>
          <td><input type="text" class="input-xlarge" name="lxfs" id="lxfs">
          </td>
        </tr>
        <tr>
          <td id="table-lable" width="120px">活动名称</td>
          <td width="300px"><input type="text" class="input-xlarge" name="hdmc" id="hdmc"></td>
          <td id="table-lable" width="120px">活动时间</td>
          <td width="300px"><input type="text" class="input-xlarge" name="hdsj" id="hdsj"></td>
        </tr>
        <tr>
          <td id="table-lable">活动主办方</td>
          <td><input type="text" class="input-xlarge" name="hdzbf" id="hdzbf" value="共青团东南大学委员会"></td>
          <td id="table-lable">活动承办方</td>
          <td><input type="text" class="input-xlarge" name="hdcbf" id="hdcbf"></td>
        </tr>
        <tr>
          <td colspan="4">
          	 <div class="span12">
             	<p>尊敬的团委老师:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="input-medium" name="st" id="st" value="<?php echo a_getcname($_SESSION['user_xh']);?>" readonly="readonly">于<input type="text" class="input-medium datepicker" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="sj" id="sj" placeholder="活动时间">举办<input type="text" class="input-medium" name="hd" id="hd"  placeholder="活动名称">活动需要申请<input type="text" class="input-medium" name="cd" id="cd" placeholder="活动场地">请相关部门批准！</p>
             </div>
          </td>
        </tr>
        <tr>
          <td id="table-lable" rowspan="2">活动流程及其他说明</td>
          <td rowspan="2" colspan="3"><textarea class="input-xlarge span8" name="qtsm" id="qtsm" rows="6"></textarea></td>
        </tr>
        <tr>
        </tr>
        <tr>
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
          <td id="table-lable" rowspan="2">保卫处意见</td>
          <td rowspan="2" colspan="3"></td>
        </tr>
        <tr>
        </tr>
        <?php if(($check == 1) AND (($result['astatus'] == 'U') || $result['astatus'] == 'D')): ?><tr>
            <td id="table-lable">审批意见</td>
            <td colspan="3"><textarea class="input-xlarge span8" name="spyj" id="spyj" rows="6"></textarea></td>
          </tr><?php endif; ?>
      </tbody>
    </table>
    
    <?php if($result['astatus'] != 'U' && isset($result['astatus'])): ?><fieldset>
        	<button id="btn_pass_app" class="btn hide">确定</button>
    		<legend>审批结果</legend>
            <p><?php echo ($result['asuggestion']); ?></p>
        </fieldset><?php endif; ?>
    <?php if($result['astatus'] == 'U' || $_SESSION['user_power'] > 69): ?><div class="form-actions">
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
</div>