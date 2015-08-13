<div id="<?php if(isset($selectedTaTable)) echo $selectedTaTable['tableId']?>">
	<table class="table table-striped table-hover sort-table">
		<thead>
			<tr>
				<th>编号</th>
				<th>TA ID</th>
				<th>订单编号</th>
				<th>创建时间</th>
				<th>接单状态</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(isset($selectedTaTable)) 
				$selectedTaList = $selectedTaTable['selectedTaList'];
			?>
			<?php if(!empty($selectedTaList)):?>
			<?php foreach ($selectedTaList as $selectedTa):?>
			<tr>
				<td> <?php echo $selectedTa['id']?></td>

				<td> <?php echo $selectedTa['taId']?></td>
				<td> <?php echo $selectedTa['orderNum']?></td>
				<td> <?php echo $selectedTa['createTime']?></td>
				<?php if($selectedTa['hasTaken']==0): ?>
				<td> <span class="label label-default">未接单</span></td>
			<?php else:?>
			<td> <span class="label label-info">已接单</span></td>
		<?php endif;?>
	</tr>
<?php endforeach;?>
<?php else:?>
	<tr class="odd">
		<td valign="top" colspan="5" class="dataTables_empty">没有找到符合条件的结果</td>
	</tr>
<?php endif;?>
</tbody>

</table>

<script type="text/javascript">

</script>
</div>
