<?php if (!defined('THINK_PATH')) exit();?><!-- <h3>室内活动场地申请</h3> -->

<?php if($review == 1): ?><script>
	var app_type=4;
	var Json=eval("(<?php echo ($json); ?>)");
	var dSuggestion="<?php echo ($result['asuggestion']); ?>";
	var Sstatus="<?php echo ($result['astatus']); ?>";
	var id="<?php echo ($result['aid']); ?>";
	var FormSubmitURL="<?php echo U('/Office/ReSubmit?type=4&gp=2&id='.$result['aid']);?>";
</script>
<?php else: ?>
<script>
	var FormSubmitURL="<?php echo U('/Office/Submit?type=4&gp=2');?>";
</script><?php endif; ?>

<div class="table-title">
	<h3>东南大学学生团体室内场地申请书</h3>
</div>

<div class="control-group">
<form id="submitForm" class="form-horizontal" action="#" onsubmit="return Do_Check();">
    <div class="control-group">
    	<p>尊敬的校办老师：</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您好！<input type="text" class="input-medium" name="st" id="st" value="<?php echo a_getcname($_SESSION['user_xh']);?>" readonly="readonly">将于<input type="text" class="input-medium datepicker" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="sj" id="sj" placeholder="活动时间">举办<input type="text" class="input-medium" name="hdmc" id="hdmc" placeholder="活动名称">(<input type="text" class="input-medium" name="hdid" id="hdid" placeholder="所对应活动ID">)，预计参与人数<input type="text" class="input-mini" name="rs" id="rs">人，现需申请<input type="text" class="input-medium" name="js" id="js" placeholder="请依照附注填写">举办活动。特此申请，望请批准。谢谢！</p>
        <p>此致</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;敬礼</p>
          <div class="pull-right">
        	<div class="control-group">
              <label class="control-label" for="sq">申请单位：</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="sqdw" id="sqdw" value="<?php echo a_getcname($_SESSION['user_xh']);?>" readonly="readonly">
                <p class="help-block"></p>
              </div>
        	</div>
        	<div class="control-group">
              <label class="control-label" for="lxr">联系人:</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="lxr" id="lxr" placeholder="姓名及联系方式">
                <p class="help-block"></p>
              </div>
        	</div>
        	<div class="control-group">
              <label class="control-label" for="rq">日期:</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="rq" id="rq">
                <p class="help-block"></p>
              </div>
        	</div>
          </div>
    </div>

    <legend>注:</legend>
      <p>
        活动场地填写内容: <br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;焦廷标馆圆形报告厅(圆报一楼) <br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;焦廷标馆多功能厅(圆报二楼 圆形舞厅) <br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;焦廷标馆展厅(圆报楼二楼 东侧) <br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;焦廷标剧场<br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;润良报告厅(图书馆东侧)

      </p>
    </fieldset>
    
    <?php if(($check == 1) AND $result['astatus'] != 'P'): ?><div class="control-group">
              <label class="control-label" for="lxr">审批意见:</label>
              <div class="controls">
                <textarea class="input-xlarge span8" name="spyj" id="spyj" rows="6"></textarea>
                <p class="help-block"></p>
              </div>
         </div><?php endif; ?>
    
    <?php if($result['astatus'] != 'U' && isset($result['astatus'])): ?><fieldset>
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
</div>