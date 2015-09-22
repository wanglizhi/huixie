<div id="<?php if(isset($userTable)) echo $userTable['tableId']?>">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>用户名</th>
				<th>大学</th>
				<th>邮箱</th>
				<th>创建时间</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if(isset($userTable))
				$userList = $userTable['userList'];
			?>
			<?php if(!empty($userList)): ?>
			<?php foreach ($userList as $user):?>
			<tr>
				<td> <a href="<?php echo site_url(ADMIN_PREFIX."user/userProfile")."?user_id=".$user['openid']?>"><?php echo $user['openid'];?></a></td>
				<td> <?php echo $user['nickname'];?> </td>
				<td> <?php echo $user['university'];?> </td>
				<td> <?php echo $user['email'];?> </td>
				<td> <?php echo $user['createTime'];?> </td></tr>
			<?php endforeach;?>
		<?php else:?>
		<tr class="odd">
			<td valign="top" colspan="6" class="dataTables_empty">没有找到符合条件的结果</td>
		</tr>
	<?php endif;?>
</tbody>
</table>

<?php 
$data['page_info'] = $page_info;
$data['js_page_method'] = $page_info['js_page_method'];
$this->load->view(ADMIN_PREFIX."pagination",$data);
?>
</div>