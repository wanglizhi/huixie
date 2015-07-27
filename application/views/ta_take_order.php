
<div id="container" >
	<h1> <?php echo $pageTitle;?> </h1>

	<h3>订单编号：<?php echo $order['orderNum'];?></h3>
	<div>
		<label>专业：<?php echo $order['major'];?></label>
		<label>课程名：<?php echo $order['courseName'];?></label>
		<label>页数：<?php echo $order['pageNum'];?></label>
		<label>阅读材料页数：<?php echo $order['refDoc'];?></label>
		<label>截止日期：<?php echo $order['endTime'];?></label>
		<label>补充要求<?php echo $order['requirement'];?></label>
	</div>
	<div>

		<form action="<?php echo site_url('ta/takeOrder');?>" method="post">
  			<div class="form-group">
    			<input type="hidden" value="<?php echo $order['orderNum'];?>" id="orderNum" name="orderNum" placeholder="">
  			</div>
  			<button type="submit" class="btn green">确认接单</button>
		</form>
	</div>

</div>

<script type="text/javascript">

</script>