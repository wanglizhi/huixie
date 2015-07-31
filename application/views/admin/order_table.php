<div id="<?=$orderTable['tableId']?>">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>订单编号</th>
				<th>用户编号</th>
				<th>TA编号</th>
				<th>专业</th>
				<th>课程名称</th>
				<th>截止日期</th>
				<th>价格</th>
				<th>订单状态</th>
				<th>详情</th>
			</tr>
		</thead>
		<tbody>
			<?php $orderList = $orderTable['orderList'];?>
			<?php if(!empty($orderList)):?>
			<?php foreach ($orderList as $order):?>
			<tr>
				<td> <?php echo $order['orderNum'];?> </td>
				<td> <?php echo $order['userId'];?> </td>
				<td> <?php echo $order['taId'];?> </td>
				<td> <?php echo $order['major'];?> </td>
				<td> <?php echo $order['courseName'];?> </td>
				<td> <?php echo $order['finishedTime'];?> </td>
				<td> <?php echo $order['price'];?> </td>
				<?php if($order['hasPaid']==0): ?>
				<td> <span class="label label-default">未付款</span></td>
			<?php elseif($order['hasTaken']==0): ?>
			<td> <span class="label label-warning">已付款</span></td>
		<?php elseif($order['hasFinished']==0): ?>
		<td> <span class="label label-info">已接单</span></td>
	<?php else: ?>
	<td> <span class="label label-success">已完成</span></td>
<?php endif; ?>
<td>
	<?php static $orderRow = 0; ?>
	<a href="#orderRow<?=$orderRow?>" data-toggle="modal">查看详情</a>
	<!-- Modal -->
	<div class="modal hide fade modal-overflow" id="orderRow<?=$orderRow?>" tabindex="-1" role="dialog">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h4 class="modal-title" id="myModalLabel<?=$orderRow?>">订单详情</h4>
		</div>
		<div class="modal-body">
			<div class="profile-classic row-fluid">
				<ul style="width:100%;" class="unstyled span10">
					<li style="width:100%;"><span>订单编号:</span> <?=$order['orderNum']?></li>
					<li style="width:100%;"><span>用户编号:</span> <?=$order['userId']?></li>
					<li style="width:100%;"><span>专业:</span> <?=$order['major']?></li>
					<li style="width:100%;"><span>课程名称:</span> <?=$order['courseName']?></li>
					<li style="width:100%;"><span>邮箱:</span> <?=$order['email']?></li>
					<li style="width:100%;"><span>页数:</span> <?=$order['pageNum']?></li>
					<li style="width:100%;"><span>阅读材料:</span> <?=$order['refDoc']?></li>
					<li style="width:100%;"><span>截止日期:</span> <?=$order['endTime']?></li>
					<li style="width:100%;"><span>价格:</span> <?=$order['price']?></li>
					<li style="width:100%;"><span>额外需求:</span> <?=$order['requirement']?></li>
					<li style="width:100%;"><span>TA编号:</span> <?=$order['taId']?></li>
					<li style="width:100%;"><span>创建时间:</span> <?=$order['createTime']?></li>
					<li style="width:100%;"><span>付款时间:</span> <?=$order['paidTime']?></li>
					<li style="width:100%;"><span>接单时间:</span> <?=$order['takenTime']?></li>
					<li style="width:100%;"><span>结束时间:</span> <?=$order['finishedTime']?></li>
				</ul>
			</div>
		</div>
	</div>
	<?php $orderRow++;?>
</td>
</tr>
<?php endforeach;?>
<?php else:?>
	<tr class="odd">
		<td valign="top" colspan="9" class="dataTables_empty">没有找到符合条件的结果</td>
	</tr>
<?php endif;?>
</tbody>

</table>

<?php 
$data['page_info'] = $page_info;
$data['js_page_method'] = $js_page_method;
$this->load->view(ADMIN_PREFIX."pagination",$data);
?>
</div>
