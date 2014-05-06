<?php if (!defined('THINK_PATH')) exit();?><!-- <h3>电子屏申请</h3> -->

<?php if($review == 1): ?><script>
	var app_type=2;
	var Json=eval("(<?php echo ($json); ?>)");
	var dSuggestion="<?php echo ($result['asuggestion']); ?>";
	var Sstatus="<?php echo ($result['astatus']); ?>";
	var id="<?php echo ($result['aid']); ?>";
	var FormSubmitURL="<?php echo U('/Office/ReSubmit?type=2&gp=2&id='.$result['aid']);?>";
</script>
<?php else: ?>
<script>
	var FormSubmitURL="<?php echo U('/Office/Submit?type=2&gp=2');?>";
</script><?php endif; ?>

<div class="table-title">
	<h3>东南大学学生团体电子屏申请表</h3>
</div>

<div class="control-group">
<form id="submitForm" class="form-horizontal" action="#" onsubmit="return Do_Check();">
    <table class="table table-striped table-bordered table-condensed table-line-style">
      <tbody>
        <tr>
          <td id="table-lable">学生团体</td>
          <td ><input type="text" class="input-xlarge" name="xstt" id="xstt" value="<?php echo a_getcname($_SESSION['user_xh']);?>" readonly="readonly"></td>
          <td id="table-lable">活动编号</td>
          <td ><input type="text" class="input-xlarge" name="hdid" id="hdid" placeholder="所对应活动的ID"></td>
        </tr>
        <tr>
          <td id="table-lable" width="120px">申请人</td>
          <td width="300px"><input type="text" class="input-xlarge" name="sqr" id="sqr"></td>
          <td id="table-lable" width="120px">联系方式</td>
          <td width="300px"><input type="text" class="input-xlarge" name="lxfs" id="lxfs"></td>
        </tr>
        <tr>
          <td id="table-lable">活动名称</td>
          <td><input type="text" class="input-xlarge" name="hdmc" id="hdmc"></td>
          <td id="table-lable">电子屏地点</td>
          <td><input type="text" class="input-xlarge" name="dzpdd" id="dzpdd"></td>
        </tr>
        <tr>
          <td id="table-lable" rowspan="5">电子屏简要内容</td>
          <td colspan="3" rowspan="5"><textarea class="input-xlarge span8" name="hdcd" id="hdcd" rows="6"></textarea></td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
          <td id="table-lable">申请时间</td>
          <td colspan="3">
          	<input type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="input-xlarge datepicker" name="sqsjb" id="sqsjb">至
            <input type="text" data-provide="datepicker" data-date-format="yyyy-mm-dd" class="input-xlarge datepicker" name="sqsje" id="sqsje">
            <span id="alert"></span>
          </td>
        </tr>
        <tr>
          <td id="table-lable" rowspan="2">学生团体联合会意见</td>
          <td rowspan="2" colspan="3"></td>
        </tr>
        <tr>
        </tr>
        <?php if(($check == 1) AND ($result['astatus'] == 'U')): ?><tr>
            <td id="table-lable">审批意见</td>
            <td colspan="3"><textarea class="input-xlarge span8" name="spyj" id="spyj" rows="6"></textarea></td>
          </tr><?php endif; ?>
      </tbody>
    </table>
    
    <div>
    	<h5>注:</h5>
        <p>
        	1.在申请电子屏时，需向各单位出示该申请表；<br />
			2.若电子屏内容较多，请另附纸交予各单位电子屏负责人。<br />
            <ul>
            	<li>梅园食堂电子屏：向梅园食堂经理出示该表</li>
            	<li>图书馆电子屏：至图书馆三楼图书馆办公室</li>
            	<li>大学生活动中心电子屏：联系侯同学：13218010127</li>
            	<li>其他电子屏暂不外借</li>
            </ul>
        </p>
    </div>
    
    <?php if($result['astatus'] != 'U' && isset($result['astatus'])): ?><fieldset>
        	<button id="btn_pass_app" class="btn hide">确定</button>
    		<legend>审批结果</legend>
            <p><?php echo ($result['asuggestion']); ?></p>
        </fieldset>
    <?php else: ?>
        <div class="form-actions">
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