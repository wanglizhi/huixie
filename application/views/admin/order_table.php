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
	<a href="<?php echo site_url(ADMIN_PREFIX."order/orderInfo").'?orderNum='.$order['orderNum']?>" ><?php echo $order['orderNum'];?></a>
	<?php 
		$data['order'] = $order;
		$data['orderRow'] = $orderRow;
		$this->load->view(ADMIN_PREFIX."order_model",$data);
	?>
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
