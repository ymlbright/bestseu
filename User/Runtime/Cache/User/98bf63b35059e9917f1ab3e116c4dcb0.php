<?php if (!defined('THINK_PATH')) exit();?>
<script>
  var vdata = eval("(<?php echo ($vdata); ?>)");
  vdata.sort(function (x,y){return y.count - x.count;});
  function displ(){
    for( var i =0; i<vdata.length ; i++){
      $('#tablebody').append("<tr><td>"+vdata[i].cname+"</td><td>"+vdata[i].count+"</td><td>"+(i+1)+"</td></tr>");
    }
  };
  $(document).ready(function(){
    displ();
  });
</script>


<div class="span9">
    <table class="table table-striped">
      <thead>
        <tr>
          <td>社团名称</td>
          <td>票数</td>
          <td>排名</td>
        </tr>
      </thead>
      <tbody id="tablebody">

      </tbody>
    </table>
</div>