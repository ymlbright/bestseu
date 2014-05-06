<?php if (!defined('THINK_PATH')) exit();?><!-- <h3>基本信息维护</h3> -->
<script src="__PUBLIC__/js/ajaxfileupload.js"></script>
<script>
	var DetialURL="<?php echo U('/Community/GetDetial?id='.$_SESSION['user_xh']);?>";
	var FormSubmitURL="<?php echo U('/Office/Submit?type=8&gp=2');?>";
	var FormUploadURL="<?php echo U('/Upload/Pic');?>";
</script>

<form id="submitForm" class="form-horizontal" onsubmit="return Do_Check();">
  <fieldset>
    <legend>基本信息维护</legend>
    <div class="row-fluid">
        <div class="span7">
            <div class="control-group">
              <label class="control-label" for="btn_uploadfile">Logo</label>
              <div class="controls">
                <button id="btn_uploadfile" type="button" class="btn">上传图标</button>
                <p class="help-block">为确保美观,请选择大于160*120px的社团Logo.原先由于没有提示社团图像大小限制为512KB,导致社团无法上传,在此表示歉意.</p>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="stmc">社团名称</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="stmc" id="stmc" readonly="readonly">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="xrzx">现任社长</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="xrzx" id="xrzx">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="lxfs">联系方式</label>
              <div class="controls">
                <input type="text" class="input-xlarge" name="lxfs" id="lxfs">
                <p class="help-block"></p>
              </div>
            </div>
        </div>
        <div class="span4">
            <ul class="thumbnails">
                <li class="span2">
                <div class="thumbnail pull-left">
                    <img id="img" src="http://placehold.it/160x120" width="160" height="120">
                </div>
                </li>
            </ul>
        </div>
    </div>
        <div class="control-group">
          <label class="control-label" for="jj">简介</label>
          <div class="controls">
            <textarea  type="text" class="input-xlarge span6" rows=="9" name="jj" id="jj"></textarea >
            <p class="help-block"></p>
          </div>
        </div>
    
    
    <div class="form-actions">
    	<div class="pull-right">
            <button type="submit" class="btn btn-primary">保存</button>
            <button type="reset" class="btn">重置</button>
        </div>
	</div>
  </fieldset>
</form>


<form id="uploadForm" class="hide" action="#" enctype="multipart/form-data">
  <input type="file" name="file" id="file" accept="image/png, image/jpg, image/jpeg">
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