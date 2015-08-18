<div id="<?php if(isset($tradeTable)) echo $tradeTable['tableId']?>">
	<table class="table table-striped table-hover sort-table">
		<thead>
			<tr>
				<th>交易ID</th>
				<th>金额</th>
				<th>余额</th>
				<th>订单编号</th>
				<th>创建时间</th>
				<th>描述</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(isset($tradeTable)) 
				$tradeList = $tradeTable['tradeList'];
			?>
			<?php if(!empty($tradeList)):?>
			<?php foreach ($tradeList as $trade):?>
			<tr detail="close">
				<td><?=$trade['id']?></td>
				<td> <?php echo $trade['money'];?> </td>
				<td> <?php echo $trade['balance'];?> </td>
				<td> <?php echo $trade['orderNum'];?> </td>
				<td> <?php echo $trade['createTime'];?> </td>
				<td> <abbr title="<?php echo $trade['describe']?>"><?php echo mb_substr(($trade['describe']),0,10,'utf-8')."...";?></abbr></td>

			</tr>
		<?php endforeach;?>
	<?php else:?>
	<tr class="odd">
		<td valign="top" colspan="6" class="dataTables_empty">没有找到符合条件的结果</td>
	</tr>
<?php endif;?>
</tbody>

</table>

<script type="text/javascript">
</script>

<?php
$data['page_info'] = $tradeTable['page_info'];
$data['js_page_method'] = $tradeTable['js_page_method'];
$this->load->view(ADMIN_PREFIX."pagination",$data);
?>
</div>
