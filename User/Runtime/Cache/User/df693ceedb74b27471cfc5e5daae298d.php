<?php if (!defined('THINK_PATH')) exit();?><!-- 报名表审核 -->

<script>
	var Json=eval("(<?php echo ($json); ?>)");
	var dSuggestion="<?php echo ($result['ssuggestion']); ?>";
	var Sstatus="<?php echo ($result['sstatus']); ?>";
	var FormSubmitURL="<?php echo U('/Office/SignUp?id='.$result['sid']);?>";
</script>

<div class="control-group">
    <table class="table table-striped table-bordered table-condensed table-line-style">
      <tbody>
        <tr>
          <td id="table-lable" width="120px">姓名</td>
          <td width="200px">
          	<input type="text" class="input-mini" name="xm" id="xm" value="">&nbsp;&nbsp;&nbsp;&nbsp;性别:
            <label class="radio inline">
              <input type="radio" name="xb" id="xbm" value="男">男
            </label>
            <label class="radio inline">
              <input type="radio" name="xb" id="xbf" value="女">女
            </label>
          </td>
          <td id="table-lable" width="120px">学号</td>
          <td width="120px"><input type="text" class="span2" name="xh" id="xh" value=""></td>
          <td id="table-lable" width="120px">籍贯</td>
          <td width="120px"><input type="text" class="span1" name="jg" id="jg"></td>
        </tr>
        <tr>
          <td id="table-lable">联系方式</td>
          <td><input type="text" class="span2" name="lxfs" id="lxfs"></td>
          <td id="table-lable">院系</td>
          <td><input type="text" class="span2" name="yx" id="yx"></td>
          <td id="table-lable">宿舍</td>
          <td ><input type="text" class="span1" name="ss" id="ss"></td>
        </tr>
        <tr>
          <td id="table-lable">已参加的社团</td>
          <td colspan="5"><span id="ycjst_alert"></span><input type="text" class="span8" name="ycjst" id="xstt"></td>
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
          <td colspan="5"><input type="text" class="span8" name="ahtc" id="ahtc"></td>
        </tr>
        <tr>
          <td id="table-lable">曾获荣誉</td>
          <td colspan="5"><input type="text" class="span8" name="chry" id="chry"></td>
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
        <tr>
          <td rowspan="3" id="table-lable">社团意见</td>
          <td rowspan="3" colspan="5"><textarea class="input-xlarge span8" name="suggestion" id="suggestion" rows="6"></textarea></td>
        </tr>
      </tbody>
    </table>
    <div class="form-actions">
    	<div class="pull-right">
            <button id="btn_pass" class="btn btn-success">通过申请</button>
            <button id="btn_refuse" class="btn btn-danger">拒绝申请</button>
        </div>
	</div>
</div>