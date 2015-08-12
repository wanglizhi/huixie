<div id="<?php if(isset($cashTable)) echo $cashTable['tableId']?>">
	<table class="table table-striped table-hover sort-table">
		<thead>
			<tr>
				<th>返现ID</th>
				<th>用户ID</th>
				<th>账户类型</th>
				<th>现金账户</th>
				<th>卖家账户</th>
				<th>金额</th>
				<th>余额</th>
				<th>创建时间</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(isset($cashTable)) 
				$cashList = $cashTable['cashList'];
			?>
			<?php if(!empty($cashList)):?>
			<?php foreach ($cashList as $cash):?>
			<tr detail="close">
				<td>
					<a href="javascript:void(0);" onclick="showCashDetail(this,'<?=$cash['describe']?>')"><?=$cash['id']?></a>
				</td>
				<td> <?php echo $cash['openid'];?> </td>
				<td> <?php echo $cash['cashType'];?> </td>
				<td> <?php echo $cash['cashAccount'];?> </td>
				<td> <?php echo $cash['merchantAccount'];?> </td>
				<td> <?php echo $cash['money'];?> </td>
				<td> <?php echo $cash['balance'];?> </td>
				<td> <?php echo $cash['createTime'];?> </td>

			</tr>
		<?php endforeach;?>
	<?php else:?>
	<tr class="odd">
		<td valign="top" colspan="8" class="dataTables_empty">没有找到符合条件的结果</td>
	</tr>
<?php endif;?>
</tbody>

</table>

<script type="text/javascript">
function showCashDetail(detailButton,detail){
	var tr = $(detailButton).closest('tr');
	if($(tr).attr("detail")=="open"){
		var tr1 = $(tr).next();
		tr1.remove();
		$(tr).attr("detail","close");
	}else{
		var tr1 = " \
			<tr> \
				<td>描述:</td> \
				<td class='details' colspan='7'>"+detail+"</td> \
			</tr> \
		";
		$(tr).after(tr1);
		$(tr).attr("detail","open");
	}
}
</script>

<?php
$data['page_info'] = $cashTable['page_info'];
$data['js_page_method'] = $cashTable['js_page_method'];
$this->load->view(ADMIN_PREFIX."pagination",$data);
?>
</div>
