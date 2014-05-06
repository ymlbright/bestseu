<?php if (!defined('THINK_PATH')) exit();?><!-- <h3>申请表管理</h3> -->


<div class="span10">
    <table class="table table-striped">
    	<thead>
        	<tr>
            	<td >名称</td>
                <td >时间</td>
                <td >类型</td>
                <td >操作</td>
            </tr>
        </thead>
      <tbody>
      <?php if(is_array($approval)): $i = 0; $__LIST__ = $approval;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><tr>
        	<td >
              <?php if($s['aname'] == ''): ?>附属申请表
              <?php else: ?>
                <?php echo ($s['aname']); endif; ?>
            </td>
            <td ><?php echo (date('Y-m-d D',$s['adate'])); ?></td>
            <td >
              <?php switch($s['atype']): case "21": ?>常规活动申请 ID:<?php echo ($s['aidentifier']); break;?>
                <?php case "22": ?>电子屏申请<?php break;?>
                <?php case "23": ?>活动经费审批<?php break;?>
                <?php case "24": ?>室内活动场地申<?php break;?>
                <?php case "25": ?>室外活动场地申请<?php break;?>
                <?php case "26": ?>宣传场地申请<?php break;?>
                <?php case "29": ?>文体专项申请 ID:<?php echo ($s['aidentifier']); break; endswitch;?>
            </td>
            <td >
              <?php switch($s['astatus']): case "U": if($s['atype'] == 29): ?><a href="<?php echo U('/Office/ShowDetial?type=12&gp=2&index=13&da=' . $s['aid']);?>">详细</a>
                  <?php else: ?>
                    <a href="<?php echo U('/Office/ShowDetial?type=12&gp=2&index=' . substr($s['atype'],1,1) . '&da=' . $s['aid']);?>">详细</a><?php endif; break;?>
                <?php case "O": ?><a href="<?php echo U('/Office/ShowDetial?type=12&gp=2&index=' . substr($s['atype'],1,1) . '&da=' . $s['aid']);?>">详细(电子审核已通过)</a><?php break;?>
                <?php case "D": ?><a href="<?php echo U('/Office/ShowDetial?type=12&gp=2&index=' . substr($s['atype'],1,1) . '&da=' . $s['aid']);?>">详细(团联审核已通过)</a><?php break;?>
                <?php case "P": switch($s['atype']): case "29": ?><a href="<?php echo U('/Office/ShowDetial?type=12&gp=2&index=13&da=' . $s['aid']);?>">详细</a>(已通过)<?php break;?>
                    <?php default: ?>
                      <a href="<?php echo U('/Office/ShowDetial?type=12&gp=2&index=' . substr($s['atype'],1,1) . '&da=' . $s['aid']);?>">详细</a>(已通过)<?php endswitch; break;?>
                <?php case "R": if($s['atype'] == 29): ?><a href="<?php echo U('/Office/ShowDetial?type=12&gp=2&index=13&da=' . $s['aid']);?>">详细</a>(未通过)
                  <?php else: ?>
                    <a href="<?php echo U('/Office/ShowDetial?type=12&gp=2&index=' . substr($s['atype'],1,1) . '&da=' . $s['aid']);?>">详细</a>(未通过)<?php endif; break; endswitch;?>
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table>
    
    <div class="pagination"><?php echo ($page); ?></div>
</div>