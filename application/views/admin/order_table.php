<div id="<?php if(isset($orderTable)) echo $orderTable['tableId']?>">
	<table class="table table-striped table-hover sort-table">
		<thead>
			<tr>
				<th>订单编号</th>
				<th>用户编号</th>
				<th>TA编号</th>
				<?php 
					$sort_key = "createTime";
					$sort_method = "desc";
					if(isset($orderTable['sort_key'])) $sort_key = $orderTable['sort_key'];
					if(isset($orderTable['sort_method'])) $sort_method = $orderTable['sort_method'];
				?>

				<?php if($sort_key=="createTime"):?>
					<th class="sort_<?=$sort_method?>" value="<?=$sort_method?>" onclick="sort(this,'createTime')">创建日期</th>
				<?php else:?>
					<th class="sort" value="asc" onclick="sort(this,'createTime')">创建日期</th>
				<?php endif?>
				<?php if($sort_key=="endTime"):?>
					<th class="sort_<?=$sort_method?>" value="<?=$sort_method?>" onclick="sort(this,'endTime')">截止日期</th>
				<?php else:?>
					<th class="sort" value="asc" onclick="sort(this,'endTime')">截止日期</th>
				<?php endif?>

				<script type="text/javascript">
					function sort(th,key){
						var method = th.getAttribute('value');
						if(method=="desc") method = "asc";
						else method = "desc";
						<?=$js_page_method?>(<?=$page_info['current_page']?>,key,method);
					}
				</script>

				<th>价格</th>
				<th>订单状态</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(isset($orderTable)) 
					$orderList = $orderTable['orderList'];
			?>
			<?php if(!empty($orderList)):?>
			<?php foreach ($orderList as $order):?>
			<tr>

<td>
	<?php static $orderRow = 0; ?>
	<a href="#orderRow<?=$orderRow?>" data-toggle="modal"><?php echo $order['orderNum'];?></a>
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
				<td> <?php echo $order['userId'];?> </td>
				<td> <?php echo $order['taId'];?> </td>
				<td> <?php echo $order['createTime'];?> </td>
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
</tr>
<?php endforeach;?>
<?php else:?>
	<tr class="odd">
		<td valign="top" colspan="7" class="dataTables_empty">没有找到符合条件的结果</td>
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
