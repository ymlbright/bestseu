<?php if (!defined('THINK_PATH')) exit();?><!-- <h3>社团报名审核</h3> -->

<div class="span10">
    <table class="table table-striped">
    	<thead>
        	<tr>
            	<td >姓名(性别)</td>
                <td >院系</td>
                <td >联系方式</td>
                <td >时间</td>
                <td >操作</td>
            </tr>
        </thead>
      <tbody>
      <?php if(is_array($signup)): $i = 0; $__LIST__ = $signup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><tr>
        	<td ><?php echo a_getuname($s['uid']);?>(<?php echo ($s['scontent1']); ?>)</td>
        	<td ><?php echo ($s['scontent2']); ?> </td>
            <td ><?php echo ($s['scontent3']); ?> </td>
            <td ><?php echo (date('Y-m-d D',$s['sdate'])); ?></td>
            <td >
              <?php switch($s['sstatus']): case "0": ?><a href="<?php echo U('/Office/ShowDetial?type=11&gp=2&index=2&da='.$s['sid']);?>">详细</a><?php break;?>
                <?php case "1": ?><a href="<?php echo U('/Office/ShowDetial?type=11&gp=2&index=2&da='.$s['sid']);?>">详细</a>(已通过)&nbsp;&nbsp;
                  <a href="<?php echo U('/Print/ShowDetial?type=11&gp=2&index=2&da='.$s['sid']);?>">打印</a><?php break;?>
                <?php case "2": ?><a href="<?php echo U('/Office/ShowDetial?type=11&gp=2&index=2&da='.$s['sid']);?>">详细</a>(已拒绝)<?php break; endswitch;?>
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
    <div class="pagination"><?php echo ($page); ?></div>
</div>