<?php if (!defined('THINK_PATH')) exit();?><!-- <h3>电子屏申请审批</h3> -->

<div class="span10">
    <table class="table table-striped">
    	<thead>
        	<tr>
            	<td >活动名称</td>
              <td >活动编号</td> 
                <td >申请社团</td>
                <td >申请时间</td>
                <td >操作</td>
            </tr>
        </thead>
      <tbody>
      <?php if(is_array($approval)): $i = 0; $__LIST__ = $approval;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><tr>
        	<td >
              <?php if($s['aname'] == ''): ?>错误的申请表(请直接删除)
              <?php else: ?>
                <?php echo ($s['aname']); endif; ?>
            </td>
            <td ><?php echo ($s['aidentifier']); ?></td>
        	<td ><?php echo a_getcname($s['cid']);?></td>
        	<td ><?php echo (date('Y-m-d D',$s['adate'])); ?></td>
            <td >
              <?php switch($s['astatus']): case "U": ?><a href="<?php echo U('/Office/ShowDetial?type=2&gp=3&index=2&da='.$s['aid']);?>">详细</a><?php break;?>
                <?php case "P": ?><a href="<?php echo U('/Office/ShowDetial?type=2&gp=3&index=2&da='.$s['aid']);?>">详细</a>(已通过)&nbsp;&nbsp;
                  <a href="<?php echo U('/Print/ShowDetial?type=2&gp=3&index=2&da='.$s['aid']);?>">打印</a><?php break;?>
                <?php case "R": ?><a href="<?php echo U('/Office/ShowDetial?type=2&gp=3&index=2&da='.$s['aid']);?>">详细</a>(未通过)<?php break; endswitch;?>
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
    <div class="pagination"><?php echo ($page); ?></div>
</div>