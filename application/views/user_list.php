<!-- BEGIN PAGE -->  
<div class="page-content">
	<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<div id="portlet-config" class="modal hide">
		<div class="modal-header">
			<button data-dismiss="modal" class="close" type="button"></button>
			<h3>portlet Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here will be a configuration form</p>
		</div>
	</div>

	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->   

		<div class="row-fluid">

			<div class="span12">
				<h3 class="page-title">
					用户管理
				</h3>
				<ul class="breadcrumb">
					<li>
					</li>
				</ul>
			</div>

		</div>
		<!-- END PAGE HEADER-->

		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<div class="span12">
				<div class="portlet box blue" id="form_wizard_1">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-reorder"></i> 用户列表
						</div>
						<div class="row-fluid search-forms search-default"  style="padding: 0px;">

							<form class="form-search" action="#">

								<div class="chat-form">

									<div class="input-cont">   

										<input type="text" placeholder="Search..." class="m-wrap">

									</div>

									<button type="button" class="btn green">Search &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>

								</div>

							</form>

						</div>
					</div>

					<div class="portlet-body">
						<div>
							<table class="table" id="userList">
								<thead>
									<tr>
										<th>ID</th>
										<th>用户名</th>
										<th>大学</th>
										<th>邮箱</th>
										<th>创建时间</th>
										<th>查看订单</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($userList))foreach ($userList as $user):?>
									<tr>
										<td> <?php echo $user['openid'];?> </td>
										<td> <?php echo $user['nickname'];?> </td>
										<td> <?php echo $user['university'];?> </td>
										<td> <?php echo $user['email'];?> </td>
										<td> <?php echo $user['createTime'];?> </td>
										<td> <a href="<?php echo site_url("order/userOrderList/")."/".$user['openid']?>">查看订单</a> </td>
									</tr>
								<?php endforeach;?>
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
