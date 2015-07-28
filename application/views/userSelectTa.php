
<div id="container" >
	<h1> <?php echo $pageTitle;?> </h1>

	<form action="<?php echo site_url('customer/order/selectTa');?>" method="post">

<?php if(!empty($taList))foreach ($taList as $ta):?>
	<div class="checkbox">
	<label>
    	<input type="checkbox" name="taIdList[]" value="<?php echo $ta['openid'];?>">
  		</label>
		<img src="<?php echo $ta['userInfo']['headimgurl'];?>" alt="..." class="img-circle" style="width:120px;height:120px">
  		
  		<br>
  		<label>姓名：<?php echo $ta['userInfo']['nickname'];?></label>
  		<label>评级：<?php echo $ta['star'];?></label>
  		<label>单价：<?php echo $ta['unitPrice'];?></label>
  		
	</div>
<?php endforeach;?>
<div>
	<label>
	（可以多选或不选，系统会添加默认TA）
	</label>
</div>

<button type="submit" class="btn btn-default text-center">submit</button>
<a href="#" class="btn btn-default" role="button">back</a>
</form>

</div>

<script type="text/javascript">

	$(document).ready(function() {
 $("#taList").dataTable();
});
</script>