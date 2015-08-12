<div id="<?php if(isset($tradeTable)) echo $tradeTable['tableId']?>">
	<table class="table table-striped table-hover sort-table">
		<thead>
			<tr>
				<th>交易ID</th>
				<th>用户ID</th>
				<th>金额</th>
				<th>余额</th>
				<th>订单编号</th>
				<th>创建时间</th>
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
				<td>
					<a href="javascript:void(0);" onclick="showTradeDetail(this,'<?=$trade['describe']?>')"><?=$trade['id']?></a>
				</td>
				<td> <?php echo $trade['openid'];?> </td>
				<td> <?php echo $trade['money'];?> </td>
				<td> <?php echo $trade['balance'];?> </td>
				<td> <?php echo $trade['orderNum'];?> </td>
				<td> <?php echo $trade['createTime'];?> </td>

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
function showTradeDetail(detailButton,detail){
	var tr = $(detailButton).closest('tr');
	if($(tr).attr("detail")=="open"){
		var tr1 = $(tr).next();
		tr1.remove();
		$(tr).attr("detail","close");
	}else{
		var tr1 = " \
			<tr> \
				<td>描述:</td> \
				<td class='details' colspan='5'>"+detail+"</td> \
			</tr> \
		";
		$(tr).after(tr1);
		$(tr).attr("detail","open");
	}
}
</script>

<?php
$data['page_info'] = $tradeTable['page_info'];
$data['js_page_method'] = $tradeTable['js_page_method'];
$this->load->view(ADMIN_PREFIX."pagination",$data);
?>
</div>
