<?php if (!defined('THINK_PATH')) exit();?><!-- <h3>活动经费审批</h3> -->

<?php if($review == 1): ?><script>
	var app_type=3;
	var Json=eval("(<?php echo ($json); ?>)");
	var dSuggestion="<?php echo ($result['asuggestion']); ?>";
	var Sstatus="<?php echo ($result['astatus']); ?>";
	var id="<?php echo ($result['aid']); ?>";
	var FormSubmitURL="<?php echo U('/Office/ReSubmit?type=3&gp=2&id='.$result['aid']);?>";
</script>
<?php else: ?>
<script>
	var FormSubmitURL="<?php echo U('/Office/Submit?type=3&gp=2');?>";
</script><?php endif; ?>

<div class="table-title">
	<h3>学生团体常规活动经费审批表</h3>
</div>

<div class="control-group">
<form id="submitForm" class="form-horizontal" action="#" onsubmit="return Do_Check();">
    <table class="table table-striped table-bordered table-condensed table-line-style">
      <tbody>
        <tr>
          <td id="table-lable" width="120px">学生团体</td>
          <td width="300px"><input type="text" class="input-xlarge" name="xstt" id="xstt" value="<?php echo a_getcname($_SESSION['user_xh']);?>" readonly="readonly"></td>
          <td id="table-lable" width="120px">活动名称</td>
          <td width="300px"><input type="text" class="input-xlarge" name="hdmc" id="hdmc"></td>
        </tr>
        <tr>
          <td id="table-lable" width="120px">预算总额</td>
          <td width="300px"><input type="text" class="input-xlarge" name="ysze" id="ysze"></td>
          <td id="table-lable" width="120px">负责人</td>
          <td width="300px">
          	<input type="text" class="span1" name="fzr" id="fzr">
            联系方式:<input type="text" style="width:140px" name="lxfs" id="lxfs">
          </td>
        </tr>
        <tr>
          <td id="table-lable">物品清单</td>
          <td colspan="3">
          	 <table class="table table-striped table-line-style span3">
             	<thead>
                	<tr>
                    	<td id="table-lable" width="300px">物品</td>
                        <td id="table-lable" width="300px">单价*数量</td>
                        <td id="table-lable" width="300px">金额</td>
                    </tr>
                </thead>
             	<tbody>
                	<tr>
                    	<td><input type="text" class="span3" name="wp1" id="wp1"></td>
                        <td><input type="text" class="span3" name="wp1d" id="wp1d"></td>
                        <td><input type="text" style="width:190px"  name="wp1j" id="wp1j"></td>
                    </tr>
                    <tr>
                    	<td><input type="text" class="span3" name="wp2" id="wp2"></td>
                        <td><input type="text" class="span3" name="wp2d" id="wp2d"></td>
                        <td><input type="text" style="width:190px"  name="wp2j" id="wp2j"></td>
                    </tr>
                    <tr>
                    	<td><input type="text" class="span3" name="wp3" id="wp3"></td>
                        <td><input type="text" class="span3" name="wp3d" id="wp3d"></td>
                        <td><input type="text" style="width:190px"  name="wp3j" id="wp3j"></td>
                    </tr>
                    <tr>
                    	<td><input type="text" class="span3" name="wp4" id="wp4"></td>
                        <td><input type="text" class="span3" name="wp4d" id="wp4d"></td>
                        <td><input type="text" style="width:190px"  name="wp4j" id="wp4j"></td>
                    </tr>
                    <tr>
                    	<td  id="table-lable">其它</td>
                        <td><input type="text" class="span3" name="wpqtd" id="wpqtd"></td>
                        <td><input type="text" style="width:190px"  name="wpqtj" id="wpqtj"></td>
                    </tr>
                </tbody>
             </table>
          </td>
        </tr>
        <tr>
          <td id="table-lable" rowspan="2">活动中心意见</td>
          <td rowspan="2" colspan="3"></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td id="table-lable" rowspan="2">主席团意见</td>
          <td rowspan="2" colspan="3"></td>
        </tr>
        <tr>
        </tr>
        <tr>
          <td id="table-lable" rowspan="2">最终意见</td>
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
    
    <?php if($result['astatus'] != 'U' && isset($result['astatus'])): ?><fieldset>
        	<button id="btn_pass_app" class="btn hide">确定</button>
    		<legend>审批结果</legend>
            <p><?php echo ($result['asuggestion']); ?></p>
        </fieldset>
    <?php else: ?>
        <div class="form-actions">
    	<div class="pull-right">
          <?php if($check == 1): ?><button id="btn_pass_app" class="btn btn-success">通过申请</button>
              <button id="btn_refuse_app" class="btn btn-danger">拒绝申请</button><?php endif; ?>
          <?php if(($review == 1) AND ($check != 1)): ?><button type="submit" class="btn btn-primary">修改</button>
              <button id="btn_del" class="btn btn-danger">删除</button><?php endif; ?>
          <?php if(($review != 1) AND ($check != 1)): ?><button type="submit" class="btn btn-primary">提交申请</button>
            <button type="reset" class="btn">重置</button><?php endif; ?>
        </div>
	   </div><?php endif; ?>
</form>
</div>