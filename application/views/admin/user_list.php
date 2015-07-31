<!-- BEGIN PAGE -->  
<div class="page-content">

	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->   

		<div class="row-fluid">

			<div class="span12">
				<h3 class="page-title">
					用户管理
				</h3>
			</div>

		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<div class="span12">
				<div class="portlet box" id="form_wizard_1">
					<div class="portlet-title">

						<div class="row-fluid search-forms search-default" style="width:50%;" >

							<form class="form-search" action="<?php echo site_url(ADMIN_PREFIX."user/searchUser");?>" method="get" style="padding: 0px;">
								<div class="chat-form">
									<div class="input-cont" >   

										<input type="text" name="key" placeholder="请输入关键词。。。" class="m-wrap">

									</div>

									<button type="submit" class="btn green">搜索用户 &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>

								</div>

							</form>

						</div>
					</div>

					<div class="portlet-body">
						<div>

							<table class="table table-striped table-hover" id="userList">
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
					</div>
					<?=$page_info?>

				</div>

			</div>

		</div>

	</div>
	<!-- END PAGE CONTENT-->         

</div>
<!-- END PAGE CONTAINER-->

</div>
<!-- END PAGE -->  
