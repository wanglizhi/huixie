<div id="<?php if(isset($taTable)) echo $taTable['tableId']?>">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Open ID</th>
				<th>邮箱</th>
				<th>技能</th>
				<th>评级</th>
				<th>每页收费</th>
				<th>审核状态</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if(isset($taTable)) 
					$taList = $taTable['taList'];
			?>
			<?php if(!empty($taList)): ?>
			<?php foreach ($taList as $ta):?>
			<tr>
				<td> 
					<a href="<?php echo site_url(ADMIN_PREFIX."ta/taInfo/?openid=".$ta['openid']);?>">
						<?php echo $ta['openid'];?> 
					</a>
				</td>
				<td> <?php echo $ta['email'];?> </td>
				<td> <?php echo $ta['skills'];?> </td>
				<td> <?php echo $ta['star'];?> </td>
				<td> <?php if($ta['unitPrice']!=null)
				echo $ta['unitPrice']." 元";?>  </td>
				<td>
					<?php if($ta['hasCheck']): ?>
						<span class="label label-success">已审核</span>
						<?php else:?>
						<span class="label label-info">待审核</span>
					<?php endif;?>
				</td>
			</tr>
			<?php endforeach;?>
			<?php else: ?>
			<tr class="odd">
				<td valign="top" colspan="6" class="dataTables_empty">没有找到符合条件的结果</td>
			</tr>
			<?php endif;?>
		</tbody>
	</table>
	<?php 
		$data['page_info'] = $taTable['page_info'];
		$data['js_page_method'] = $js_page_method;
		$this->load->view(ADMIN_PREFIX."pagination",$data);
	?>
</div>